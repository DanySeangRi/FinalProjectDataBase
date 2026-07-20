@extends('layouts.app')


@section('title', 'Book Trip')


@section('content')

    <section class="py-20">



        <div class=" left-0 right-0  px-4">


            <form action="{{ route('bookTrip') }}" method="GET" class="
                    max-w-5xl
                    mx-auto
                    bg-white
                    shadow-xl
                    rounded-2xl
                    p-4
                    md:p-6
                    grid
                    grid-cols-1
                    md:grid-cols-4
                    gap-4
                    border
                    border-gray-100
                ">



                {{-- Departure --}}

                <div class="
                        flex
                        items-center
                        gap-3
                        border
                        border-gray-200
                        rounded-xl
                        px-4
                        py-3
                        hover:border-amber-400
                        transition
                    ">

                    <i data-lucide="navigation" class="w-5 h-5 text-amber-400"></i>



                    <div class="flex-1">


                        <label class="block text-xs font-bold">
                            Departure
                        </label>



                        <input list="locations" name="from" placeholder="From" class="
                                w-full
                                text-sm
                                font-medium
                                outline-none
                                bg-transparent
                            ">


                    </div>


                </div>





                {{-- Destination --}}


                <div class="
                        flex
                        items-center
                        gap-3
                        border
                        border-gray-200
                        rounded-xl
                        px-4
                        py-3
                        hover:border-amber-400
                        transition
                    ">


                    <i data-lucide="map-pin" class="w-5 h-5 text-blue-400"></i>




                    <div class="flex-1">


                        <label class="block text-xs font-bold">
                            Destination
                        </label>




                        <input list="locations" name="to" placeholder="Going To" class="
                                w-full
                                text-sm
                                font-medium
                                outline-none
                                bg-transparent
                            ">


                    </div>


                </div>







                {{-- Date --}}


                <div class="
                        flex
                        items-center
                        gap-3
                        border
                        border-gray-200
                        rounded-xl
                        px-4
                        py-3
                        hover:border-amber-400
                        transition
                    ">


                    <i data-lucide="calendar-days" class="w-5 h-5 text-green-500"></i>




                    <div class="flex-1">


                        <label class="block text-xs text-gray-400">
                            Departure Date
                        </label>



                        <input type="date" name="date" class="
                                w-full
                                text-sm
                                font-medium
                                outline-none
                            ">


                    </div>


                </div>







                {{-- Search Button --}}


                <button type="submit" class="
                        mt-3
                        h-10
                        flex
                        items-center
                        justify-center
                        gap-2
                        bg-amber-400
                        hover:bg-amber-500
                        text-white
                        rounded-xl
                        font-medium
                        transition
                    ">


                    <i data-lucide="search" class="w-5 h-5"></i>



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





    </section>
    @if(isset($schedules) && $schedules->count() > 0)

        <section class="py-10 bg-gray-50">

            <div class="max-w-6xl mx-auto px-5">


                <h2 class="text-2xl font-bold text-gray-800 mb-8">
                    Available Trips
                </h2>



                <div class="grid md:grid-cols-3 gap-6">


                    @foreach($schedules as $schedule)


                        <x-home.trip-card :schedule="$schedule" />


                    @endforeach


                </div>


            </div>


        </section>


    @elseif(request()->has('from'))


        <section class="py-10">

            <div class="text-center">

                <i data-lucide="search-x" class="mx-auto w-10 h-10 text-gray-400"></i>


                <h2 class="mt-4 text-xl font-bold text-gray-700">
                    No Trip Found
                </h2>


                <p class="text-gray-500">
                    Try another departure or destination.
                </p>


            </div>

        </section>


    @endif


@endsection