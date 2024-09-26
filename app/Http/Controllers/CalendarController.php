<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    public function index()
    {
        return Calendar::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'rateplan_id' => 'required|exists:rateplans,id',
            'date' => 'required|date|unique:calendars,date,NULL,id,room_id,' . $request->room_id,
            'price' => 'required|numeric|min:0',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $room = Room::find($request->room_id);

        if (!$room) {
            return response()->json(['error' => 'Room not found'], 404);
        }

        // Create the calendar entry using mass assignment
        $calendar = Calendar::create([
            'room_id' => $request->room_id,
            'rateplan_id' => $request->rateplan_id,
            'date' => $request->date,
            'availability' =>  $room->availability,
            'price' => $request->price,
        ]);

        // Return success response with the created calendar entry
        return response()->json($calendar, 201);
    }

    public function show(Calendar $calendar)
    {
        return $calendar;
    }

    public function update(Request $request, Calendar $calendar)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'rateplan_id' => 'required|exists:rateplans,id',
            'date' => 'required|date',
            'price' => 'required|numeric',
        ]);

        $room = Room::find($request->room_id);

        if (!$room) {
            return response()->json(['error' => 'Room not found'], 404);
        }

        $calendar->update([
            'room_id' => $request->room_id,
            'rateplan_id' => $request->rateplan_id,
            'date' => $request->date,
            'availability' => $room->availability,
            'price' => $request->price,
        ]);

        return $calendar;
    }

    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response(null, 204);
    }
}
