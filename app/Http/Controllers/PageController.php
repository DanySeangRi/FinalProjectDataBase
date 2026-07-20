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
    return view('pages.contact');
  }





  public function faq()
  {
    return view('pages.faq');
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
      ->pluck('seat_number');


    return view('pages.booking.seats', [
      'schedule' => $schedule,
      'reservedSeats' => $reservedSeats
    ]);
  }

public function storePassenger(Request $request)
{

    if(auth()->check()){

        $data = [
            'first_name'=>auth()->user()->first_name,
            'last_name'=>auth()->user()->last_name,
            'email'=>auth()->user()->email,
            'phone'=>auth()->user()->phone_number,
        ];

    }
    else{

        $data = $request->validate([

            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',

        ]);

    }


    return redirect()
        ->route('payment',[
            'schedule'=>$request->schedule,
            'seats'=>$request->seats
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