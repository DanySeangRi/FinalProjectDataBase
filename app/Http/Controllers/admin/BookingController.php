<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\RouteSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{


  public function index(Request $request)
  {
    $search = $request->search;

    $bookings = Booking::with([
      
      'user',
      'routeSchedule.route',
      'routeSchedule.vehicle',
    ])

      ->when($search, function ($query) use ($search) {

        $query->where(function ($q) use ($search) {

          $q->where('booking_code', 'ILIKE', "%{$search}%")

            ->orWhere('seat_number', 'ILIKE', "%{$search}%")

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

      'seat_number' => 'required|string|max:10',

    ]);

    $schedule = RouteSchedule::findOrFail(
      $validated['route_schedule_id']
    );

    $validated['total_price'] = $schedule->price;

    $validated['booking_code'] =
      'MN' . str_pad(
        Booking::count() + 1,
        6,
        '0',
        STR_PAD_LEFT
      );

    $validated['status'] = 'pending';

    Booking::create($validated);

    return response()->json([
      'success' => true
    ]);
  }

  public function update(Request $request, Booking $booking)
  {
    $validated = $request->validate([

      'user_id' => 'required|exists:users,id',

      'route_schedule_id' => 'required|exists:route_schedules,id',

      'seat_number' => 'required|string|max:10',

      'status' => 'required|in:pending,confirmed,cancelled',

    ]);

    $schedule = RouteSchedule::findOrFail(
      $validated['route_schedule_id']
    );

    $validated['total_price'] = $schedule->price;

    $booking->update($validated);

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