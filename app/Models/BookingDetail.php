<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'seat_id',
        'first_name',
        'last_name',
        'dob',
        'gender',
        'nationality',
        'id_passport',
        'phone',
        'email',
        'price',
    ];

    protected $casts = [
        'dob' => 'date',
        'price' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
