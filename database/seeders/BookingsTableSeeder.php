<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Booking::create([
            'room_id' => 1,
            'rateplan_id' => 1,
            'calendar_id' => 1,
            'check_in' => '2024-09-25',
            'check_out' => '2024-09-28',
            'reservation_date' => '2024-09-28',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone_number' => '1234567890',
            'country' => 'USA',
            'total' => 450,
            'payment_status' => 'paid',
            'reservation_number' => 'RES123456'
        ]);

        Booking::create([
            'room_id' => 2,
            'rateplan_id' => 2,
            'calendar_id' => 2,
            'check_in' => '2024-09-26',
            'check_out' => '2024-09-30',
            'reservation_date' => '2024-09-28',
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone_number' => '0987654321',
            'country' => 'Canada',
            'total' => 300,
            'payment_status' => 'pending',
            'reservation_number' => 'RES123457'
        ]);
    }
}
