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