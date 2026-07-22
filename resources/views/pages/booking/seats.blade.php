@extends('layouts.app')

@section('title', 'Select Seats')

@section('content')

  <section class="py-10 bg-gray-50 min-h-screen">

    <!-- Steps -->
    <div class="max-w-4xl mx-auto px-5 mb-6">

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



    <div class="max-w-4xl mx-auto px-5">


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

            <div class="bg-gray-100 rounded-xl px-8 py-2 text-sm">

              🚌 Front of Bus

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


        <div>


          <div class="bg-white rounded-2xl shadow p-5 sticky top-24">


            <h3 class="font-semibold mb-5">

              Booking Summary

            </h3>




            <div class="space-y-3 text-sm">


              <div class="flex justify-between">

                <span>

                  {{ $schedule->route->origin }}

                  →

                  {{ $schedule->route->destination }}

                </span>


              </div>




              <div class="flex justify-between">


                <span>
                  Vehicle
                </span>


                <span>

                  {{ $schedule->vehicle->brand }}

                </span>


              </div>





              <div class="flex justify-between">

                <span>
                  Departure
                </span>


                <span>

                  {{ $schedule->departure_time }}

                </span>


              </div>





              <div class="flex justify-between">


                <span>
                  Selected Seats
                </span>


                <span id="selectedSeats">

                  None

                </span>


              </div>


            </div>





            <div class="border-t mt-5 pt-5">


              <div class="flex justify-between">


                <span>
                  Total
                </span>


                <span class="font-bold text-green-600" id="totalPrice">

                  $0

                </span>


              </div>


            </div>





            <form method="GET" action="{{ route('passenger') }}">


              <input type="hidden" name="schedule" value="{{ $schedule->id }}">



              <input type="hidden" id="selectedSeatInput" name="seats">





              <button id="continueBtn" disabled class="
                              w-full
                              mt-6
                              bg-[#86C5FF]
                              text-white
                              py-3
                              rounded-xl

                              disabled:bg-gray-300

                              ">


                Continue


              </button>



            </form>



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