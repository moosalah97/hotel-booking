<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'features',
        'published',
        'availability',
        'images',
    ];

    // Optionally, you can cast 'features' and 'images' as JSON if needed
    protected $casts = [
        'features' => 'array',
        'images' => 'array',
    ];
}
