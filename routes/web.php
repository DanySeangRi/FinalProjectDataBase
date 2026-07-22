<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookTripController;
Route::get('/', function () {
    return view('index');
});

Route::get('/booktrip', [BookTripController::class, 'findSched']);
Route::get('/booktrip/select/{scheduleID}', [BookTripController::class, 'selectSched']);
Route::get('/booktrip/select-seat/{scheduleID}', [BookTripController::class, 'selectSeat']);
Route::get('/booktrip/fill-info/{scheduleID}', [BookTripController::class, 'fillInfo']);

