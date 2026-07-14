<?php

namespace App\Http\Controllers;

use App\Models\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookTripController extends Controller
{
    public function findTrip(Request $request)
    {
      $departPlace = Routes::where('status', 'active')
                      ->distinct()
                      ->pluck('departPlace'); 
    
      $arrivePlace = Routes::where('status', 'active')
                      ->distinct()
                      ->pluck('arrivePlace');

      $from = $request->input('from');
      $to = $request->input('to');
      $date = $request->input('date');

       $trips = null;

       if ($from && $to && $date){
        $trips = DB::table('tbl_schedule as s')
            ->join('tbl_routes as r', 's.routeID', '=', 'r.routeID')
            ->join('tbl_vehicles as v', 's.vehicleID', '=', 'v.vehicleID')
            ->select(
                's.scheduleID',
                'v.vehicleName',
                'v.ammenities',
                'r.departPlace', 
                'r.arrivePlace',
                'r.boardStation',
                's.departTime',
                's.arrivalTime',
                's.duration',
                's.price',
                's.availableSeat'
            )
            ->where('r.departPlace', $from)
            ->where('r.arrivePlace', $to)
            ->where('s.departDate', $date)
            ->where('r.status', 'active')
            ->where('s.status','active')
            ->where('v.status','active')
            ->orderBy('s.departTime','asc')
            ->get(); 
       }

       return view('booktrip', compact('departPlace','arrivePlace','trips','from','to','date'));

    }

    public function selectTrip($scheduleID)
    {
    
    $trip = DB::table('tbl_schedule')->where('scheduleID', $scheduleID)->first();

    return view('booktrip-confirm', compact('trip'));
   }
   
}
