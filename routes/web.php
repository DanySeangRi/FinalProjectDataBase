<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


// // Dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');


// Logout
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');



// Admin Authentication
Route::get('/admin/login', [AdminController::class, 'showLogin'])
    ->name('admin.auth.login');

Route::post('/admin/login', [AdminController::class, 'login'])
    ->name('admin.auth.login.submit');


// Admin Protected Area
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::post('/logout', [AdminController::class, 'logout'])
        ->name('admin.logout');

});