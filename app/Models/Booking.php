<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'rateplan_id',
        'calendar_id',
        'reservation_number',
        'check_in',
        'check_out',
        'name',
        'email',
        'phone_number',
        'country',
        'total',
        'payment_status',
        'reservation_date',

    ];
}
