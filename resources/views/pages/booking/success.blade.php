@extends('layouts.app')

@section('title', 'Payment Success')


@section('content')


  <section class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">


    <div class="max-w-md w-full">


      <div class="bg-white rounded-3xl shadow-lg overflow-hidden">


        {{-- SUCCESS HEADER --}}

        <div class="
                  bg-gradient-to-br
                  from-green-500
                  to-green-600
                  p-8
                  text-center
                  text-white
              ">


          <div class="
                      w-20
                      h-20
                      bg-white/20
                      rounded-full
                      flex
                      items-center
                      justify-center
                      mx-auto
                      mb-4
                  ">


            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">


              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />


            </svg>


          </div>



          <h1 class="font-bold text-2xl mb-1">

            Payment Successful!

          </h1>


          <p class="text-green-100 text-sm">

            Your booking has been confirmed

          </p>



        </div>







        <div class="p-6">



          {{-- BOOKING REFERENCE --}}


          <div class="
                      bg-gray-50
                      rounded-2xl
                      p-4
                      mb-5
                      text-center
                  ">


            <p class="text-xs text-gray-500 mb-1">

              Booking Reference

            </p>



            <p class="
                          font-bold
                          text-gray-900
                          text-2xl
                          tracking-widest
                      ">


              {{ $booking->booking_code ?? 'BG-2024-089321' }}


            </p>



          </div>








          {{-- TRIP DETAILS --}}


          <div class="space-y-3 text-sm mb-5">



            <div class="flex justify-between">

              <span class="text-gray-500">
                Route
              </span>


              <span class="font-medium">

                {{ $booking->routeSchedule->route->origin }}

                →

                {{ $booking->routeSchedule->route->destination }}

              </span>


            </div>
            <p>
              Bus:
              {{ $booking->routeSchedule->vehicle->brand }}
            </p>






            <div class="flex justify-between">

              <span class="text-gray-500">
                Date
              </span>


              <span class="font-medium">

                {{ $booking->routeSchedule->departure_time }}

              </span>


            </div>







            <div class="flex justify-between">

              <span class="text-gray-500">
                Departure
              </span>


              <span class="font-medium">

                 {{ $booking->routeSchedule->departure_time }}

              </span>


            </div




            <div class="flex justify-between">

              <span class="text-gray-500">
                Total Paid
              </span>


              <span class="font-bold text-gray-900">

                ${{ number_format($booking->total_price, 2) }}

              </span>


            </div>



          </div>










          {{-- QR CODE --}}


          <div class="
                      border
                      rounded-2xl
                      p-4
                      mb-5
                      flex
                      flex-col
                      items-center
                  ">



            {{-- Replace with real QR later --}}

            <div class="
                          w-20
                          h-20
                          bg-gray-900
                          flex
                          items-center
                          justify-center
                          mb-2
                      ">


              <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">


                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 4h6" />


              </svg>


            </div>




            <p class="text-xs text-gray-500">

              Show this QR code at boarding

            </p>


          </div>









          {{-- BUTTONS --}}


          <div class="space-y-3">


            <button class="
                      w-full
                      bg-green-500
                      hover:bg-green-600
                      text-white
                      py-3
                      
                      font-semibold
                      ">


               Download Ticket


            </button>





           






            <a href="{{ route('home') }}" class="
                      w-full
                      flex
                      items-center
                      justify-center
                      text-gray-500
                      py-2
                      text-sm
                      hover:text-gray-700
                      ">


               Return to Home


            </a>



          </div>



        </div>


      </div>


    </div>


  </section>


@endsection