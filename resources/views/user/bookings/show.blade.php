@extends('layouts.user', ['active' => 'user.bookings'])

@section('title', 'Booking Ticket')

@section('content')

@php
    $route = $booking->routeSchedule?->route;
    $schedule = $booking->routeSchedule;
    $vehicle = $schedule?->vehicle;
    $seatNumbers = $booking->seats->pluck('seat_number')
        ->merge($booking->details->pluck('seat.seat_number')->filter())
        ->unique();
    $statusColors = [
        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
        'confirmed' => 'bg-green-100 text-green-700 border-green-200',
        'cancelled' => 'bg-red-100 text-red-700 border-red-200',
        'completed' => 'bg-blue-100 text-blue-700 border-blue-200',
    ];
@endphp

<div class="max-w-3xl mx-auto space-y-6">

    @if(session('success'))
        <div class="rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <a href="{{ route('user.bookings') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
            ← Back to bookings
        </a>
        <span class="px-4 py-1.5 rounded-full text-sm font-semibold border {{ $statusColors[$booking->status] ?? 'bg-slate-100 text-slate-600' }}">
            {{ $booking->statusLabel() }}
        </span>
    </div>

    {{-- Ticket Card --}}
    <div class="bg-white rounded-xl border border-slate-100 shadow-lg overflow-hidden">

        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 text-white">
            <p class="text-blue-100 text-sm font-medium">Angkor Travel · E-Ticket</p>
            <h1 class="text-2xl font-bold mt-1">{{ $booking->booking_code }}</h1>
        </div>

        <div class="p-8 space-y-8">

            {{-- Route --}}
            <div class="flex items-center justify-between">
                <div class="text-center flex-1">
                    <p class="text-2xl font-bold text-slate-800">{{ $route?->origin ?? 'N/A' }}</p>
                    <p class="text-xs text-slate-400 mt-1 uppercase tracking-wider">From</p>
                </div>
                <div class="flex-1 flex flex-col items-center px-4">
                    <div class="w-full border-t-2 border-dashed border-blue-200 relative">
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-white px-2">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="text-center flex-1">
                    <p class="text-2xl font-bold text-slate-800">{{ $route?->destination ?? 'N/A' }}</p>
                    <p class="text-xs text-slate-400 mt-1 uppercase tracking-wider">To</p>
                </div>
            </div>

            {{-- Trip Details --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wider">Date</p>
                    <p class="font-semibold text-slate-800 mt-1">{{ $schedule?->travel_date?->format('d M Y') ?? '-' }}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wider">Departure</p>
                    <p class="font-semibold text-slate-800 mt-1">{{ $schedule?->departure_time ?? '-' }}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wider">Arrival</p>
                    <p class="font-semibold text-slate-800 mt-1">{{ $schedule?->arrival_time ?? '-' }}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wider">Vehicle</p>
                    <p class="font-semibold text-slate-800 mt-1">{{ $vehicle?->plate_number ?? $vehicle?->vehicle_number ?? '-' }}</p>
                </div>
            </div>

            {{-- Passengers --}}
            @if($booking->details->isNotEmpty())
                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Passengers</h3>
                    <div class="space-y-3">
                        @foreach($booking->details as $detail)
                            <div class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                                <div>
                                    <p class="font-medium text-slate-800">{{ $detail->passenger_name }}</p>
                                    <p class="text-xs text-slate-400">{{ $detail->phone ?? $detail->email }}</p>
                                </div>
                                @if($detail->seat_number)
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm font-semibold">
                                        Seat {{ $detail->seat_number }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif($seatNumbers->isNotEmpty())
                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Seats</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($seatNumbers as $seat)
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm font-semibold">
                                Seat {{ $seat }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Price --}}
            <div class="flex items-center justify-between border-t border-slate-100 pt-6">
                <span class="text-slate-500 font-medium">Total Paid</span>
                <span class="text-2xl font-bold text-slate-800">${{ number_format($booking->total_price, 2) }}</span>
            </div>

        </div>
    </div>

    {{-- Actions --}}
    @if($booking->isPending())
        <div class="flex flex-wrap gap-3">
            <form action="{{ route('user.bookings.confirm', $booking) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-green-600 text-white font-medium hover:bg-green-700 transition">
                    Confirm Booking
                </button>
            </form>
            <form action="{{ route('user.bookings.cancel', $booking) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-red-50 text-red-600 font-medium hover:bg-red-100 transition border border-red-200">
                    Cancel Booking
                </button>
            </form>
        </div>
    @endif

</div>

@endsection
