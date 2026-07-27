<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Route;
use App\Models\Vehicle;
use App\Models\RouteSchedule;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalUsers = User::count();

        $totalRoutes = Route::count();

        $activeRoutes = Route::where('status', 'active')->count();


        $totalVehicles = Vehicle::count();

        $activeVehicles = Vehicle::where('status', 'active')->count();


        $totalSchedules = RouteSchedule::count();

        $todaySchedules = RouteSchedule::whereDate(
            'travel_date',
            today()
        )->count();


        // Bookings
        $totalBookings = Booking::count();

        $todayBookings = Booking::whereDate(
            'created_at',
            today()
        )->count();


        $pendingBookings = Booking::where(
            'status',
            'pending'
        )->count();


        $confirmedBookings = Booking::where(
            'status',
            'confirmed'
        )->count();


        $completedBookings = Booking::where(
            'status',
            'completed'
        )->count();


        $cancelledBookings = Booking::where(
            'status',
            'cancelled'
        )->count();



        // Revenue
        $totalRevenue = Booking::whereIn(
            'status',
            [
                'confirmed',
                'completed'
            ]
        )->sum('total_price');


        $todayRevenue = Booking::whereIn(
            'status',
            [
                'confirmed',
                'completed'
            ]
        )
        ->whereDate('created_at', today())
        ->sum('total_price');



        // Recent bookings
        $recentBookings = Booking::with([
            'user',
            'routeSchedule.route'
        ])
        ->latest()
        ->take(5)
        ->get();



        // Upcoming trips
        $upcomingTrips = RouteSchedule::with([
            'route',
            'vehicle'
        ])
        ->whereDate(
            'travel_date',
            '>=',
            today()
        )
        ->orderBy('travel_date')
        ->orderBy('departure_time')
        ->take(5)
        ->get();



        return view(
            'admin.dashboard.index',
            compact(
                'totalUsers',
                'totalRoutes',
                'activeRoutes',
                'totalVehicles',
                'activeVehicles',
                'totalSchedules',
                'todaySchedules',

                'totalBookings',
                'todayBookings',

                'pendingBookings',
                'confirmedBookings',
                'completedBookings',
                'cancelledBookings',

                'totalRevenue',
                'todayRevenue',

                'recentBookings',
                'upcomingTrips'
            )
        );
    }
}