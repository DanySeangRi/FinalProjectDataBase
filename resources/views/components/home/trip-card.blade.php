@props([
    'schedule'
])


<div
    class="
        bg-white
        rounded-[5px]
        shadow-lg
        border
        border-gray-100
        p-3
        hover:-translate-y-2
        transition
    "
>


    {{-- Header --}}

    <div class="flex items-center ">


        <div>

            <img
                src="{{ asset('image/image.png') }}"
                class="w-16 h-16 object-contain"
            >

        </div>



        <div class="flex-1">


            <h3
                class="
                    
                    text-[14px]
                    font-bold
                    text-gray-800
                "
            >

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
            text-[12px]
            space-y-1
            text-gray-600
        "
    >


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
                Arrival
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


                <i data-lucide="receipt" class="w-4 h-4"></i>


                Price


            </span>




            <span class="text-amber-500 font-bold">


                {{ $schedule->price ?? 12 }} $


            </span>



        </div>



    </div>






    {{-- Button --}}


    <button
        class="
            w-full
            mt-3
            bg-white
            hover:bg-amber-500
            text-amber-500
            hover:text-white
            py-2
            border
            border-amber-500
            rounded-[10px]
            transition
        "
    >

        Book Now


    </button>



</div>