@extends('layouts.app')

@section('title','Passenger Information')

@section('content')

<section class="py-10 bg-gray-50 min-h-screen">

    <div class="max-w-5xl mx-auto px-5">


        <!-- Step Indicator -->
        <div class="flex items-center gap-2 text-sm mb-8 overflow-x-auto">

            @foreach([
                'Search',
                'Select Trip',
                'Select Seats',
                'Passenger Info',
                'Payment'
            ] as $index => $step)

                <div class="flex items-center gap-2 whitespace-nowrap">

                    <div class="
                        px-3 py-1 rounded-full
                        {{ $index == 3 
                            ? 'bg-[#86C5FF] text-white'
                            : ($index < 3 
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-100 text-gray-500')
                        }}
                    ">

                        {{ $index + 1 }}. {{ $step }}

                    </div>


                    @if(!$loop->last)
                        <div class="w-5 h-px bg-gray-300"></div>
                    @endif

                </div>

            @endforeach

        </div>




        <div class="grid md:grid-cols-3 gap-6">



            <!-- Passenger Form -->

            <form 
                method="POST"
                action="{{ route('passenger.store') }}"
                class="md:col-span-2 space-y-6"
            >

                @csrf


                <input 
                    type="hidden"
                    name="schedule"
                    value="{{ $schedule->id }}"
                >


                <input 
                    type="hidden"
                    name="seats"
                    value="{{ implode(',', $seats) }}"
                >



                <!-- Passenger Details -->

                <div class="bg-white rounded-2xl shadow p-6">


                    <h2 class="text-xl font-bold mb-5">
                        👤 Passenger Details
                    </h2>



                    @auth

                    <!-- Logged User -->

                    <div class="bg-blue-50 rounded-xl p-4">

                        <p class="font-semibold text-[#86C5FF]">
                            Account Information
                        </p>


                        <p class="mt-2">
                            {{ auth()->user()->first_name }}
                            {{ auth()->user()->last_name }}
                        </p>


                        <p>
                            {{ auth()->user()->email }}
                        </p>


                        <p>
                            {{ auth()->user()->phone_number }}
                        </p>


                    </div>



                    <input type="hidden"
                        name="first_name"
                        value="{{ auth()->user()->first_name }}"
                    >

                    <input type="hidden"
                        name="last_name"
                        value="{{ auth()->user()->last_name }}"
                    >

                    <input type="hidden"
                        name="email"
                        value="{{ auth()->user()->email }}"
                    >

                    <input type="hidden"
                        name="phone"
                        value="{{ auth()->user()->phone_number }}"
                    >



                    @else


                    <!-- Guest -->

                    <div class="grid sm:grid-cols-2 gap-4">


                        <input
                            name="first_name"
                            placeholder="First Name"
                            required
                            class="border rounded-xl px-4 py-3"
                        >


                        <input
                            name="last_name"
                            placeholder="Last Name"
                            required
                            class="border rounded-xl px-4 py-3"
                        >



                        <input
                            type="email"
                            name="email"
                            placeholder="Email Address"
                            required
                            class="border rounded-xl px-4 py-3"
                        >



                        <input
                            name="phone"
                            placeholder="Phone Number"
                            required
                            class="border rounded-xl px-4 py-3"
                        >


                    </div>


                    @endauth


                </div>





                <!-- ID Information -->

           


            

                <button
                    class="
                    bg-[#86C5FF]
                    hover:bg-[#3893E6]
                    text-white
                    
                    px-8
                    py-3
                    rounded-xl
                    font-semibold
                    "
                >

                    Continue to Payment →

                </button>



            </form>







            <!-- Booking Summary -->


            <div class="bg-white rounded-2xl shadow p-5 h-fit sticky top-24">


                <h3 class="font-bold mb-5">
                    Booking Summary
                </h3>



                <div class="space-y-3 text-sm">


                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Route
                        </span>

                        <span>
                            {{ $schedule->route->origin }}
                            →
                            {{ $schedule->route->destination }}
                        </span>

                    </div>



                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Bus
                        </span>

                        <span>
                            {{ $schedule->vehicle->brand }}
                        </span>

                    </div>



                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Departure
                        </span>

                        <span>
                            {{ $schedule->departure_time }}
                        </span>

                    </div>



                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Seats
                        </span>

                        <span>
                            {{ implode(', ', $seats) }}
                        </span>

                    </div>



                </div>




                <hr class="my-5">



                <div class="flex justify-between font-bold">


                    <span>
                        Total
                    </span>


                    <span class="text-green-700">

                        ${{ count($seats) * $schedule->price }}

                    </span>


                </div>



            </div>


        </div>


    </div>


</section>


@endsection