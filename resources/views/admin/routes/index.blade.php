@extends('layouts.admin', ['active' => 'routes'])

@section('title', 'Routes')

@section('content')

    @php
        $svg = fn ($path) => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>';

        $icons = [
            'users'    => $svg('<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'),
            'calendar' => $svg('<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>'),
            'dollar'   => $svg('<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>'),
            'ticket'   => $svg('<path d="M2 9V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 0 0 6v3a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-3a2 2 0 0 0 0-6z"/>'),
        ];

        // In a real app, pass these in from the controller instead of hardcoding.
       
    @endphp

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Routes</h1>
            <p class="text-sm text-slate-400 mt-1">Welcome back, Admin. Here's what's happening today.</p>
        </div>
        <span class="text-sm text-slate-500 bg-white border border-slate-200 rounded-lg px-3 py-1.5">
            {{ now()->format('F j, Y') }}
        </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      
    </div>

@endsection
