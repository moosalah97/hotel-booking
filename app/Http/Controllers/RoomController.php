<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Room::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|array',
            'features.bed_type' => 'required|string',
            'features.room_size' => 'required|string',
            'features.occupancy' => 'required|integer',
            'features.view' => 'required|string',
            'published' => 'required|boolean',
            'availability' => 'required|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'string', // Assuming images are strings (URLs or filenames)
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the room using mass assignment
        $room = Room::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'features' => json_encode($request->features),
            'published' => $request->published,
            'availability' => $request->availability,
            'images' => json_encode($request->images),
        ]);

        // Return success response with the created room
        return response()->json($room, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
        return $room;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $room->update($request->all());
        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response(null, 204);
    }
}
