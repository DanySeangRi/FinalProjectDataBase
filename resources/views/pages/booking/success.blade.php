@extends('layouts.app')

@section('title', 'Booking Confirmed')

@section('content')

<section class="min-h-screen bg-slate-50 py-12 px-5">

<div class="max-w-xl mx-auto">


    {{-- Success Message --}}
    <div class="text-center mb-8">

        <div class="w-20 h-20 mx-auto rounded-full bg-green-100 flex items-center justify-center">

            <svg class="w-10 h-10 text-green-600"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"/>

            </svg>

        </div>


        <h1 class="mt-5 text-3xl font-bold text-gray-900">

            Booking Confirmed 🎉

        </h1>


        <p class="text-gray-500 mt-2">

            Your ticket has been successfully booked.

        </p>

    </div>




    {{-- Ticket Card --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">


        {{-- Header --}}
        <div class="bg-[#86C5FF] p-6 text-white">


            <p class="text-sm opacity-90">
                Booking Reference
            </p>


            <h2 class="text-3xl font-bold tracking-widest mt-1">

                {{ $booking->booking_code }}

            </h2>


        </div>





        <div class="p-6 space-y-6">


            {{-- Route --}}

            <div>


                <p class="text-sm text-gray-500 mb-2">
                    Trip Route
                </p>


                <div class="flex items-center justify-between">


                    <div>

                        <p class="font-bold text-lg">

                            {{ $booking->routeSchedule->route->origin }}

                        </p>

                    </div>



                    <div class="text-[#3893E6] text-xl">

                        →

                    </div>



                    <div>

                        <p class="font-bold text-lg">

                            {{ $booking->routeSchedule->route->destination }}

                        </p>


                    </div>


                </div>


            </div>






            {{-- Trip Information --}}

            <div class="grid grid-cols-2 gap-4">


                <div class="bg-gray-50 rounded-xl p-4">

                    <p class="text-xs text-gray-500">
                        Date
                    </p>

                    <p class="font-semibold mt-1">

                        {{ \Carbon\Carbon::parse($booking->routeSchedule->travel_date)->format('d M Y') }}

                    </p>

                </div>




                <div class="bg-gray-50 rounded-xl p-4">

                    <p class="text-xs text-gray-500">
                        Departure
                    </p>


                    <p class="font-semibold mt-1">

                        {{ \Carbon\Carbon::parse($booking->routeSchedule->departure_time)->format('h:i A') }}

                    </p>

                </div>





                <div class="bg-gray-50 rounded-xl p-4">

                    <p class="text-xs text-gray-500">
                        Bus
                    </p>


                    <p class="font-semibold mt-1 mb-3">

                        {{ $booking->routeSchedule->vehicle->brand }}

                    </p>
                    <p class="text-[12px] text-gray-500">
                        plate number
                    </p>

                    <p class="text-[16px] text-black"> 
                      {{ $booking->routeSchedule->vehicle->plate_number }}
                    </p>


                </div>




                <div class="bg-gray-50 rounded-xl p-4">

                    <p class="text-xs text-gray-500">
                        Total Paid
                    </p>


                    <p class="font-bold text-[#3893E6] mt-1">

                        ${{ number_format($booking->total_price,2) }}

                    </p>


                </div>


            </div>

            {{-- Seats --}}

            <div class="border-t pt-5">


                <h3 class="font-semibold mb-3">

                    Seats

                </h3>



                <div class="flex flex-wrap gap-2">


                    @foreach($booking->seats as $seat)

                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">

                        {{ $seat->seat_number }}

                    </span>


                    @endforeach


                </div>


            </div>
            {{-- Actions --}}

            <div class="space-y-3 pt-4">
                <a href="{{ route('home') }}"
                class="block text-center text-white hover:text-gray-700 py-2 rounded-2xl bg-[#86C5FF]">

                    Back to Home

                </a>


            </div>


        </div>


    </div>


</div>


</section>


@endsection