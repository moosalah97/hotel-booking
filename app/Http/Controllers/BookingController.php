<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Calendar;
use App\Models\Rateplan;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::query();

        if ($request->filled('reservation_date_from') && $request->filled('reservation_date_to')) {
            $bookings->whereBetween('reservation_date', [$request->reservation_date_from, $request->reservation_date_to]);
        }

        if ($request->filled('check_in')) {
            $bookings->where('check_in', $request->check_in);
        }

        if ($request->filled('check_out')) {
            $bookings->where('check_out', $request->check_out);
        }

        if ($request->filled('name')) {
            $bookings->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('country')) {
            $bookings->where('country', 'like', '%' . $request->country . '%');
        }

        if ($request->filled('payment_status')) {
            $bookings->where('payment_status', $request->payment_status);
        }

        $bookings = $bookings->get();

        // For web request
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all();
        $rateplans = Rateplan::all();
        $calendars = Calendar::all();

        return view('bookings.create', compact('rooms', 'rateplans', 'calendars'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'rateplan_id' => 'required|exists:rateplans,id',
            'calendar_id' => 'required|exists:calendars,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'total' => 'required|numeric|min:0',
            'payment_status' => 'required|string|in:paid,pending,cancelled',
        ]);

        if ($validator->fails()) {
            // Fetch all necessary data to populate the form again
            $rooms = Room::all();
            $rateplans = Rateplan::all();
            $calendars = Calendar::all();

            // Return the view with errors and old input
            return view('bookings.create', [
                'rooms' => $rooms,
                'rateplans' => $rateplans,
                'calendars' => $calendars,
                'errors' => $validator->errors(),
                'old' => $request->all()
            ]);
        }

        // Proceed to create the booking if validation passes
        $reservationNumber = $this->generateReservationNumber();
        $booking = Booking::create(array_merge($request->all(), ['reservation_number' => $reservationNumber]));

        // Decrease availability for each day from check_in to check_out
        $this->updateCalendarAvailability($request->room_id, $request->check_in, $request->check_out);

        // Redirect back to the bookings index with a success message
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    private function generateReservationNumber()
    {
        return now()->format('Ymd') . '-' . mt_rand(100000, 999999);
    }

    public function show(Booking $booking)
    {
        return response()->json($booking, 200);
    }

    public function update(Request $request, Booking $booking)
    {
        // Validate the incoming request data
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'rateplan_id' => 'required|exists:rateplans,id',
            'calendar_id' => 'required|exists:calendars,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'total' => 'required|numeric|min:0',
            'payment_status' => 'required|string|in:paid,pending,cancelled',
        ]);

        $this->updateCalendarAvailability($booking->room_id, $booking->check_in, $booking->check_out);

        $booking->update($request->all());

        $this->updateCalendarAvailability($request->room_id, $request->check_in, $request->check_out);

        return response()->json($booking, 200);
    }

    public function destroy(Booking $booking)
    {
        // Restore availability
        $this->updateCalendarAvailability($booking->room_id, $booking->check_in, $booking->check_out, 1);

        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully!');
    }

    // Helper function to update calendar availability
    private function updateCalendarAvailability($room_id, $check_in, $check_out)
    {
        $dateRange = $this->getDateRange($check_in, $check_out);
        $totalDays = count($dateRange);

        $calendar = Calendar::where('room_id', $room_id)->where('availability', '>=', $totalDays)->first();

        if ($calendar) {
            $calendar->availability -= $totalDays;

            if ($calendar->availability < 0) {
                $calendar->availability = 0;
            }

            $calendar->save();
        }
    }


    private function getDateRange($check_in, $check_out)
    {
        $period = new \DatePeriod(
            new \DateTime($check_in),
            new \DateInterval('P1D'),
            (new \DateTime($check_out))->modify('-1 day')
        );

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }


    public function getRevenue()
    {
        $totalRevenueToday = Booking::whereDate('created_at', Carbon::today())
            ->where('payment_status', 'paid')
            ->sum('total');

        $totalRevenue = Booking::where('payment_status', 'paid')
            ->sum('total');

        return response()->json([
            'total_revenue_today' => $totalRevenueToday,
            'total_revenue' => $totalRevenue,
        ], 200);
    }
}
