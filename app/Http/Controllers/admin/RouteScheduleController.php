<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RouteSchedule;
use App\Models\Route;
use App\Models\Vehicle;

class RouteScheduleController extends Controller
{
    public function index(Request $request)
{

    $search = $request->search;


    $routeSchedules = RouteSchedule::with([
        'route',
        'vehicle'
    ])

    ->when($search, function ($query) use ($search) {

        $query
        ->whereHas('route', function($q) use ($search){

            $q->where('origin','ILIKE',"%{$search}%")
              ->orWhere('destination','ILIKE',"%{$search}%");

        })

        ->orWhereHas('vehicle', function($q) use ($search){

            $q->where('vehicle_number','ILIKE',"%{$search}%");

        });

    })


    ->latest()

    ->paginate(10)

    ->withQueryString();



    $routes = Route::all();

    $vehicles = Vehicle::all();



    return view(
        'admin.schedules.index',
        compact(
            'routeSchedules',
            'routes',
            'vehicles',
            'search'
        )
    );

}
}
