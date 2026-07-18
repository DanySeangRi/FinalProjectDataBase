<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $fillable = [

    'vehicle_number',

    'type',

    'capacity',

    'driver_name',

    'status',

];
}
