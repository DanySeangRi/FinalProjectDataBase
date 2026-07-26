<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\RouteSchedule;
use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\Seat;
class PageController extends Controller
{

  public function home()
  {

    $locations = Route::select('origin')
      ->union(
        Route::select('destination')
      )
      ->distinct()
      ->pluck('origin');


    return view('home', compact('locations'));

  }




  public function about()
  {
    return view('pages.about');
  }




  public function contact()
  {
    return view('pages.contact-us');
  }






 public function seats(Request $request)
{
    $schedule = RouteSchedule::with([
        'route',
        'vehicle'
    ])->findOrFail($request->schedule);

    $availableSeats = Seat::where('vehicle_id', $schedule->vehicle_id)
        ->orderBy('seat_number')
        ->get();

    $bookedSeatIds = BookingSeat::where('route_schedule_id', $schedule->id)
        ->where('status', 'confirmed')
        ->pluck('seat_id')
        ->all();

    $selectedSeats = [];

    if($request->filled('seats')){
        $selectedSeats = explode(',', $request->seats);
    }


    return view('pages.booking.seats', [
        'schedule' => $schedule,
        'seats' => $availableSeats->map(function ($seat) use ($bookedSeatIds) {
            $seat->status = in_array($seat->id, $bookedSeatIds, true) ? 'booked' : 'available';

            return $seat;
        }),
        'selectedSeats' => $selectedSeats,
    ]);
}

  public function storePassenger(Request $request)
  {
    $data = auth()->check()
        ? [
            'first_name' => auth()->user()->first_name,
            'last_name' => auth()->user()->last_name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone_number,
        ]
        : $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

    $request->session()->put('booking.customer', $data);

    return redirect()
      ->route('payment', [
        'schedule' => $request->schedule,
        'seats' => $request->seats
      ]);

  }
  // public function passenger(Request $request)
  // {

  //   $schedule = RouteSchedule::with([
  //     'route',
  //     'vehicle'
  //   ])
  //     ->findOrFail($request->schedule);
  //     $seatIds = explode(',', $request->seats);


  //   $seats = Seat::whereIn('id', $seatIds)->get();


  //   return view('pages.booking.passenger', [

  //     'schedule' => $schedule,

  //     'seats' => $seats

  //   ]);

  // }
  public function passenger(Request $request)
{
    $schedule = RouteSchedule::with([
        'route',
        'vehicle'
    ])
    ->findOrFail($request->schedule);


    $seatIds = explode(',', $request->seats);
    $seats = Seat::whereIn('id', $seatIds)->get();


    return view('pages.booking.passenger', [
        'schedule' => $schedule,
        'seats' => $seats
    ]);
}

public function payment(Request $request)
{
    $schedule = RouteSchedule::with([
        'route',
        'vehicle'
    ])->findOrFail($request->schedule);


    $seatIds = explode(',', $request->seats);

    $seats = Seat::whereIn('id', $seatIds)->get();


    return view('pages.booking.payment', [
        'schedule' => $schedule,
        'seats' => $seats,
    ]);
}

  public function processPayment(Request $request)
  {
    return app(BookingController::class)->store($request);
  }
  public function success($id)
  {
    $booking = Booking::with([

      'routeSchedule.route',

      'routeSchedule.vehicle',

      'seats',
      'payment'

    ])
      ->findOrFail($id);


    return view('pages.booking.success', compact('booking'));
  }
  public function bookTrip(Request $request)
  {

    // Autocomplete locations

    $locations = Route::select('origin')
      ->union(
        Route::select('destination')
      )
      ->distinct()
      ->pluck('origin');



    // Default empty result

    $schedules = collect();



    // Search only when user submits

    if ($request->filled(['from', 'to'])) {


      $schedules = RouteSchedule::with([
        'route',
        'vehicle'
      ])
        ->whereHas('route', function ($query) use ($request) {


          $query
            ->where('origin', 'ILIKE', '%' . $request->from . '%')
            ->where('destination', 'ILIKE', '%' . $request->to . '%');


        })
        ->when($request->date, function ($query) use ($request) {


          $query->whereDate(
            'travel_date',
            $request->date
          );


        })
        ->where('status', 'active')
        ->get();


    }




    return view('pages.book-trip', [

      'locations' => $locations,

      'schedules' => $schedules,

      'hideFooter' => true

    ]);

  }


}