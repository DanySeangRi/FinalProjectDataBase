<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $bookingsQuery = $user->bookings()->with([
            'routeSchedule.route',
            'routeSchedule.vehicle',
            'details.seat',
            'seats',
        ]);

        $totalBookings = (clone $bookingsQuery)->count();

        $upcomingTrips = (clone $bookingsQuery)
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereHas('routeSchedule', fn ($query) => $query->whereDate('travel_date', '>=', today()))
            ->count();

        $completedTrips = (clone $bookingsQuery)
            ->where('status', 'completed')
            ->count();

        $cancelledBookings = (clone $bookingsQuery)
            ->where('status', 'cancelled')
            ->count();

        $totalSpent = (clone $bookingsQuery)
            ->whereIn('status', ['confirmed', 'completed'])
            ->sum('total_price');

        $recentBookings = (clone $bookingsQuery)
            ->latest()
            ->take(5)
            ->get();

        $nextTrips = (clone $bookingsQuery)
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereHas('routeSchedule', fn ($query) => $query->whereDate('travel_date', '>=', today()))
            ->with([
                'routeSchedule.route',
                'routeSchedule.vehicle',
                'details.seat',
                'seats',
            ])
            ->get()
            ->sortBy(fn (Booking $booking) => $booking->routeSchedule?->travel_date)
            ->take(3)
            ->values();

        return view('user.dashboard.index', compact(
            'totalBookings',
            'upcomingTrips',
            'completedTrips',
            'cancelledBookings',
            'totalSpent',
            'recentBookings',
            'nextTrips',
        ));
    }
}
