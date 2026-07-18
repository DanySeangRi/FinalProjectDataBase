<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $fillable = [
        'vehicle_number',
        'brand',
        'plate_number',
        'type',
        'year',
        'capacity',
        'status',
    ];
    public function schedules()
    {
        return $this->hasMany(RouteSchedule::class);
    }
}
