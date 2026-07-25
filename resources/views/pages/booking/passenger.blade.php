@extends('layouts.app')

@section('title', 'Passenger Information')

@section('content')

<section class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100 py-10">

    <div class="max-w-6xl mx-auto px-5">
       <a href="{{ route('seats', [
                'schedule' => $schedule->id,
                'seats' => $seats->pluck('id')->implode(',')
            ]) }}"
            class="inline-flex items-center gap-2 text-gray-600 hover:text-[#3893E6] transition mb-5">

            <i data-lucide="arrow-left" class="w-5 h-5"></i>

            <span class="font-medium">
                Back to Select <i class="fas fa-share-alt-square    "></i>
            </span>

        </a>

        {{-- Header --}}
        <div class="mb-10">

            <h1 class="text-3xl font-bold text-gray-900">
                Passenger Information
            </h1>

            <p class="text-gray-500 mt-2">
                Complete your booking by confirming your passenger details.
            </p>

        </div>

        {{-- Step Indicator --}}
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


        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Passenger Form --}}
            <form
                method="POST"
                action="{{ route('passenger.store') }}"
                class="lg:col-span-2 space-y-6">

                @csrf

                <input type="hidden" name="schedule" value="{{ $schedule->id }}">
                <input
                    type="hidden"
                    name="seats"
                    value="{{ $seats->pluck('id')->implode(',') }}">

                <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="border-b bg-gray-50 px-6 py-5">

                        <h2 class="text-xl font-semibold">
                            Passenger Details
                        </h2>

                        <p class="text-gray-500 text-sm mt-1">
                            Your booking confirmation will be sent using this information.
                        </p>

                    </div>

                    <div class="p-6">

                        @auth

                        <div class="rounded-2xl border border-green-200 bg-green-50 p-5">

                            <div class="flex justify-between items-center">

                                <div>

                                    <h3 class="font-semibold text-gray-900">
                                        {{ auth()->user()->first_name }}
                                        {{ auth()->user()->last_name }}
                                    </h3>

                                    <p class="text-gray-600 mt-1">
                                        {{ auth()->user()->email }}
                                    </p>

                                    <p class="text-gray-600">
                                        {{ auth()->user()->phone_number }}
                                    </p>

                                </div>

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    ✓ Verified
                                </span>

                            </div>

                        </div>

                        <input type="hidden" name="first_name" value="{{ auth()->user()->first_name }}">
                        <input type="hidden" name="last_name" value="{{ auth()->user()->last_name }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        <input type="hidden" name="phone" value="{{ auth()->user()->phone_number }}">

                        @else

                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    required
                                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-[#86C5FF] focus:border-[#86C5FF]">

                            </div>

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    required
                                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-[#86C5FF] focus:border-[#86C5FF]">

                            </div>

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    required
                                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-[#86C5FF] focus:border-[#86C5FF]">

                            </div>

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    required
                                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-[#86C5FF] focus:border-[#86C5FF]">

                            </div>

                        </div>

                        @endauth

                        <div class="mt-8">

                            <label class="flex items-start gap-3">

                                <input type="checkbox" required class="mt-1">

                                <span class="text-sm text-gray-600">

                                    I agree to the
                                    <a href="#" class="text-[#3893E6]">Terms & Conditions</a>
                                    and
                                    <a href="#" class="text-[#3893E6]">Privacy Policy</a>.

                                </span>

                            </label>

                        </div>

                        <button
                            class="w-full mt-8 bg-[#86C5FF] hover:bg-[#3893E6] text-white rounded-xl py-4 font-semibold transition">

                            Continue to Payment →

                        </button>

                        <p class="text-center text-sm text-gray-500 mt-4">

                            🔒 Your information is securely encrypted.

                        </p>

                    </div>

                </div>

            </form>

            {{-- Booking Summary --}}
            <div class="sticky top-24 h-fit">

                <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="bg-[#86C5FF] text-white p-5">

                        <h2 class="text-xl font-semibold">
                            Booking Summary
                        </h2>

                    </div>

                    <div class="p-6">

                        <div class="space-y-4 text-sm">

                            <div class="flex justify-between">
                                <span class="text-gray-500">Route</span>
                                <span class="font-medium">
                                    {{ $schedule->route->origin }}
                                    →
                                    {{ $schedule->route->destination }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-500">Bus</span>
                                <span>{{ $schedule->vehicle->brand }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-500">Departure</span>
                                <span>{{ $schedule->departure_time }}</span>
                            </div>

                            <div>

                                <p class="text-gray-500 mb-2">
                                    Selected Seats
                                </p>

                                <div class="flex flex-wrap gap-2">

                                    @foreach($seats as $seat)

                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">

                                        {{ $seat->seat_number }}

                                    </span>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                        <hr class="my-6">

                        <div class="space-y-3 text-sm">

                            <div class="flex justify-between">

                                <span>Ticket Price</span>

                                <span>
                                    {{ count($seats) }} × ${{ $schedule->price }}
                                </span>

                            </div>

                            <div class="flex justify-between">

                                <span>Booking Fee</span>

                                <span class="text-green-600">
                                    FREE
                                </span>

                            </div>

                        </div>

                        <hr class="my-6">

                        <div class="flex justify-between items-center">

                            <span class="font-semibold text-lg">
                                Total
                            </span>

                            <span class="text-3xl font-bold text-[#3893E6]">

                                ${{ count($seats) * $schedule->price }}

                            </span>

                        </div>

                        <div class="mt-8 rounded-2xl bg-gray-50 p-4 border">

                            <h4 class="font-semibold mb-2">
                                🔒 Secure Booking
                            </h4>

                            <p class="text-sm text-gray-500">

                                Your payment is protected using secure SSL encryption.
                                Your e-ticket will be sent immediately after payment.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection