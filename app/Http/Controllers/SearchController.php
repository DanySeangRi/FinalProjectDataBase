<?php

namespace App\Http\Controllers;

use App\Models\RouteSchedule;
use App\Models\Route;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {

        $from = $request->from;
        $to   = $request->to;
        $date = $request->date;


        $schedules = RouteSchedule::with([
            'route',
            'vehicle'
        ])
        ->whereHas('route', function($query) use ($from,$to){

            $query
            ->where('origin','ILIKE',"%{$from}%")
            ->where('destination','ILIKE',"%{$to}%");

        })
        ->when($date, function($query) use ($date){

            $query->whereDate('travel_date',$date);

        })
        ->where('status','active')
        ->get();



        return view('pages.search-result', compact(
            'schedules',
            'from',
            'to',
            'date'
        ));

    }

}