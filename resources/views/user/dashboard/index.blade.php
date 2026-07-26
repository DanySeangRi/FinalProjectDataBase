@extends('layouts.user', ['active' => 'dashboard'])

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- Welcome --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Welcome back, {{ auth()->user()->name }} 👋
            </h1>
            <p class="text-slate-500 mt-1">
                Here's an overview of your travel activity.
            </p>
        </div>

        <a href="{{ route('bookTrip') }}"
            class="px-5 py-3 rounded-xl bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
            Book a Trip
        </a>
    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl p-6 shadow-sm border">
            <p class="text-sm text-slate-500">My Bookings</p>
            <h2 class="text-3xl font-bold mt-2">{{ $totalBookings }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border">
            <p class="text-sm text-slate-500">Upcoming Trips</p>
            <h2 class="text-3xl font-bold mt-2">{{ $upcomingTrips }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border">
            <p class="text-sm text-slate-500">Completed Trips</p>
            <h2 class="text-3xl font-bold mt-2">{{ $completedTrips }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border">
            <p class="text-sm text-slate-500">Total Spent</p>
            <h2 class="text-3xl font-bold mt-2">${{ number_format($totalSpent,2) }}</h2>
        </div>

    </div>

    {{-- Upcoming Trips --}}
    <div class="bg-white rounded-2xl shadow-sm border">

        <div class="px-6 py-4 border-b">
            <h2 class="font-semibold text-lg">
                Upcoming Trips
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left">Route</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Vehicle</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($nextTrips as $trip)

                    <tr class="border-t">

                        <td class="px-6 py-4">
                            {{ $trip->routeSchedule->route->origin }}
                            →
                            {{ $trip->routeSchedule->route->destination }}
                        </td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($trip->routeSchedule->travel_date)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $trip->routeSchedule->vehicle->plate_number ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                {{ $trip->status }}
                            </span>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center py-10 text-slate-500">
                            No upcoming trips.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Recent Bookings --}}
    <div class="bg-white rounded-2xl shadow-sm border">

        <div class="px-6 py-4 border-b">
            <h2 class="font-semibold text-lg">
                Recent Bookings
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                <tr>
                    <th class="px-6 py-3 text-left">Booking #</th>
                    <th class="px-6 py-3 text-left">Route</th>
                    <th class="px-6 py-3 text-left">Amount</th>
                    <th class="px-6 py-3 text-left">Status</th>
                </tr>

                </thead>

                <tbody>

                @forelse($recentBookings as $booking)

                <tr class="border-t">

                    <td class="px-6 py-4">
                        #{{ $booking->id }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $booking->routeSchedule->route->origin }}
                        →
                        {{ $booking->routeSchedule->route->destination }}
                    </td>

                    <td class="px-6 py-4">
                        ${{ number_format($booking->total_price,2) }}
                    </td>

                    <td class="px-6 py-4">

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                            {{ $booking->status }}
                        </span>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="py-10 text-center text-slate-500">
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