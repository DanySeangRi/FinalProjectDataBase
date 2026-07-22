<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'schedule_id',
        'seat_number',
        'status',
    ];


    public function schedule()
    {
        return $this->belongsTo(
            RouteSchedule::class,
            'schedule_id'
        );
    }


    public function bookings()
    {
        return $this->belongsToMany(
            Booking::class,
            'booking_seats'
        );
    }


    public function bookingSeats()
    {
        return $this->hasMany(
            BookingSeat::class
        );
    }
}