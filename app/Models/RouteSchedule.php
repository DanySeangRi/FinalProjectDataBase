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
        'price',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'price' => 'decimal:2',
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
        return $this->hasManyThrough(
            Seat::class,
            Vehicle::class,
            'id',
            'vehicle_id',
            'vehicle_id',
            'id'
        );
    }
}