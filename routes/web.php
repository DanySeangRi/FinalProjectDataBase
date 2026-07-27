<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\RouteScheduleController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')
    ->name('user.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [UserProfileController::class, 'index'])
            ->name('profile');
        Route::put('/profile', [UserProfileController::class, 'update'])
            ->name('profile.update');
        Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])
            ->name('profile.password');

        Route::get('/bookings', [UserBookingController::class, 'index'])
            ->name('bookings');
        Route::get('/bookings/{booking}', [UserBookingController::class, 'show'])
            ->name('bookings.show');
        Route::patch('/bookings/{booking}/cancel', [UserBookingController::class, 'cancel'])
            ->name('bookings.cancel');
        Route::patch('/bookings/{booking}/confirm', [UserBookingController::class, 'confirm'])
            ->name('bookings.confirm');
    });

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/search-trip', [HomeController::class, 'search'])
    ->name('search.trip');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [UserController::class, 'register']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');

Route::get('/about', [PageController::class, 'about'])
    ->name('about');

Route::get('/contact', [PageController::class, 'contact'])
    ->name('contact');

Route::get('/book-trip', [PageController::class, 'bookTrip'])
    ->name('bookTrip');

Route::get('/booking/seats', [PageController::class, 'seats'])
    ->name('seats');

Route::get('/booking/passenger', [PageController::class, 'passenger'])
    ->name('passenger');

Route::post('/booking/passenger', [PageController::class, 'storePassenger'])
    ->name('passenger.store');

Route::get('/booking/payment', [PageController::class, 'payment'])
    ->name('payment');

Route::post('/booking/payment', [PageController::class, 'processPayment'])
    ->name('payment.process');

Route::get('/booking/success/{id}', [PageController::class, 'success'])
    ->name('booking.success');

Route::get('/admin/login', [AdminController::class, 'showLogin'])
    ->name('admin.auth.login');

Route::post('/admin/login', [AdminController::class, 'login'])
    ->name('admin.auth.login.submit');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');

        Route::post('/logout', [AdminController::class, 'logout'])
            ->name('logout');

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

        Route::get('/routes', [RouteController::class, 'index'])
            ->name('routes');
        Route::post('/routes', [RouteController::class, 'store'])
            ->name('routes.store');
        Route::put('/routes/{route}', [RouteController::class, 'update'])
            ->name('routes.update');
        Route::delete('/routes/{route}', [RouteController::class, 'destroy'])
            ->name('routes.destroy');

        Route::get('/schedules', [RouteScheduleController::class, 'index'])
            ->name('schedules');
        Route::post('/schedules', [RouteScheduleController::class, 'store'])
            ->name('schedules.store');
        Route::put('/schedules/{routeSchedule}', [RouteScheduleController::class, 'update'])
            ->name('schedules.update');
        Route::delete('/schedules/{routeSchedule}', [RouteScheduleController::class, 'destroy'])
            ->name('schedules.destroy');

        Route::get('/vehicles', [VehicleController::class, 'index'])
            ->name('vehicles');
        Route::post('/vehicles', [VehicleController::class, 'store'])
            ->name('vehicles.store');
        Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])
            ->name('vehicles.update');
        Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])
            ->name('vehicles.destroy');

        Route::get('/bookings', [BookingController::class, 'index'])
            ->name('bookings');
        Route::post('/bookings', [BookingController::class, 'store'])
            ->name('bookings.store');
        Route::put('/bookings/{booking}', [BookingController::class, 'update'])
            ->name('bookings.update');
        Route::patch('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])
            ->name('bookings.confirm');
        Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])
            ->name('bookings.cancel');
        Route::patch('/bookings/{booking}/complete', [BookingController::class, 'complete'])
            ->name('bookings.complete');
        Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
            ->name('bookings.destroy');

        Route::get('/profile', [AdminProfileController::class, 'index'])
            ->name('profile');
        Route::put('/profile', [AdminProfileController::class, 'update'])
            ->name('profile.update');
        Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])
            ->name('profile.password');

        Route::redirect('/settings', '/admin/profile')->name('settings');
    });
