<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->search;


        $vehicles = Vehicle::query()

            ->when($search, function ($query) use ($search) {

                $query->where('vehicle_number', 'ILIKE', "%{$search}%")
                    ->orWhere('brand', 'ILIKE', "%{$search}%")
                    ->orWhere('plate_number', 'ILIKE', "%{$search}%")
                    ->orWhere('type', 'ILIKE', "%{$search}%");

            })


            ->latest()

            ->paginate(10)

            ->withQueryString();



        return view(
            'admin.vehicles.index',
            compact('vehicles','search')
        );

    }



    public function store(Request $request)
    {

        $validated = $request->validate([

            'vehicle_number' => 
                'required|string|max:255|unique:vehicles,vehicle_number',

            'brand' =>
                'required|string|max:255',

            'plate_number' =>
                'nullable|string|max:255|unique:vehicles,plate_number',

            'type' =>
                'required|string|max:255',

            'year' =>
                'required|integer',

            'capacity' =>
                'required|integer|min:1',

            'status' =>
                'required|in:active,inactive',

        ]);



        Vehicle::create($validated);



        return response()->json([

            'success'=>true,

            'message'=>'Vehicle created successfully'

        ]);

    }




    public function update(Request $request, Vehicle $vehicle)
    {


        $validated = $request->validate([

            'vehicle_number' =>
                'required|string|max:255|unique:vehicles,vehicle_number,'.$vehicle->id,


            'brand'=>
                'required|string|max:255',


            'plate_number'=>
                'nullable|string|max:255|unique:vehicles,plate_number,'.$vehicle->id,


            'type'=>
                'required|string|max:255',


            'year'=>
                'required|integer',


            'capacity'=>
                'required|integer|min:1',


            'status'=>
                'required|in:active,inactive',

        ]);



        $vehicle->update($validated);



        return response()->json([

            'success'=>true,

            'message'=>'Vehicle updated successfully'

        ]);

    }





    public function destroy(Vehicle $vehicle)
    {


        $vehicle->delete();



        return response()->json([

            'success'=>true,

            'message'=>'Vehicle deleted successfully'

        ]);

    }

}