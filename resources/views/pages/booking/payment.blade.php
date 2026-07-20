@extends('layouts.app')

@section('title','Payment')


@section('content')

<section class="py-10 bg-gray-50 min-h-screen">

  <div class="max-w-5xl mx-auto px-5">


    {{-- ================= STEP INDICATOR ================= --}}
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
                        {{ $index == 4 
                            ? 'bg-[#86C5FF] text-white'
                            : ($index < 4 
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





    <form method="POST"
      action="{{ route('payment.process') }}">


      @csrf



      <input type="hidden"
        name="schedule"
        value="{{ $schedule->id }}">


      <input type="hidden"
        name="seats"
        value="{{ implode(',',$seats) }}">





      <div class="grid md:grid-cols-3 gap-6">





        {{-- ================= PAYMENT SECTION ================= --}}


        <div class="md:col-span-2 space-y-6"
          x-data="{method:'card'}">



          {{-- Payment Method --}}

          <div class="bg-white rounded-2xl shadow p-6">


            <h2 class="text-xl font-bold mb-6">
              💳 Payment Method
            </h2>



            <input type="hidden"
              name="payment_method"
              x-model="method">




            @php

            $paymentMethods = [

            'card'=>[
            'image'=>null,
            'icon'=>'💳',
            'name'=>'Credit / Debit Card'
            ],

            'aba'=>[
            'image'=>'payments/aba.png',
            'name'=>'ABA Pay'
            ],

            'acleda'=>[
            'image'=>'payments/acleda.png',
            'name'=>'ACLEDA Pay'
            ],

            'khqr'=>[
            'image'=>'payments/khqr.png',
            'name'=>'KHQR'
            ],

            'wing'=>[
            'image'=>'payments/wing.png',
            'name'=>'Wing'
            ],

            'paypal'=>[
            'image'=>'payments/paypal.png',
            'name'=>'PayPal'
            ]

            ];

            @endphp
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">


              @foreach($paymentMethods as $key=>$payment)


              <button
                type="button"

                @click="method='{{ $key }}'"

                :class="
                  method=='{{ $key }}'
                  ? 'border-blue-600 bg-blue-50'
                  : 'border-gray-200'
              "

                class="
                  border-2
                  rounded-xl
                  p-4
                  flex
                  flex-col
                  items-center
                  justify-center
                  gap-3
                  transition
                  hover:border-blue-400
              ">


                @if($payment['image'])

                <img
                  src="{{ asset($payment['image']) }}"
                  class="
                        w-14
                        h-14
                        object-contain
                    "
                  alt="{{ $payment['name'] }}">

                @else

                <span class="text-4xl">
                  {{ $payment['icon'] }}
                </span>

                @endif



                <span class="text-sm font-medium text-gray-700">

                  {{ $payment['name'] }}

                </span>



              </button>


              @endforeach


            </div>





            {{-- Card Form --}}

            <div
              x-show="method=='card'"
              class="mt-6 space-y-4">


              <div>

                <label class="text-sm">
                  Card Number
                </label>


                <input
                  name="card_number"
                  class="w-full border rounded-xl px-4 py-3"
                  placeholder="1234 5678 9012 3456">

              </div>



              <div>

                <label class="text-sm">
                  Card Holder Name
                </label>


                <input
                  name="card_name"
                  class="w-full border rounded-xl px-4 py-3"
                  placeholder="John Doe">

              </div>




              <div class="grid grid-cols-2 gap-4">


                <input
                  name="expiry"
                  class="border rounded-xl px-4 py-3"
                  placeholder="MM / YY">


                <input
                  name="cvv"
                  class="border rounded-xl px-4 py-3"
                  placeholder="CVV">


              </div>



            </div>



            {{-- Other Payment --}}


            <div
              x-show="method!='card'"
              class="mt-6 bg-gray-50 rounded-xl p-6 text-center">


              <p class="text-gray-600">

                Continue with selected payment provider.

              </p>


            </div>



          </div>







          {{-- Promo Code --}}


          <div class="bg-white rounded-2xl shadow p-6">


            <h3 class="font-semibold mb-4">
              🎟 Promo Code
            </h3>


            <div class="flex gap-3">


              <input
                name="promo"
                class="
                        flex-1
                        border
                        rounded-xl
                        px-4
                        py-3
                        "
                placeholder="BUSGO10">



              <button
                type="button"
                class="
                      bg-blue-100
                      text-blue-600
                      px-5
                      rounded-xl
                      ">


                Apply


              </button>


            </div>


          </div>



        </div>







        {{-- ================= SUMMARY ================= --}}


        <div>


          <div
            class="
                  bg-white
                  rounded-2xl
                  shadow
                  p-6
                  sticky
                  top-24
                  ">


            <h3 class="font-bold text-lg mb-5">
              Order Summary
            </h3>




            <div class="space-y-4 text-sm">



              <div class="flex justify-between">

                <span class="text-gray-500">
                  Route
                </span>


                <span class="font-medium">

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
                  Seats
                </span>


                <span>

                  {{ implode(', ', $seats) }}

                </span>


              </div>




              <div class="flex justify-between">

                <span class="text-gray-500">
                  Price
                </span>


                <span>

                  {{ count($seats) }} × ${{ $schedule->price }}

                </span>


              </div>



            </div>





            <hr class="my-5">





            <div class="flex justify-between text-lg font-bold">


              <span>
                Total
              </span>


              <span class="text-green-700">

                ${{ count($seats) * $schedule->price }}

              </span>


            </div>





            <button
              class="
                    w-full
                    mt-6
                    bg-[#86C5FF]
                    hover:bg-[#0083FC]
                    text-white
                    py-3
                    rounded-xl
                    font-semibold
                    transition
                    ">


               Pay Now


            </button>



          </div>


        </div>



      </div>


    </form>


  </div>


</section>


@endsection