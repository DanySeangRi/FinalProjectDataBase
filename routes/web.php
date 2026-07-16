<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminController;

// Home
Route::get('/', function () {
    return view('welcome');
});


// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [UserController::class, 'register']);


// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [UserController::class, 'login']);


// User Logout
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');


// =========================
// Admin Authentication
// =========================

Route::get('/admin/login', [AdminController::class, 'showLogin'])
    ->name('admin.auth.login');

Route::post('/admin/login', [AdminController::class, 'login'])
    ->name('admin.auth.login.submit');


// =========================
// Admin Protected Area
// =========================

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');


        // Admin Logout
        Route::post('/logout', [AdminController::class, 'logout'])
            ->name('logout');


        // Users
        Route::get('/users', function (\Illuminate\Http\Request $request) {

            $search = $request->query('search');

            $users = \App\Models\User::query()
                ->when($search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('first_name', 'ilike', "%{$search}%")
                            ->orWhere('last_name', 'ilike', "%{$search}%")
                            ->orWhere('email', 'ilike', "%{$search}%");
                    });
                })
                ->latest()
                ->paginate(15)
                ->withQueryString();

            return view('admin.users.index', compact('users', 'search'));

        })->name('users');


        // Routes
        Route::get('/routes', function () {
            return view('admin.routes.index');
        })->name('routes');


        // Schedules
        Route::get('/schedules', function () {
            return view('admin.schedules.index');
        })->name('schedules');


        // Vehicles
        Route::get('/vehicles', function () {
            return view('admin.vehicles.index');
        })->name('vehicles');


        // Bookings
        Route::get('/bookings', function () {
            return view('admin.bookings.index');
        })->name('bookings');


        // Settings
        Route::get('/settings', function () {
            return view('admin.settings.index');
        })->name('settings');

    });