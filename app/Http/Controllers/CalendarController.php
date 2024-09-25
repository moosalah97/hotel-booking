<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
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
            'availability' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the calendar entry using mass assignment
        $calendar = Calendar::create([
            'room_id' => $request->room_id,
            'rateplan_id' => $request->rateplan_id,
            'date' => $request->date,
            'availability' => $request->availability,
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
            'availability' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $calendar->update($request->all());
        return $calendar;
    }

    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response(null, 204);
    }
}
