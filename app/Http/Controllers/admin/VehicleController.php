<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display all vehicles with search.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $vehicles = Vehicle::query()

            ->when($search, function ($query) use ($search) {

                $query->where('vehicle_number', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('driver_name', 'LIKE', "%{$search}%");

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Store a new vehicle.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_number' => 'required|string|max:255|unique:vehicles,vehicle_number',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'driver_name' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Vehicle::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle created successfully.'
            ]);
        }

        return redirect()
            ->route('admin.vehicles')
            ->with('success', 'Vehicle created successfully.');
    }

    /**
     * Update an existing vehicle.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'vehicle_number' => 'required|string|max:255|unique:vehicles,vehicle_number,' . $vehicle->id,
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'driver_name' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $vehicle->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle updated successfully.'
            ]);
        }

        return redirect()
            ->route('admin.vehicles')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Delete a vehicle.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        request()->ajax()
            ? response()->json([
                'success' => true,
                'message' => 'Vehicle deleted successfully.'
            ])
            : null;

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle deleted successfully.'
            ]);
        }

        return redirect()
            ->route('admin.vehicles')
            ->with('success', 'Vehicle deleted successfully.');
    }
}