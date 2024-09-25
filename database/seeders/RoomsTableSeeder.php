<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'name' => 'Suite Room',
            'slug' => 'suite-room',
            'description' => 'An upscale suite with a living area and luxury amenities.',
            'features' => 'WiFi, Air Conditioning, Jacuzzi',
            'published' => 1,
            'availability' => 3,
            'images' => json_encode(['image4.jpg', 'image5.jpg']),
        ]);
        Room::create([
            'name' => 'Standard Room',
            'slug' => 'suite-room',
            'description' => 'An upscale suite with a living area and luxury amenities.',
            'features' => 'WiFi, Air Conditioning, Jacuzzi',
            'published' => 1,
            'availability' => 3,
            'images' => json_encode(['image4.jpg', 'image5.jpg']),
        ]);
        Room::create([
            'name' => 'Suite',
            'slug' => 'suite-room',
            'description' => 'An upscale suite with a living area and luxury amenities.',
            'features' => 'WiFi, Air Conditioning, Jacuzzi',
            'published' => 1,
            'availability' => 3,
            'images' => json_encode(['image4.jpg', 'image5.jpg']),
        ]);
        Room::create([
            'name' => 'Single Room',
            'slug' => 'suite-room',
            'description' => 'An upscale suite with a living area and luxury amenities.',
            'features' => 'WiFi, Air Conditioning, Jacuzzi',
            'published' => 1,
            'availability' => 3,
            'images' => json_encode(['image4.jpg', 'image5.jpg']),
        ]);
    }
}
