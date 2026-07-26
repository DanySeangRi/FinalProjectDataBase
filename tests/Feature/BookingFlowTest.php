<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Payment;
use App\Models\Route;
use App\Models\RouteSchedule;
use App\Models\Seat;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_booking_and_payment_for_a_selected_seat(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $route = Route::create([
            'origin' => 'Phnom Penh',
            'destination' => 'Siem Reap',
            'distance' => 320,
            'duration_minutes' => 360,
            'status' => 'active',
        ]);

        $vehicle = Vehicle::create([
            'vehicle_number' => 'AT-100',
            'plate_number' => 'PP-1000',
            'brand' => 'Hyundai',
            'type' => 'VIP',
            'year' => 2024,
            'capacity' => 30,
            'status' => 'active',
        ]);

        $schedule = RouteSchedule::create([
            'route_id' => $route->id,
            'vehicle_id' => $vehicle->id,
            'travel_date' => now()->addDay()->toDateString(),
            'departure_time' => '08:00:00',
            'arrival_time' => '12:30:00',
            'price' => 18.50,
            'status' => 'active',
        ]);

        $seat = Seat::create([
            'vehicle_id' => $vehicle->id,
            'seat_number' => '1A',
        ]);

        $response = $this
            ->actingAs($user)
            ->withSession([
                'booking.customer' => [
                    'first_name' => 'Sokha',
                    'last_name' => 'Chenda',
                    'email' => 'sokha@example.com',
                    'phone' => '012345678',
                ],
            ])
            ->post('/booking/payment', [
                'schedule' => $schedule->id,
                'seats' => (string) $seat->id,
                'payment_method' => 'card',
            ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $booking = Booking::query()->where('route_schedule_id', $schedule->id)->first();
        $this->assertNotNull($booking);
        $this->assertSame(18.50, (float) $booking->total_price);

        $bookingDetail = BookingDetail::query()->where('booking_id', $booking->id)->first();
        $this->assertNotNull($bookingDetail);
        $this->assertSame('Sokha', $bookingDetail->first_name);
        $this->assertSame('Chenda', $bookingDetail->last_name);

        $payment = Payment::query()->where('booking_id', $booking->id)->first();
        $this->assertNotNull($payment);
        $this->assertSame('successful', $payment->payment_status);
    }
}
