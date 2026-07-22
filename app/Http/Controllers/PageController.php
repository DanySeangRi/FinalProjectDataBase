<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\RouteSchedule;
use App\Models\Booking;

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
    ])
      ->findOrFail($request->schedule);


    $reservedSeats = Booking::where(
      'route_schedule_id',
      $schedule->id
    )
      ->whereIn('status', [
        'pending',
        'confirmed'
      ])
      ->pluck('seat_number')
      ->flatMap(function ($seats) {

        return explode(',', $seats);

      })
      ->toArray();


    return view('pages.booking.seats', [
      'schedule' => $schedule,
      'reservedSeats' => $reservedSeats
    ]);
  }

  public function storePassenger(Request $request)
  {

    if (auth()->check()) {

      $data = [
        'first_name' => auth()->user()->first_name,
        'last_name' => auth()->user()->last_name,
        'email' => auth()->user()->email,
        'phone' => auth()->user()->phone_number,
      ];

    } else {

      $data = $request->validate([

        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',

      ]);

    }


    return redirect()
      ->route('payment', [
        'schedule' => $request->schedule,
        'seats' => $request->seats
      ]);

  }
  public function passenger(Request $request)
  {

    $schedule = RouteSchedule::with([
      'route',
      'vehicle'
    ])
      ->findOrFail($request->schedule);


    $seats = explode(',', $request->seats);


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
    ])
      ->findOrFail($request->schedule);


    $seats = explode(',', $request->seats);


    return view('pages.booking.payment', [

      'schedule' => $schedule,

      'seats' => $seats

    ]);

  }

  public function processPayment(Request $request)
  {

    $validated = $request->validate([

      'schedule' => 'required',
      'seats' => 'required',
      'payment_method' => 'required',

    ]);



    $schedule = RouteSchedule::findOrFail(
      $request->schedule
    );


    $seats = explode(',', $request->seats);



    $user = auth()->user();



    $booking = Booking::create([

      'user_id' => $user->id,

      'first_name' => $user->first_name,

      'last_name' => $user->last_name,

      'email' => $user->email,

      'phone' => $user->phone_number,


      'route_schedule_id' => $schedule->id,

      'seat_number' => implode(',', $seats),

      'total_price' => count($seats) * $schedule->price,

      'status' => 'confirmed',

      'booking_code' => 'MN' . str_pad(
        Booking::count() + 1,
        6,
        '0',
        STR_PAD_LEFT
      ),

    ]);



    return redirect()
      ->route('booking.success', $booking->id);

  }
  public function success($id)
  {
    $booking = Booking::with([
      'routeSchedule.route',
      'routeSchedule.vehicle'
    ])->findOrFail($id);


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