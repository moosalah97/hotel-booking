<?php

namespace Database\Seeders;

use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Calendar::create([
            'room_id' => 1, // Assuming the room_id exists
            'rateplan_id' => 1, // Assuming the rateplan_id exists
            'date' => Carbon::create(2024, 10, 1), // Example date
            'availability' => 10, // Number of available rooms
            'price' => 100.00, // Price for the date
        ]);
        Calendar::create([
            'room_id' => 2, // Assuming the room_id exists
            'rateplan_id' => 2, // Assuming the rateplan_id exists
            'date' => Carbon::create(2024, 10, 1), // Example date
            'availability' => 10, // Number of available rooms
            'price' => 100.00, // Price for the date
        ]);
        Calendar::create([
            'room_id' => 3, // Assuming the room_id exists
            'rateplan_id' => 3, // Assuming the rateplan_id exists
            'date' => Carbon::create(2024, 10, 1), // Example date
            'availability' => 10, // Number of available rooms
            'price' => 100.00, // Price for the date
        ]);
    }
}
