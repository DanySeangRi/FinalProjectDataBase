<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RouteSchedule;
use App\Models\Route;
use App\Models\Vehicle;
use App\Models\Seat;

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
                    ->whereHas('route', function ($q) use ($search) {

                        $q->where('origin', 'ILIKE', "%{$search}%")
                            ->orWhere('destination', 'ILIKE', "%{$search}%");

                    })

                    ->orWhereHas('vehicle', function ($q) use ($search) {

                        $q->where('vehicle_number', 'ILIKE', "%{$search}%");

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
    public function store(Request $request)
    {


        $validated = $request->validate([

            'route_id' =>
                'required|exists:routes,id',

            'vehicle_id' =>
                'required|exists:vehicles,id',

            'travel_date' =>
                'required|date',

            'departure_time' =>
                'required',

            'arrival_time' =>
                'required',

            'price' =>
                'required|numeric',

        ]);



        $schedule = RouteSchedule::create($validated);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);
        $capacity = $vehicle->capacity;
        $letters = ['A', 'B', 'C', 'D'];
        $count = 0;

        for ($row = 1; $count < $capacity; $row++) {
            foreach ($letters as $letter) {
                if ($count >= $capacity) {
                    break;
                }

                Seat::firstOrCreate([
                    'vehicle_id' => $vehicle->id,
                    'seat_number' => $row . $letter,
                ]);

                $count++;
            }
        }



        return response()->json([

            'success' => true,

            'message' => 'Schedule created successfully'

        ]);

    }
    public function update(Request $request, RouteSchedule $routeSchedule)
    {

        $validated = $request->validate([

            'route_id' =>
                'required|exists:routes,id',

            'vehicle_id' =>
                'required|exists:vehicles,id',

            'travel_date' =>
                'required|date',

            'departure_time' =>
                'required',

            'arrival_time' =>
                'required',

            'price' =>
                'required|numeric',

        ]);



        $routeSchedule->update($validated);



        return response()->json([

            'success' => true,

            'message' => 'Schedule updated successfully'

        ]);

    }
    public function destroy(RouteSchedule $routeSchedule)
    {

        $routeSchedule->delete();


        return response()->json([

            'success' => true,

            'message' => 'Schedule deleted successfully'

        ]);

    }
}
