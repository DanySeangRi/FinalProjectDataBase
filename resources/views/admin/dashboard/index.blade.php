@extends('layouts.admin', ['active' => 'dashboard'])

@section('title', 'Dashboard')

@section('content')

    @php
        $svg = fn($path) => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>';


        // In a real app, pass these in from the controller instead of hardcoding.

    @endphp

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-[#F59E0B]">Dashboard</h1>
            <p class="text-sm text-slate-400 mt-1">Welcome back, Admin. Here's what's happening today.</p>
        </div>
        <span class="text-sm text-slate-500 bg-white border border-slate-200 rounded-lg px-3 py-1.5">
            {{ now()->format('F j, Y') }}
        </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Users -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Users</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $totalUsers }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600">
                    {!! $svg('<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>') !!}
                </div>
            </div>
        </div>

        <!-- Routes -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Routes</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $totalRoutes }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-road-icon lucide-road">
                        <path d="M12 17v4" />
                        <path d="M12 5V3" />
                        <path d="M12 9v3" />
                        <path
                            d="M2.077 18.449A2 2 0 0 0 4 21h16a2 2 0 0 0 1.924-2.55l-4-14A2 2 0 0 0 16 3H8a2 2 0 0 0-1.924 1.45z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Vehicles -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Vehicles</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $totalVehicles }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-van-icon lucide-van">
                        <path
                            d="M13 6v5a1 1 0 0 0 1 1h6.102a1 1 0 0 1 .712.298l.898.91a1 1 0 0 1 .288.702V17a1 1 0 0 1-1 1h-3" />
                        <path d="M5 18H3a1 1 0 0 1-1-1V8a2 2 0 0 1 2-2h12c1.1 0 2.1.8 2.4 1.8l1.176 4.2" />
                        <path d="M9 18h5" />
                        <circle cx="16" cy="18" r="2" />
                        <circle cx="7" cy="18" r="2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Schedules -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Schedules</p>
                    <h2 class="text-3xl font-bold text-slate-800 mt-2">{{ $totalSchedules }}</h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-600">
                    {!! $svg('<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>') !!}
                </div>
            </div>
        </div>

    </div>



@endsection