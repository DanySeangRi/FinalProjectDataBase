<?php

namespace App\Http\Controllers;

use App\Models\Routes;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookTripController extends Controller
{

    public function findSched(Request $request)
    {
    
      //fetch locations for the dropdown option
      $departPlace = Routes::where('status', 'active')
                      ->distinct()
                      ->pluck('departPlace'); 
    
      $arrivePlace = Routes::where('status', 'active')
                      ->distinct()
                      ->pluck('arrivePlace');

      //get input parameters
      $from = $request->input('from');
      $to = $request->input('to');
      $date = $request->input('date');

       $scheds = null;

       //query the schedule
       if ($from && $to && $date){
        $scheds = Schedule::with(['route','vehicle'])
           ->where('departDate', $date)
           ->where('status', 'active')
           ->whereHas('route', function($query) use ($from, $to) {
                $query->where('departPlace', $from)
                      ->where('arrivePlace', $to)
                      ->where('status','active'); 
           })

           ->whereHas('vehicle', function($query){
                $query->where('status','active');
           })
           ->orderBy('departTime', 'asc')
           ->get();

    }
      return view('booktrip', compact('departPlace', 'arrivePlace', 'scheds', 'from', 'to', 'date'));
    }

    public function selectSched($scheduleID)
    {
    $sched=Schedule::with(['route','vehicle'])->findOrFail($scheduleID);

    return view('booktrip-view', compact('sched'));
   }

     public function selectSeat($scheduleID)
    {
    $sched=Schedule::with(['route','vehicle'])->findOrFail($scheduleID);

    return view('booktrip-selectseat', compact('sched'));
   }

    public function fillInfo($scheduleID)
    {
    $sched=Schedule::with(['route','vehicle'])->findOrFail($scheduleID);

    return view('booktrip-fillInfo', compact('sched'));
   }

   


   
}

