<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'user_id',
        'route_schedule_id',
        'booking_code',
        'seat_number',
        'total_price',
        'status'
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
                'MN' . str_pad($number, 6, '0', STR_PAD_LEFT);


        });

    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function routeSchedule()
    {
        return $this->belongsTo(RouteSchedule::class);
    }

}