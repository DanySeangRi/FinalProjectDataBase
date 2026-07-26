<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingSeat;
use App\Models\Payment;
use App\Models\RouteSchedule;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule' => ['required', 'exists:route_schedules,id'],
            'seats' => ['required', 'string'],
            'payment_method' => ['required', 'string'],
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
        ]);

        $schedule = RouteSchedule::with('vehicle')->findOrFail($validated['schedule']);
        $seatIds = array_values(array_unique(array_filter(explode(',', $validated['seats']))));

        if (empty($seatIds)) {
            return back()->withErrors(['seats' => 'Please select at least one seat.']);
        }

        $vehicleSeats = Seat::where('vehicle_id', $schedule->vehicle_id)->pluck('id')->all();
        $selectedSeats = Seat::whereIn('id', $seatIds)
            ->whereIn('id', $vehicleSeats)
            ->get();

        if ($selectedSeats->count() !== count($seatIds)) {
            return back()->withErrors(['seats' => 'One or more selected seats are invalid.']);
        }

        $bookedSeatIds = BookingSeat::where('route_schedule_id', $schedule->id)
            ->where('status', 'confirmed')
            ->pluck('seat_id')
            ->all();

        $duplicateSeats = array_intersect($seatIds, $bookedSeatIds);
        if (!empty($duplicateSeats)) {
            return back()->withErrors(['seats' => 'One or more seats are already booked.']);
        }

        $sessionCustomer = $request->session()->get('booking.customer', []);
        $user = auth()->user();
        $customer = !empty($sessionCustomer)
            ? $sessionCustomer
            : ($user
                ? [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone_number,
                ]
                : []);

        if (empty($customer['first_name']) || empty($customer['last_name']) || empty($customer['email']) || empty($customer['phone'])) {
            return back()->withErrors(['customer' => 'Passenger details are missing.']);
        }

        return DB::transaction(function () use ($request, $schedule, $seatIds, $customer, $validated) {
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'route_schedule_id' => $schedule->id,
                'booking_code' => 'AT-' . Str::upper(Str::random(6)),
                'total_price' => count($seatIds) * $schedule->price,
                'status' => 'confirmed',
            ]);

            BookingDetail::create([
                'booking_id' => $booking->id,
                'first_name' => $customer['first_name'],
                'last_name' => $customer['last_name'],
                'phone' => $customer['phone'],
                'email' => $customer['email'],
                'price' => $booking->total_price,
            ]);

            foreach ($seatIds as $seatId) {
                BookingSeat::create([
                    'booking_id' => $booking->id,
                    'seat_id' => $seatId,
                    'route_schedule_id' => $schedule->id,
                    'status' => 'confirmed',
                ]);
            }

            Payment::create([
                'booking_id' => $booking->id,
                'amount_paid' => $booking->total_price,
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'successful',
                'transaction_id' => Str::upper(Str::random(10)),
                'paid_at' => now(),
            ]);

            return redirect()->route('booking.success', $booking->id);
        });
    }
}
