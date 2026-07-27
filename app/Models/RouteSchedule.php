<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    protected function casts(): array
    {
        return [
            'travel_date' => 'date',
            'price' => 'decimal:2',
        ];
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function seats(): HasManyThrough
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
