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
        $totalUsers = User::count();

        $totalRoutes = Route::count();

        $totalVehicles = Vehicle::count();

        $totalSchedules = RouteSchedule::count();

        $todaySchedules = RouteSchedule::whereDate('travel_date', today())->count();

        $todayBookings = Booking::whereDate('created_at', today())->count();

        $pendingBookings = Booking::where('status', 'Pending')->count();

        $totalRevenue = Booking::sum('total_price');

        $todayRevenue = Booking::whereDate('created_at', today())
            ->sum('total_price');

        $recentBookings = Booking::with([
            'user',
            'routeSchedule.route'
        ])
            ->latest()
            ->take(5)
            ->get();

        $upcomingTrips = RouteSchedule::with([
            'route',
            'vehicle'
        ])
            ->whereDate('travel_date', '>=', today())
            ->orderBy('travel_date')
            ->orderBy('departure_time')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalRoutes',
            'totalVehicles',
            'totalSchedules',
            'todaySchedules',
            'todayBookings',
            'pendingBookings',
            'totalRevenue',
            'todayRevenue',
            'recentBookings',
            'upcomingTrips'
        ));
    }
}