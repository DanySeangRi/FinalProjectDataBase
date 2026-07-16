@extends('layouts.admin', ['active' => 'vehicles'])

@section('title', 'Vehicles')

@section('content')

    @php
        $svg = fn ($path) => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>';


        // In a real app, pass these in from the controller instead of hardcoding.
      
    @endphp

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Vechicles</h1>
            <p class="text-sm text-slate-400 mt-1">Welcome back, Admin. Here's what's happening today.</p>
        </div>
        <span class="text-sm text-slate-500 bg-white border border-slate-200 rounded-lg px-3 py-1.5">
            {{ now()->format('F j, Y') }}
        </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
     
    </div>

@endsection
