<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\RouteSchedule;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $bookings = Booking::with([
            'user',
            'routeSchedule.route',
            'routeSchedule.vehicle',
            'seats',
            'bookingSeats',
        ])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('booking_code', 'ILIKE', "%{$search}%")
                        ->orWhereHas('seats', fn ($seat) => $seat->where('seat_number', 'ILIKE', "%{$search}%"))
                        ->orWhereHas('user', function ($user) use ($search) {
                            $user->where('first_name', 'ILIKE', "%{$search}%")
                                ->orWhere('last_name', 'ILIKE', "%{$search}%");
                        })
                        ->orWhereHas('routeSchedule.route', function ($route) use ($search) {
                            $route->where('origin', 'ILIKE', "%{$search}%")
                                ->orWhere('destination', 'ILIKE', "%{$search}%");
                        })
                        ->orWhereHas('routeSchedule.vehicle', fn ($vehicle) => $vehicle->where('vehicle_number', 'ILIKE', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $users = User::where('role', 'user')->get();

        $schedules = RouteSchedule::with([
            'route',
            'vehicle',
        ])->get();

        return view('admin.bookings.index', compact(
            'bookings',
            'users',
            'schedules',
            'search',
            'status',
        ));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'route_schedule_id' => 'required|exists:route_schedules,id',
            'seats' => 'nullable|array',
            'seats.*' => 'exists:seats,id',
            'seat_number' => 'nullable|string',
        ]);

        $schedule = RouteSchedule::findOrFail($validated['route_schedule_id']);

        $seatIds = $this->resolveSeatIds($validated, $schedule);

        if (empty($seatIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Please select at least one seat.',
            ], 422);
        }

        $bookingUser = User::find($validated['user_id']);

        $booking = Booking::create([
            'user_id' => $validated['user_id'],
            'route_schedule_id' => $validated['route_schedule_id'],
            'total_price' => count($seatIds) * $schedule->price,
            'status' => 'pending',
        ]);

        BookingDetail::create([
            'booking_id' => $booking->id,
            'first_name' => $bookingUser->first_name ?? 'Guest',
            'last_name' => $bookingUser->last_name ?? 'Guest',
            'email' => $bookingUser->email ?? 'guest@example.com',
            'phone' => $bookingUser->phone_number ?? '000000000',
            'price' => $booking->total_price,
        ]);

        foreach ($seatIds as $seatId) {
            $booking->bookingSeats()->create([
                'seat_id' => $seatId,
                'route_schedule_id' => $validated['route_schedule_id'],
                'status' => 'confirmed',
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, Booking $booking): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'route_schedule_id' => 'required|exists:route_schedules,id',
            'seats' => 'nullable|array',
            'seats.*' => 'exists:seats,id',
            'seat_number' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $schedule = RouteSchedule::findOrFail($validated['route_schedule_id']);

        $seatIds = $this->resolveSeatIds($validated, $schedule);

        if (empty($seatIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Please select at least one seat.',
            ], 422);
        }

        $booking->update([
            'user_id' => $validated['user_id'],
            'route_schedule_id' => $validated['route_schedule_id'],
            'total_price' => count($seatIds) * $schedule->price,
            'status' => $validated['status'],
            'cancelled_at' => $validated['status'] === 'cancelled' ? now() : null,
        ]);

        $booking->bookingSeats()->delete();

        foreach ($seatIds as $seatId) {
            $booking->bookingSeats()->create([
                'seat_id' => $seatId,
                'route_schedule_id' => $validated['route_schedule_id'],
                'status' => 'confirmed',
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function confirm(Booking $booking): RedirectResponse
    {
        if (! $booking->isPending()) {
            return back()->with('error', 'Only pending bookings can be confirmed.');
        }

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking confirmed successfully.');
    }

    public function cancel(Booking $booking): RedirectResponse
    {
        if (! $booking->isPending()) {
            return back()->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function complete(Booking $booking): RedirectResponse
    {
        if (! $booking->isConfirmed()) {
            return back()->with('error', 'Only confirmed bookings can be marked as completed.');
        }

        $booking->update(['status' => 'completed']);

        return back()->with('success', 'Booking marked as completed.');
    }

    public function destroy(Booking $booking): JsonResponse
    {
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking deleted successfully.',
        ]);
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<int, int|string>
     */
    private function resolveSeatIds(array $validated, RouteSchedule $schedule): array
    {
        if (! empty($validated['seats'])) {
            return $validated['seats'];
        }

        if (! empty($validated['seat_number'])) {
            $seat = Seat::where('vehicle_id', $schedule->vehicle_id)
                ->where('seat_number', $validated['seat_number'])
                ->first();

            if ($seat) {
                return [$seat->id];
            }
        }

        return [];
    }
}
