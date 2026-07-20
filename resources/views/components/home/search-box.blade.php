<div class="absolute bottom-0 left-0 right-0 translate-y-1/2 px-4">


    <form
        action="{{ route('bookTrip') }}"
        method="GET"
        class="
            max-w-5xl
            mx-auto
            bg-white
            shadow-xl
            rounded-[5px]
            p-4
            md:p-6
            grid
            grid-cols-1
            md:grid-cols-4
            gap-4
            border
            border-gray-100
        "
    >



        {{-- Departure --}}

        <div
            class="
                flex
                items-center
                gap-3
                border
                border-gray-200
                rounded-[5px]
                px-4
                py-3
                hover:border-amber-400
                transition
            "
        >

            <i
                data-lucide="navigation"
                class="w-5 h-5 text-amber-400"
            ></i>



            <div class="flex-1">


                <label class="block text-xs font-bold">
                    Departure
                </label>



                <input
                    list="locations"
                    name="from"
                    placeholder="From"
                    class="
                        w-full
                        text-sm
                        font-medium
                        outline-none
                        bg-transparent
                    "
                >


            </div>


        </div>





        {{-- Destination --}}


        <div
            class="
                flex
                items-center
                gap-3
                border
                border-gray-200
                rounded-[5px]
                px-4
                py-3
                hover:border-amber-400
                transition
            "
        >


            <i
                data-lucide="map-pin"
                class="w-5 h-5 text-blue-400"
            ></i>




            <div class="flex-1">


                <label class="block text-xs font-bold">
                    Destination
                </label>




                <input
                    list="locations"
                    name="to"
                    placeholder="Going To"
                    class="
                        w-full
                        text-sm
                        font-medium
                        outline-none
                        bg-transparent
                    "
                >


            </div>


        </div>







        {{-- Date --}}


        <div
            class="
                flex
                items-center
                gap-3
                border
                border-gray-200
                rounded-[5px]
                px-4
                py-3
                hover:border-amber-400
                transition
            "
        >


            <i
                data-lucide="calendar-days"
                class="w-5 h-5 text-green-500"
            ></i>




            <div class="flex-1">


                <label class="block text-xs text-gray-400">
                    Departure Date
                </label>



                <input
                    type="date"
                    name="date"
                    class="
                        w-full
                        text-sm
                        font-medium
                        outline-none
                    "
                >


            </div>


        </div>







        {{-- Search Button --}}


        <button
            type="submit"
            class=" mt-3
                h-10
                flex
                items-center
                justify-center
                gap-2
                bg-amber-400
                hover:bg-amber-500
                text-white
                rounded-[5px]
                font-medium
                transition
            "
        >


            <i
                data-lucide="search"
                class="w-5 h-5"
            ></i>



            Search


        </button>



    </form>





    {{-- Location autocomplete --}}


    <datalist id="locations">


        @foreach($locations as $location)

            <option value="{{ $location }}"></option>

        @endforeach


    </datalist>



</div>