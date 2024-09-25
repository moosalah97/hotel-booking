<?php

namespace Database\Seeders;

use App\Models\Rateplan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatePlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rateplan::create([
            'room_id' => 1, // Assuming the room_id exists
            'name' => 'Standard Rate',
            'slug' => 'standard-rate',
            'detail' => 'A basic rate plan for the standard room.',
            'price' => 100.00, // Price in your currency
        ],);
        RatePlan::create([
            'room_id' => 2, // Assuming the room_id exists
            'name' => 'Standard Rate',
            'slug' => 'standard-rate',
            'detail' => 'A basic rate plan for the standard room.',
            'price' => 100.00, // Price in your currency
        ],);
        RatePlan::create([
            'room_id' => 3, // Assuming the room_id exists
            'name' => 'Standard Rate',
            'slug' => 'standard-rate',
            'detail' => 'A basic rate plan for the standard room.',
            'price' => 100.00, // Price in your currency
        ],);
    }
}
