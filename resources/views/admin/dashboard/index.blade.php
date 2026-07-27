@extends('layouts.admin', ['active' => 'dashboard'])

@section('title', 'Dashboard')

@section('content')

    <div class="space-y-8">


        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Dashboard
                </h1>

                <p class="text-slate-500 mt-2">
                    Welcome back, Admin. Here's what's happening today.
                </p>
            </div>


            <div class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm text-slate-500">
                {{ now()->format('F j, Y') }}
            </div>

        </div>



        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">


            {{-- USERS --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">

                <div class="flex justify-between">

                    <div>
                        <p class="text-sm text-slate-500">
                            Total Users
                        </p>

                        <h2 class="text-4xl font-bold text-slate-900 mt-3">
                            {{ number_format($totalUsers) }}
                        </h2>
                    </div>


                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">

                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                        </svg>

                    </div>

                </div>

            </div>



            {{-- ROUTES --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                <div class="flex justify-between">

                    <div>
                        <p class="text-sm text-slate-500">
                            Routes
                        </p>

                        <h2 class="text-4xl font-bold mt-3">
                            {{ number_format($totalRoutes) }}
                        </h2>
                    </div>


                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-600">

                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 6h18M3 12h18M3 18h18" />
                        </svg>

                    </div>

                </div>

            </div>




            {{-- VEHICLES --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                <div class="flex justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Vehicles
                        </p>

                        <h2 class="text-4xl font-bold mt-3">
                            {{ number_format($totalVehicles) }}
                        </h2>

                        <p class="text-xs text-green-600 mt-2">
                            {{ $activeVehicles }} Active
                        </p>

                    </div>


                    <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600">

                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="7" width="18" height="10" rx="2" />
                            <circle cx="7" cy="17" r="2" />
                            <circle cx="17" cy="17" r="2" />
                        </svg>

                    </div>


                </div>

            </div>




            {{-- SCHEDULES --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                <div class="flex justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Schedules
                        </p>

                        <h2 class="text-4xl font-bold mt-3">
                            {{ number_format($totalSchedules) }}
                        </h2>


                        <p class="text-xs text-purple-600 mt-2">
                            {{ $todaySchedules }} Today
                        </p>

                    </div>


                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">

                        📅

                    </div>

                </div>

            </div>




            {{-- BOOKINGS --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                <div class="flex justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Bookings
                        </p>

                        <h2 class="text-4xl font-bold mt-3">
                            {{ number_format($totalBookings) }}
                        </h2>


                        <p class="text-xs text-yellow-600 mt-2">
                            {{ $pendingBookings }} Pending
                        </p>

                    </div>


                    <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">

                        🎫

                    </div>


                </div>

            </div>





            {{-- REVENUE --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">

                <div class="flex justify-between">

                    <div>

                        <p class="text-sm text-slate-500">
                            Revenue
                        </p>


                        <h2 class="text-4xl font-bold text-green-600 mt-3">

                            ${{ number_format($totalRevenue, 2) }}

                        </h2>


                        <p class="text-xs text-green-600 mt-2">

                            Today:
                            ${{ number_format($todayRevenue, 2) }}

                        </p>


                    </div>


                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">

                        💰

                    </div>


                </div>

            </div>


        </div>





        {{-- MAIN CONTENT --}}

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">



            {{-- UPCOMING TRIPS --}}

            <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl p-6">


                <h2 class="font-semibold text-lg mb-5">
                    Upcoming Trips
                </h2>


                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead>
                            <tr class="text-left text-slate-500 border-b">

                                <th class="pb-3">Route</th>
                                <th>Date</th>
                                <th>Departure</th>
                                <th>Vehicle</th>

                            </tr>
                        </thead>


                        <tbody>

                            @foreach($upcomingTrips as $trip)

                                <tr class="border-b">

                                    <td class="py-4">

                                        {{ $trip->route->origin }}
                                        →
                                        {{ $trip->route->destination }}

                                    </td>


                                    <td>
                                        {{ $trip->travel_date }}
                                    </td>


                                    <td>
                                        {{ $trip->departure_time }}
                                    </td>


                                    <td>
                                        {{ $trip->vehicle->vehicle_number }}
                                    </td>


                                </tr>

                            @endforeach


                        </tbody>

                    </table>

                </div>

            </div>




            {{-- BOOKING STATUS --}}

            <div class="bg-white border border-slate-200 rounded-2xl p-6">


                <h2 class="font-semibold text-lg mb-5">
                    Booking Status
                </h2>


                <div class="space-y-4">


                    <div class="flex justify-between">
                        <span>Confirmed</span>
                        <span class="font-bold text-green-600">
                            {{ $confirmedBookings }}
                        </span>
                    </div>


                    <div class="flex justify-between">
                        <span>Pending</span>
                        <span class="font-bold text-yellow-600">
                            {{ $pendingBookings }}
                        </span>
                    </div>


                    <div class="flex justify-between">
                        <span>Completed</span>
                        <span class="font-bold text-blue-600">
                            {{ $completedBookings }}
                        </span>
                    </div>


                    <div class="flex justify-between">
                        <span>Cancelled</span>
                        <span class="font-bold text-red-600">
                            {{ $cancelledBookings }}
                        </span>
                    </div>


                </div>


            </div>


        </div>






        {{-- RECENT BOOKINGS --}}

        <div class="bg-white border border-slate-200 rounded-2xl p-6">


            <h2 class="font-semibold text-lg mb-5">
                Recent Bookings
            </h2>


            <div class="overflow-x-auto">


                <table class="w-full text-sm">


                    <thead>

                        <tr class="border-b text-slate-500">

                            <th class="text-left pb-3">
                                Code
                            </th>

                            <th>
                                Passenger
                            </th>

                            <th>
                                Route
                            </th>

                            <th>
                                Status
                            </th>


                        </tr>

                    </thead>



                    <tbody>


                        @foreach($recentBookings as $booking)


                                                <tr class="border-b">


                                                    <td class="py-4 font-medium">

                                                        {{ $booking->booking_code }}

                                                    </td>


                                                    <td>

                                                        {{ $booking->user?->first_name }}

                                                        {{ $booking->user?->last_name }}

                                                    </td>



                                                    <td>

                                                        {{ $booking->routeSchedule->route->origin }}

                                                        -

                                                        {{ $booking->routeSchedule->route->destination }}

                                                    </td>



                                                    <td>

                                                        <span class="px-3 py-1 rounded-full text-xs

                            @if($booking->status == 'confirmed')
                                bg-green-100 text-green-700

                            @elseif($booking->status == 'pending')
                                bg-yellow-100 text-yellow-700

                            @else
                                bg-red-100 text-red-700
                            @endif

                            ">

                                                            {{ ucfirst($booking->status) }}

                                                        </span>


                                                    </td>


                                                </tr>


                        @endforeach


                    </tbody>


                </table>


            </div>


        </div>





    </div>


@endsection