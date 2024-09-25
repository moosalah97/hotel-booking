<?php

namespace App\Http\Controllers;

use App\Models\Rateplan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RateplanController extends Controller
{
    public function index()
    {
        return Rateplan::all();
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'detail' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the rateplan using mass assignment
        $rateplan = Rateplan::create([
            'room_id' => $request->room_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'detail' => $request->detail,
            'price' => $request->price,
        ]);

        // Return success response with the created rateplan
        return response()->json($rateplan, 201);
    }

    public function show(Rateplan $rateplan)
    {
        return $rateplan;
    }

    public function update(Request $request, Rateplan $rateplan)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required',
            'slug' => 'required|unique:rateplans,slug,' . $rateplan->id,
            'detail' => 'required',
            'price' => 'required|numeric',
        ]);

        $rateplan->update($request->all());
        return $rateplan;
    }

    public function destroy(Rateplan $rateplan)
    {
        $rateplan->delete();
        return response(null, 204);
    }
}
