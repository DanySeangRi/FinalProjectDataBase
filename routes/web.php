<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookTripController;
Route::get('/', function () {
    return view('index');
});

Route::get('/booktrip', [BookTripController::class, 'findTrip']);
Route::get('/booktrip/select/{scheduleID}', [BookTripController::class, 'selectTrip']);