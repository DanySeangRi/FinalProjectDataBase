<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\User;
use App\Models\RouteSchedule;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\BookingSeat;

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

      'seats' => 'nullable|array',

      'seats.*' => 'exists:seats,id',

      'seat_number' => 'nullable|string',

    ]);


    $schedule = RouteSchedule::findOrFail(
      $validated['route_schedule_id']
    );

    $seatIds = [];

    if (!empty($validated['seats'])) {
      $seatIds = $validated['seats'];
    } elseif (!empty($validated['seat_number'])) {
      $seat = Seat::where('vehicle_id', $schedule->vehicle_id)
          ->where('seat_number', $validated['seat_number'])
          ->first();

      if ($seat) {
        $seatIds = [$seat->id];
      }
    }

    if (empty($seatIds)) {
      return response()->json([
        'success' => false,
        'message' => 'Please select at least one seat.',
      ], 422);
    }


    $bookingUser = User::find($validated['user_id']);

    $booking = Booking::create([
      'user_id' => $validated['user_id'],
      'route_schedule_id' => $validated['route_schedule_id'],
      'total_price' => count($seatIds) * $schedule->price,
      'status' => 'pending',
    ]);

    BookingDetail::create([
      'booking_id' => $booking->id,
      'first_name' => $bookingUser->first_name ?? 'Guest',
      'last_name' => $bookingUser->last_name ?? 'Guest',
      'email' => $bookingUser->email ?? 'guest@example.com',
      'phone' => $bookingUser->phone_number ?? '000000000',
      'price' => $booking->total_price,
    ]);

    foreach ($seatIds as $seatId) {
      $booking->bookingSeats()->create([
        'seat_id' => $seatId,
        'route_schedule_id' => $validated['route_schedule_id'],
        'status' => 'confirmed',
      ]);
    }


    return response()->json([
      'success' => true
    ]);
  }

  public function update(Request $request, Booking $booking)
  {

    $validated = $request->validate([

      'user_id' => 'required|exists:users,id',

      'route_schedule_id' => 'required|exists:route_schedules,id',

      'seats' => 'nullable|array',

      'seats.*' => 'exists:seats,id',

      'seat_number' => 'nullable|string',

      'status' => 'required|in:pending,confirmed,cancelled',

    ]);


    $schedule = RouteSchedule::findOrFail(
      $validated['route_schedule_id']
    );

    $seatIds = [];

    if (!empty($validated['seats'])) {
      $seatIds = $validated['seats'];
    } elseif (!empty($validated['seat_number'])) {
      $seat = Seat::where('vehicle_id', $schedule->vehicle_id)
          ->where('seat_number', $validated['seat_number'])
          ->first();

      if ($seat) {
        $seatIds = [$seat->id];
      }
    }

    if (empty($seatIds)) {
      return response()->json([
        'success' => false,
        'message' => 'Please select at least one seat.',
      ], 422);
    }

    $bookingUser = User::find($validated['user_id']);

    $booking->update([

      'user_id' => $validated['user_id'],

      'route_schedule_id' => $validated['route_schedule_id'],

      'total_price' => count($seatIds) * $schedule->price,

      'status' => $validated['status']

    ]);


    $booking->bookingSeats()->delete();

    foreach ($seatIds as $seatId) {
      $booking->bookingSeats()->create([
        'seat_id' => $seatId,
        'route_schedule_id' => $validated['route_schedule_id'],
        'status' => 'confirmed',
      ]);
    }


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