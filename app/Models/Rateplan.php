<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rateplan extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'name',
        'slug',
        'detail',
        'price',
    ];
}
