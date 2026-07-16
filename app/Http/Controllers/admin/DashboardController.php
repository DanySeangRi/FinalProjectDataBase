<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Replace with real queries, e.g.:
        // $totalUsers    = User::count();
        // $totalBookings = Booking::count();
        // $totalIncome   = Booking::sum('amount');
        // $totalRoutes   = Route::count();

        return view('admin.dashboard.index');
    }
}
