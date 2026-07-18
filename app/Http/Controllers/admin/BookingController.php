<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\RouteSchedule;
use Illuminate\Http\Request;


class BookingController extends Controller
{


  public function index(Request $request)
  {


    $bookings = Booking::with([

      'user',

      'routeSchedule.route',

      'routeSchedule.vehicle'

    ])
      ->latest()
      ->paginate(10);



    $users = User::where('role', 'user')->get();



    $schedules = RouteSchedule::with([

      'route',

      'vehicle'

    ])
      ->get();



    return view(
      'admin.bookings.index',
      compact(
        'bookings',
        'users',
        'schedules'
      )
    );


  }

}