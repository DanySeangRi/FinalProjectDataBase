<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteSchedule extends Model
{
    protected $fillable = [

        'route_id',
        'vehicle_id',
        'travel_date',
        'departure_time',
        'arrival_time',
        'duration',
        'price',
        'available_seats',
        'status'

    ];


    public function route()
    {
        return $this->belongsTo(Route::class);
    }


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function seats()
{
    return $this->hasMany(
        Seat::class,
        'schedule_id'
    );
}
}