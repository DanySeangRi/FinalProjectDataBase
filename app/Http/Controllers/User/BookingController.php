<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = auth()->user()
            ->bookings()
            ->with([
                'routeSchedule.route',
                'routeSchedule.vehicle',
                'details.seat',
                'seats',
            ])
            ->latest()
            ->get();

        return view('user.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking): View
    {
        abort_unless($booking->user_id === auth()->id(), 403);

        $booking->load([
            'routeSchedule.route',
            'routeSchedule.vehicle',
            'details.seat',
            'seats',
            'payment',
        ]);

        return view('user.bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === auth()->id(), 403);

        if (! $booking->isPending()) {
            return back()->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function confirm(Booking $booking): RedirectResponse
    {
        abort_unless($booking->user_id === auth()->id(), 403);

        if (! $booking->isPending()) {
            return back()->with('error', 'Only pending bookings can be confirmed.');
        }

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking confirmed successfully.');
    }
}
