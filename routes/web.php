<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// Home
Route::get('/', function () {
    return view('welcome');
});


// Register
Route::get('/register', function () {
    return view('admin.auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);


// Login
Route::get('/login', function () {
    return view('admin.auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);


// // Dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');


// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');