<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $bookings = Booking::with([
            'routeSchedule.route',
            'routeSchedule.vehicle'
        ])
        ->where('user_id', $user->id)
        ->latest()
        ->get();


        return view('user.bookings.index', compact('bookings'));
    }
}