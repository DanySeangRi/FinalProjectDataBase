@props([
'schedule'
])


<div
    class="
        bg-white
        rounded-[15px]
        shadow-lg
        border
        border-gray-100
        p-5
        hover:-translate-y-2
        transition
    ">


    {{-- Header --}}
    

    <div class="flex items-center justify-center ">


        <div>

            <img
                src="{{ asset('image/image.png') }}"
                class="w-20 h-20 object-contain">

        </div>



        <div class="flex-1">


            <h3
                class="
                    
                    text-[20px]
                    font-bold
                    text-gray-800
                ">

                {{ $schedule->route->origin }}

                <span class="text-amber-400">
                    →
                </span>

                {{ $schedule->route->destination }}

            </h3>


        </div>


    </div>





    {{-- Details --}}

    <div
        class="
            mt-2
            text-[16px]
            space-y-1
            text-gray-600
        ">


        <div class="flex justify-between">


            <span>
                Departure
            </span>


            <span class="font-medium">

                {{ $schedule->departure_time }}

            </span>


        </div>





        <div class="flex justify-between">


            <span>
                Arrived
            </span>


            <span class="font-medium">

                {{ $schedule->arrival_time }}

            </span>


        </div>





        <div class="flex justify-between">


            <span>
                Vehicle
            </span>


            <span class="font-medium">

                {{ $schedule->vehicle->type ?? 'Bus' }}

            </span>


        </div>

        <div class="flex justify-between items-center">


            <span class="flex items-center gap-2">



                <i data-lucide="calendar-check" class="w-4 h-4"></i>


                Travel Date


            </span>




            <span class="text-black font-bold">


              {{ \Carbon\Carbon::parse($schedule->travel_date)->format('d M Y') }}


            </span>



        </div>





        <div class="flex justify-between items-center">


            <span class="flex items-center gap-2">


                <i data-lucide="receipt" class="w-4 h-4"></i>


                Price


            </span>




            <span class="text-amber-500 font-bold">


                {{ $schedule->price ?? 12 }} $


            </span>



        </div>



    </div>






    {{-- Button --}}



    <a href="{{ route('seats', ['schedule' => $schedule->id]) }}"
        class="
                    group
                    w-full
                    mt-4
                    flex
                    items-center
                    justify-center
                    gap-2
                    bg-none
                    hover:bg-amber-500
                    text-amber-500
                    hover:text-white
                    font-semibold
                    text-sm
                    py-2.5
                    rounded-[10px]
                    hover:-translate-y-0.5
                    transition-all
                    duration-300
                    border-amber-300
                    border
                ">

        <span>
            Book Now
        </span>

        <svg
            class="
            w-4
            h-4
            group-hover:translate-x-1
            transition
        "
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>

    </a>







</div>