<?php

namespace App\Http\Controllers;

use App\Models\Route;

use App\Models\RouteSchedule;

class HomeController extends Controller
{
   public function index()
    {

        $locations = Route::select('origin')
            ->union(
                Route::select('destination')
            )
            ->distinct()
            ->pluck('origin');


        $schedules = RouteSchedule::with([
            'route',
            'vehicle'
        ])
        ->where('status', 'active')
        ->whereDate('travel_date', '>=', now())
        ->take(4)
        ->get();



        return view('home', compact(
            'locations',
            'schedules'
        ));

    }


    public function search()
    {
        $from = request('from');
        $to = request('to');
        $date = request('date');


        // Search logic later
        return view('trips.index', compact(
            'from',
            'to',
            'date'
        ));
    }
}