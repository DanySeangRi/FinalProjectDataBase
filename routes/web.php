<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\RouteScheduleController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController ;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BookingController as UserBookingController;

 
Route::prefix('user')
    ->name('user.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', function () {
            return view('user.profile');
        })->name('profile');

      Route::get('/bookings', [UserBookingController::class, 'index'])
    ->name('bookings');

});

// Home
Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/search-trip', [HomeController::class, 'search'])
    ->name('search.trip');

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

//page



Route::get('/about', [PageController::class, 'about'])
    ->name('about');





Route::get('/contact', [PageController::class, 'contact'])
    ->name('contact');


Route::get('/book-trip', [PageController::class, 'bookTrip'])
    ->name('bookTrip');




//seats
Route::get('/booking/seats', [PageController::class, 'seats'])
    ->name('seats');

Route::get('/booking/passenger', [PageController::class, 'passenger'])
    ->name('passenger');

Route::post('/booking/passenger', [PageController::class, 'storePassenger'])
    ->name('passenger.store');

// Payment page
Route::get('/booking/payment', [PageController::class, 'payment'])
    ->name('payment');


// Process payment
Route::post('/booking/payment', [PageController::class, 'processPayment'])
    ->name('payment.process');

Route::get('/booking/success/{id}', 
    [PageController::class,'success']
)->name('booking.success');

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
  ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');


        // Admin Logout
        Route::post('/logout', [AdminController::class, 'logout'])
            ->name('logout');


        // Users
        // Users
    
        // Users
        Route::get('/users', [UserController::class, 'index'])
            ->name('users');

        Route::get('/users/{id}/booking', [UserController::class, 'bookingHistory'])
            ->name('users.booking');

        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');

        Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('users.update');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');



        // Routes CRUD
    
        Route::get('/routes', [RouteController::class, 'index'])
            ->name('routes');

        Route::post('/routes', [RouteController::class, 'store'])
            ->name('routes.store');

        Route::put('/routes/{route}', [RouteController::class, 'update'])
            ->name('routes.update');

        Route::delete('/routes/{route}', [RouteController::class, 'destroy'])
            ->name('routes.destroy');

        // Route Schedules
    
        Route::get('/schedules', [RouteScheduleController::class, 'index'])
            ->name('schedules');


        Route::post('/schedules', [RouteScheduleController::class, 'store'])
            ->name('schedules.store');


        Route::put('/schedules/{routeSchedule}', [RouteScheduleController::class, 'update'])
            ->name('schedules.update');


        Route::delete('/schedules/{routeSchedule}', [RouteScheduleController::class, 'destroy'])
            ->name('schedules.destroy');




        // Vehicles
        Route::get('/vehicles', [VehicleController::class, 'index'])
            ->name('vehicles');

        Route::post('/vehicles', [VehicleController::class, 'store'])
            ->name('vehicles.store');

        Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])
            ->name('vehicles.update');

        Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])
            ->name('vehicles.destroy');


        // Bookings
        Route::get('/bookings', [BookingController::class, 'index'])
            ->name('bookings');

        Route::post('/bookings', [BookingController::class, 'store'])
            ->name('bookings.store');

        Route::put('/bookings/{booking}', [BookingController::class, 'update'])
            ->name('bookings.update');

        Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
            ->name('bookings.destroy');


        // Settings
        Route::get('/settings', function () {
            return view('admin.settings.index');
        })->name('settings');

    });