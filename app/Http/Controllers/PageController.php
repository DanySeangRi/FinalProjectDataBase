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
    $data = $request->validate([

        'first_name' => 'required|string|max:255',

        'last_name' => 'required|string|max:255',
        'dob' => 'nullable|date',

        'gender' => 'nullable|string',

        'nationality' => 'nullable|string',

        'id_passport' => 'nullable|string',
       
        'email' => 'required|email',

        'phone' => 'required|string',

        'schedule' => 'required|exists:route_schedules,id',

        'seats' => 'required|string',

    ]);


    // If user logged in, use account information
    if(auth()->check()){

    $data['user_id'] = auth()->id();

    $data['first_name'] = auth()->user()->first_name;

    $data['last_name'] = auth()->user()->last_name;

    $data['email'] = auth()->user()->email;

    $data['phone'] = auth()->user()->phone_number;

}


    // Save passenger data temporarily
    session()->put(
        'booking.passenger',
        $data
    );


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


    $passenger = session('booking.passenger');


    return view('pages.booking.payment', [
        'schedule' => $schedule,
        'seats' => $seats,
        'passenger' => $passenger
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