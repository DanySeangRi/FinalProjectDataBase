@extends('layouts.user', ['active' => 'user.bookings'])

@section('title', 'My Bookings')

@section('content')

<div class="space-y-6">

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

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">My Bookings</h1>
            <p class="text-slate-500 mt-1">View and manage all your travel reservations.</p>
        </div>
        <a href="{{ route('bookTrip') }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
            Book New Trip
        </a>
    </div>

    @include('user.bookings.components.bookings-table', ['bookings' => $bookings])

</div>

@endsection
