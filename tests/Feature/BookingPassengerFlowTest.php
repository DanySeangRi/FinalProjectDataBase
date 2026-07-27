<?php

use App\Http\Controllers\BookingController;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Route;
use App\Models\RouteSchedule;
use App\Models\Seat;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

it('stores passenger details in booking details when a booking is created', function () {
    $user = User::factory()->create([
        'role' => 'user',
        'password' => Hash::make('password123'),
    ]);

    $route = Route::create([
        'origin' => 'Siem Reap',
        'destination' => 'Phnom Penh',
        'distance' => 320,
        'duration_minutes' => 420,
        'status' => 'active',
    ]);

    $vehicle = Vehicle::create([
        'vehicle_number' => 'BUS-001',
        'brand' => 'Mekong',
        'plate_number' => 'ABC-123',
        'type' => 'Luxury',
        'year' => 2024,
        'capacity' => 24,
        'status' => 'active',
    ]);

    $seat = Seat::create([
        'vehicle_id' => $vehicle->id,
        'seat_number' => '1A',
    ]);

    $schedule = RouteSchedule::create([
        'route_id' => $route->id,
        'vehicle_id' => $vehicle->id,
        'travel_date' => '2026-08-01',
        'departure_time' => '08:00',
        'arrival_time' => '14:00',
        'price' => 18.50,
        'status' => 'active',
    ]);

    $request = new Request([
        'schedule' => $schedule->id,
        'seats' => (string) $seat->id,
        'payment_method' => 'cash',
    ]);

    $request->setLaravelSession(app('session.store'));
    $request->session()->put('booking.customer', [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'phone' => '012345678',
        'passenger_name' => 'John Doe',
        'gender' => 'male',
        'identity_number' => 'ID-1024',
        'seat_number' => '1A',
    ]);

    $this->actingAs($user);

    $response = app(BookingController::class)->store($request);

    $booking = Booking::latest('id')->first();
    $detail = $booking->details()->latest('id')->first();

    expect($response->getStatusCode())->toBe(302)
        ->and($detail->passenger_name)->toBe('John Doe')
        ->and($detail->gender)->toBe('male')
        ->and($detail->identity_number)->toBe('ID-1024')
        ->and($detail->seat_number)->toBe('1A');
});
