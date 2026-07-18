<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\RouteController;
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
        // Users
    
        // Users
        Route::get('/users', [UserController::class, 'index'])
            ->name('users');

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
        Route::get('/bookings', function () {
            return view('admin.bookings.index');
        })->name('bookings');


        // Settings
        Route::get('/settings', function () {
            return view('admin.settings.index');
        })->name('settings');

    });