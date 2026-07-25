@extends('layouts.app')

@section('title', 'Select Seats')

@section('content')


  <section class="py-10 bg-gray-50 min-h-screen">


    <!-- Steps -->
    <div class="max-w-4xl mx-auto px-5 mb-6">
       {{-- Header --}}
    <div class="mb-10">
       <a href="{{ route('home') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-[#3893E6] transition mb-5">

        <i data-lucide="arrow-left" class="w-5 h-5"></i>

        <span class="font-medium">
            Back to Home
        </span>

    </a>

        <h1 class="text-3xl font-bold text-gray-900">
            Please Your Seats
        </h1>

        <p class="text-gray-500 mt-2">
            Complete your booking by selecting your seats.
        </p>

    </div>

      <div class="flex items-center gap-2 text-sm overflow-x-auto">

        @php
          $steps = [
            'Search',
            'Select Trip',
            'Select Seats',
            'Passenger Info',
            'Payment'
          ];
        @endphp


        @foreach($steps as $index => $step)

            <div class="flex items-center gap-2 whitespace-nowrap">

              <div class="flex items-center gap-1 px-3 py-1 rounded-full
                                {{ $index == 2
          ? 'bg-[#86C5FF] text-white'
          : ($index < 2
            ? 'bg-green-100 text-green-700'
            : 'bg-gray-100 text-gray-500') }}">

                <span class="font-semibold">
                  {{ $index + 1 }}.
                </span>

                {{ $step }}

              </div>


              @if(!$loop->last)

                <div class="w-5 h-px bg-gray-300"></div>

              @endif

            </div>

        @endforeach

      </div>

    </div>



    <div class="max-w-5xl mx-auto px-5">


      <div class="grid md:grid-cols-3 gap-6">


        <!-- Seat Map -->

        <div class="md:col-span-2 bg-white rounded-2xl shadow p-6">


          <h2 class="text-xl font-bold mb-5">
            Select Your Seat(s)
          </h2>


          <div class="mb-6 border border-[#86C5FF] rounded-xl p-4 text-sm">

            You can select up to 4 seats.

          </div>



          <!-- Legend -->

          <div class="flex gap-6 mb-6">


            <div class="flex items-center gap-2">

              <div class="w-6 h-6 rounded border bg-gray-100"></div>

              <span class="text-sm">
                Available
              </span>

            </div>



            <div class="flex items-center gap-2">

              <div class="w-6 h-6 rounded bg-[#86C5FF]"></div>

              <span class="text-sm">
                Selected
              </span>

            </div>



            <div class="flex items-center gap-2">

              <div class="w-6 h-6 rounded bg-gray-300"></div>

              <span class="text-sm">
                Booked
              </span>

            </div>


          </div>




          <!-- Front -->

          <div class="flex justify-center mb-5">

            <div class="bg-gray-100 gap-2 flex items-center rounded-xl px-8 py-2 text-sm">

          <i data-lucide="bus-front"class="w-6 h-6"></i>  
           <p>Front of Bus</p>

            </div>

          </div>




          <!-- Seats -->

          <div id="seatContainer" class="grid grid-cols-4 gap-3 justify-items-center">


            @foreach($seats as $seat)

                    <button type="button" class="
                            seat-btn
                            w-10
                            h-10
                            rounded-lg
                            border-2
                            text-xs
                            font-semibold

                            {{ $seat->status == 'booked'
              ? 'bg-gray-300 border-gray-300 text-gray-400 cursor-not-allowed'
              : 'bg-gray-100 border-gray-300 hover:bg-blue-50 hover:text-black cursor-pointer'
                            }}
                        " data-id="{{ $seat->id }}" data-seat="{{ $seat->seat_number }}" data-status="{{ $seat->status }}">

                      {{ $seat->seat_number }}

                    </button>

            @endforeach


          </div>



        </div>





        <!-- Summary -->

        <!-- Booking Summary -->
        <div class="sticky top-24">

          <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-[#86C5FF] to-[#5BAEF8] text-white p-5">

              <h3 class="text-xl font-bold">
                Booking Summary
              </h3>

              <p class="text-sm text-blue-100 mt-1">
                Review your trip before continuing.
              </p>

            </div>

            <div class="p-6">

              <!-- Route -->
              <div class="flex items-start gap-3 mb-6">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">
                  <i data-lucide="bus" class="w-6 h-6 text-blue-700"></i>
                </div>

                <div>

                  <h4 class="font-semibold text-lg">

                    {{ $schedule->vehicle->brand }}

                  </h4>

                  <p class="text-sm text-gray-500">

                    {{ $schedule->route->origin }}

                    →

                    {{ $schedule->route->destination }}

                  </p>

                </div>

              </div>

              <!-- Trip Info -->
              <div class="space-y-4 text-sm">

                <div class="flex justify-between">

                  <span class="text-gray-500">
                    Travel Date
                  </span>

                  <span class="font-medium">

                    {{ \Carbon\Carbon::parse($schedule->travel_date)->format('d M Y') }}

                  </span>

                </div>

                <div class="flex justify-between">

                  <span class="text-gray-500">
                    Departure
                  </span>

                  <span class="font-medium">

                    {{ \Carbon\Carbon::parse($schedule->departure_time)->format('h:i A') }}

                  </span>

                </div>

                <div class="flex justify-between">

                  <span class="text-gray-500">
                    Arrival
                  </span>

                  <span class="font-medium">

                    {{ \Carbon\Carbon::parse($schedule->arrival_time)->format('h:i A') }}

                  </span>

                </div>

                <div class="flex justify-between">

                  <span class="text-gray-500">
                    Price / Seat
                  </span>

                  <span>

                    ${{ number_format($schedule->price, 2) }}

                  </span>

                </div>

              </div>

              <hr class="my-6">

              <!-- Seats -->
              <div>

                <p class="text-gray-500 text-sm mb-3">

                  Selected Seats

                </p>

                <div id="selectedSeats" class="flex flex-wrap gap-2">

                  <span class="text-gray-400 text-sm">

                    No seats selected

                  </span>

                </div>

              </div>

              <hr class="my-6">

              <!-- Price -->
              <div class="space-y-3">

                <div class="flex justify-between text-sm">

                  <span>

                    Ticket Price

                  </span>

                  <span id="ticketSubtotal">

                    $0.00

                  </span>

                </div>

                <div class="flex justify-between text-sm">

                  <span>

                    Booking Fee

                  </span>

                  <span class="text-green-600">

                    FREE

                  </span>

                </div>

              </div>

              <hr class="my-6">

              <div class="flex justify-between items-center">

                <div>

                  <p class="text-sm text-gray-500">

                    Total

                  </p>

                  <p class="text-xs text-gray-400">

                    Including all fees

                  </p>

                </div>

                <div id="totalPrice" class="text-3xl font-bold text-[#3893E6]">

                  $0.00

                </div>

              </div>

              <!-- Security -->
              <div class="mt-6 rounded-2xl bg-green-50 border border-green-200 p-4">

                <div class="flex gap-3">

                  <div class="text-xl">

                   <i data-lucide="lock" class="w-6 h-6 text-green-600"></i>  

                  </div>

                  <div>

                    <p class="font-semibold text-green-700">

                      Secure Booking

                    </p>

                    <p class="text-sm text-green-600">

                      Your seats will be reserved after payment confirmation.

                    </p>

                  </div>

                </div>

              </div>

              <!-- Continue -->
              <form method="GET" action="{{ route('passenger') }}" class="mt-6">

                <input type="hidden" name="schedule" value="{{ $schedule->id }}">

                <input type="hidden" id="selectedSeatInput" name="seats">

                <button id="continueBtn" disabled
                  class="w-full py-4 rounded-xl bg-[#86C5FF] hover:bg-[#3893E6] text-white font-semibold transition disabled:bg-gray-300 disabled:cursor-not-allowed">

                  Continue to Passenger →

                </button>

              </form>

            </div>

          </div>

        </div>



      </div>


    </div>


  </section>





  <script>


    const seatPrice = {{ $schedule->price }};



    const buttons = document.querySelectorAll(".seat-btn");



  </script>


  <script src="{{ asset('js/seats.js') }}"></script>


@endsection