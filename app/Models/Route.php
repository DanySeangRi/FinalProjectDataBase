<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Route extends Model
{

   protected $fillable = [
    'origin',
    'destination',
    'distance',
    'duration_minutes',
    'status',
];
    public function schedules()
    {
        return $this->hasMany(RouteSchedule::class);
    }

}