@extends('layouts.user')

@section('title','My Bookings')

@section('content')

<div class="p-2">

    <h1 class="text-4xl font-bold mb-6">
        My Bookings
    </h1>

    @include('user.bookings.components.bookings-table', [
        'bookings' => $bookings
    ])

</div>

@endsection