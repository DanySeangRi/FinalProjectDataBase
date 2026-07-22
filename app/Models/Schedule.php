<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicles;

class Schedule extends Model
{
    protected $table='tbl_schedule';
    protected $primaryKey='scheduleID';

    public function route(){
        return $this->belongsTo(Routes::class, 'routeID', 'routeID');
    }

    public function vehicle(){
        return $this->belongsTo(Vehicles::class, 'vehicleID','vehicleID');
    }
}
