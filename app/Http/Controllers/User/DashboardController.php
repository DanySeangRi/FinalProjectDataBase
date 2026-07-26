<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Statistics
        $totalBookings = Booking::where('user_id', $user->id)->count();

        $upcomingTrips = Booking::where('user_id', $user->id)
            ->whereHas('routeSchedule', function ($query) {
                $query->whereDate('travel_date', '>=', today());
            })
            ->count();

        $completedTrips = Booking::where('user_id', $user->id)
            ->where('status', 'Completed')
            ->count();

        $cancelledBookings = Booking::where('user_id', $user->id)
            ->where('status', 'Cancelled')
            ->count();

        $totalSpent = Booking::where('user_id', $user->id)
            ->where('status', 'Completed')
            ->sum('total_price');

        // Recent bookings
        $recentBookings = Booking::with([
                'routeSchedule.route',
                'routeSchedule.vehicle',
            ])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Upcoming trips
        $nextTrips = Booking::with([
                'routeSchedule.route',
                'routeSchedule.vehicle',
            ])
            ->where('user_id', $user->id)
            ->whereHas('routeSchedule', function ($query) {
                $query->whereDate('travel_date', '>=', today());
            })
            ->orderBy('created_at')
            ->take(5)
            ->get();

        return view('user.dashboard.index', compact(
            'totalBookings',
            'upcomingTrips',
            'completedTrips',
            'cancelledBookings',
            'totalSpent',
            'recentBookings',
            'nextTrips'
        ));
    }
}