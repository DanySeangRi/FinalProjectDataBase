@extends('layouts.user', ['active' => 'dashboard'])

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Welcome, {{ auth()->user()->name }}
            </h1>
            <p class="text-slate-500 mt-1">
                Here's an overview of your travel activity.
            </p>
        </div>

        <a href="{{ route('bookTrip') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-[#86C5FF] text-white font-medium hover:bg-blue-700 transition shadow-sm">
            Book New Trip
        </a>
    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-medium text-slate-500">Total Trips</p>
            <h2 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalBookings }}</h2>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-medium text-slate-500">Upcoming</p>
            <h2 class="text-3xl font-bold text-blue-600 mt-2">{{ $upcomingTrips }}</h2>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-medium text-slate-500">Completed</p>
            <h2 class="text-3xl font-bold text-green-600 mt-2">{{ $completedTrips }}</h2>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-medium text-slate-500">Spent</p>
            <h2 class="text-3xl font-bold text-slate-900 mt-2">${{ number_format($totalSpent, 2) }}</h2>
        </div>

    </div>

    {{-- Upcoming Trip Cards --}}
    <div>
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Upcoming Trips</h2>

        @if($nextTrips->isEmpty())
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-10 text-center text-slate-500">
                No upcoming trips scheduled.
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @foreach($nextTrips as $trip)
                    @php
                        $route = $trip->routeSchedule?->route;
                        $vehicle = $trip->routeSchedule?->vehicle;
                        $seatNumbers = $trip->seats->pluck('seat_number')
                            ->merge($trip->details->pluck('seat.seat_number')->filter())
                            ->unique()
                            ->implode(', ');
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'confirmed' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                            'completed' => 'bg-blue-100 text-blue-700',
                        ];
                    @endphp

                    <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-lg font-bold text-slate-800">
                                    {{ $route?->origin ?? 'N/A' }}
                                    <span class="text-blue-500 mx-1">→</span>
                                    {{ $route?->destination ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $trip->routeSchedule?->travel_date?->format('d M Y') ?? '-' }}
                                    · {{ $trip->routeSchedule?->departure_time ?? '-' }}
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$trip->status] ?? 'bg-slate-100 text-slate-600' }}">
                                {{ $trip->statusLabel() }}
                            </span>
                        </div>

                        <div class="space-y-2 text-sm text-slate-600">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Vehicle</span>
                                <span class="font-medium">{{ $vehicle?->plate_number ?? $vehicle?->vehicle_number ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Seat</span>
                                <span class="font-medium">{{ $seatNumbers ?: '-' }}</span>
                            </div>
                        </div>

                        <a href="{{ route('user.bookings.show', $trip) }}"
                            class="mt-4 inline-flex w-full items-center justify-center px-4 py-2 rounded-xl bg-blue-50 text-blue-600 text-sm font-medium hover:bg-blue-100 transition">
                            View Ticket
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Recent Bookings Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-lg text-slate-800">Recent Bookings</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs uppercase tracking-wider text-slate-500">
                        <th class="px-6 py-3 font-semibold">Booking ID</th>
                        <th class="px-6 py-3 font-semibold">Route</th>
                        <th class="px-6 py-3 font-semibold">Date</th>
                        <th class="px-6 py-3 font-semibold">Vehicle</th>
                        <th class="px-6 py-3 font-semibold">Price</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentBookings as $booking)
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'confirmed' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                'completed' => 'bg-blue-100 text-blue-700',
                            ];
                        @endphp
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $booking->booking_code }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->routeSchedule?->route?->origin ?? '-' }}
                                →
                                {{ $booking->routeSchedule?->route?->destination ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->routeSchedule?->travel_date?->format('d M Y') ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->routeSchedule?->vehicle?->plate_number ?? $booking->routeSchedule?->vehicle?->vehicle_number ?? '-' }}
                            </td>
                            <td class="px-6 py-4 font-semibold">
                                ${{ number_format($booking->total_price, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$booking->status] ?? 'bg-slate-100 text-slate-600' }}">
                                    {{ $booking->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('user.bookings.show', $booking) }}"
                                    class="text-blue-600 hover:text-blue-700 font-medium">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
