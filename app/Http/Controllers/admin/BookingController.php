<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\RouteSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Seat;

class BookingController extends Controller
{


  public function index(Request $request)
  {
    $search = $request->search;

    $bookings = Booking::with([
      'user',
      'routeSchedule.route',
      'routeSchedule.vehicle',
      'seats'
    ])

      ->when($search, function ($query) use ($search) {

        $query->where(function ($q) use ($search) {

          $q->where('booking_code', 'ILIKE', "%{$search}%")

            ->orWhereHas('seats', function ($seat) use ($search) {

              $seat->where(
                'seat_number',
                'ILIKE',
                "%{$search}%"
              );

            })

            ->orWhereHas('user', function ($user) use ($search) {

              $user->where('first_name', 'ILIKE', "%{$search}%")
                ->orWhere('last_name', 'ILIKE', "%{$search}%");

            })

            ->orWhereHas('routeSchedule.route', function ($route) use ($search) {

              $route->where('origin', 'ILIKE', "%{$search}%")
                ->orWhere('destination', 'ILIKE', "%{$search}%");

            })

            ->orWhereHas('routeSchedule.vehicle', function ($vehicle) use ($search) {

              $vehicle->where('vehicle_number', 'ILIKE', "%{$search}%");

            });

        });

      })

      ->latest()
      ->paginate(10)
      ->withQueryString();

    $users = User::where('role', 'user')->get();

    $schedules = RouteSchedule::with([
      'route',
      'vehicle',
    ])->get();

    return view('admin.bookings.index', compact(
      'bookings',
      'users',
      'schedules',
      'search'
    ));
  }

  public function store(Request $request)
  {

    $validated = $request->validate([

      'user_id' => 'required|exists:users,id',

      'route_schedule_id' => 'required|exists:route_schedules,id',

      'seats' => 'required|array',

      'seats.*' => 'exists:seats,id',

    ]);


    $schedule = RouteSchedule::findOrFail(
      $validated['route_schedule_id']
    );


    $booking = Booking::create([

      'user_id' => $validated['user_id'],

      'route_schedule_id' => $validated['route_schedule_id'],

      'total_price' => count($validated['seats']) * $schedule->price,

      'status' => 'pending',

    ]);


    $booking->seats()->attach(
      $validated['seats']
    );


    Seat::whereIn('id', $validated['seats'])
      ->update([
        'status' => 'booked'
      ]);


    return response()->json([
      'success' => true
    ]);
  }

  public function update(Request $request, Booking $booking)
  {

    $validated = $request->validate([

      'user_id' => 'required|exists:users,id',

      'route_schedule_id' => 'required|exists:route_schedules,id',

      'seats' => 'required|array',

      'seats.*' => 'exists:seats,id',

      'status' => 'required|in:pending,confirmed,cancelled',

    ]);


    $schedule = RouteSchedule::findOrFail(
      $validated['route_schedule_id']
    );


    $booking->update([

      'user_id' => $validated['user_id'],

      'route_schedule_id' => $validated['route_schedule_id'],

      'total_price' => count($validated['seats']) * $schedule->price,

      'status' => $validated['status']

    ]);


    $booking->seats()->sync(
      $validated['seats']
    );


    return response()->json([
      'success' => true
    ]);

  }

  public function destroy(Booking $booking)
  {
    $booking->delete();

    return response()->json([
      'success' => true,
      'message' => 'Booking deleted successfully.'
    ]);
  }

}