<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'route_schedule_id',
        'booking_code',
        'total_price',
        'status',
        'cancel_reason',
        'cancelled_at',
    ];


    protected static function boot()
    {
        parent::boot();


        static::creating(function ($booking) {

            $lastBooking = Booking::latest('id')->first();


            $number = $lastBooking
                ? $lastBooking->id + 1
                : 1;


            $booking->booking_code =
                'MN' . str_pad(
                    $number,
                    6,
                    '0',
                    STR_PAD_LEFT
                );

        });

    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function routeSchedule()
    {
        return $this->belongsTo(
            RouteSchedule::class,
            'route_schedule_id'
        );
    }



    public function seats()
    {
        return $this->belongsToMany(
            Seat::class,
            'booking_seats'
        );
    }



    public function bookingSeats()
    {
        return $this->hasMany(BookingSeat::class);
    }

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}