@props(['bookings'])


<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    {{-- Header --}}
    <div class="px-6 py-5 border-b bg-gradient-to-r from-blue-50 to-white">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Booking History
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    View and manage your travel reservations
                </p>
            </div>


            <div class="bg-blue-100 text-blue-600 px-4 py-2 rounded-xl text-sm font-semibold">
                {{ $bookings->count() }} Trips
            </div>

        </div>
       

    </div>



    {{-- Table --}}
    <div class="overflow-x-auto">


        <table class="w-full">


            <thead class="bg-slate-50">

                <tr class="text-left text-xs uppercase tracking-wider text-slate-500">


                    <th class="px-6 py-4 font-semibold">
                        Route
                    </th>


                    <th class="px-6 py-4 font-semibold">
                        Travel Date
                    </th>


                    <th class="px-6 py-4 font-semibold">
                        Vehicle
                    </th>


                    <th class="px-6 py-4 font-semibold">
                        Amount
                    </th>


                    <th class="px-6 py-4 font-semibold">
                        Status
                    </th>


                    <th class="px-6 py-4 font-semibold">
                        Action
                    </th>


                </tr>


            </thead>



            <tbody class="divide-y divide-slate-100">


            @forelse($bookings as $booking)


                <tr class="hover:bg-slate-50 transition">


                    {{-- Route --}}
                    <td class="px-6 py-5">


                        <div class="flex items-center gap-3">


                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 20l-5.447-2.724A2 2 0 013 15.487V5.513a2 2 0 012.553-1.789L9 5m0 15l6-3m-6 3V5m6 12l5.447 2.724A2 2 0 0021 17.487V7.513a2 2 0 00-1.553-1.789L15 4m0 13V4m0 0L9 7"/>

                                </svg>

                            </div>


                            <div>

                                <p class="font-semibold text-slate-800">

                                    {{ $booking->routeSchedule->route->from }}

                                    <span class="text-blue-500">
                                        →
                                    </span>

                                    {{ $booking->routeSchedule->route->to }}

                                </p>


                                <p class="text-xs text-slate-400">
                                    Booking #{{ $booking->id }}
                                </p>

                            </div>


                        </div>


                    </td>



                    {{-- Date --}}
                    <td class="px-6 py-5">

                        <p class="font-medium text-slate-700">

                            {{ \Carbon\Carbon::parse($booking->routeSchedule->travel_date)->format('d M Y') }}

                        </p>


                        <p class="text-xs text-slate-400">

                            {{ $booking->routeSchedule->departure_time }}

                        </p>


                    </td>




                    {{-- Vehicle --}}
                    <td class="px-6 py-5">


                        <div>

                            <p class="font-medium text-slate-700">

                                {{ $booking->routeSchedule->vehicle->name ?? 'Bus' }}

                            </p>


                            <p class="text-xs text-slate-400">

                                {{ $booking->routeSchedule->vehicle->plate_number ?? '-' }}

                            </p>


                        </div>


                    </td>




                    {{-- Price --}}
                    <td class="px-6 py-5">

                        <span class="font-bold text-slate-800">

                            ${{ number_format($booking->total_price,2) }}

                        </span>

                    </td>




                    {{-- Status --}}
                    <td class="px-6 py-5">


                        @if($booking->status == 'Completed')

                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                Completed

                            </span>


                        @elseif($booking->status == 'Pending')


                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">

                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>

                                Pending

                            </span>


                        @else


                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">

                                <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                {{ $booking->status }}

                            </span>


                        @endif


                    </td>



                    {{-- Action --}}
                    <td class="px-6 py-5">


                        <button
                            class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-xl hover:bg-blue-100 transition">

                            View

                        </button>


                    </td>


                </tr>



            @empty


                <tr>

                    <td colspan="6" class="px-6 py-12 text-center">


                        <div class="flex flex-col items-center">


                            <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-3">

                                🚍

                            </div>


                            <p class="font-semibold text-slate-700">
                                No bookings yet
                            </p>


                            <p class="text-sm text-slate-400">
                                Your travel history will appear here
                            </p>


                        </div>


                    </td>


                </tr>


            @endforelse


            </tbody>


        </table>


    </div>


</div>