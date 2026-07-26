@extends('layouts.app')


@section('title', 'Angkor Travels')


@section('content')



    <!-- Hero -->

    <section class="relative h-[600px] bg-cover bg-center"
        style="background-image:url('{{ asset('image/mukVeang.png') }}');">


        <div class="absolute inset-0 bg-black/30"></div>



        <div class="relative h-full flex flex-col justify-center max-w-7xl mx-auto px-5">


            <p class="text-white italic">
                Explore Cambodia
            </p>



            <h1 class="text-white text-5xl md:text-6xl font-bold max-w-2xl">

                Uncover The Kingdom Of Wonder

            </h1>




            <div class="mt-8 flex gap-4">

                <a href="{{ route('bookTrip') }}"
                    class="bg-amber-400 text-white px-6 py-3 rounded-full hover:bg-amber-500 transition">
                    Book Trip
                </a>


                @auth

                    <a href="{{ route('user.dashboard') }}"
                        class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition">
                        Dashboard
                    </a>

                @else

                    <a href="{{ route('login') }}"
                        class="border-2 border-white text-white px-6 py-3 rounded-full hover:bg-white hover:text-black transition">
                        Login
                    </a>

                @endauth


            </div>


        </div>




        <x-home.search-box :locations="$locations" />


    </section>






    <!-- Trips -->


    <section class="py-20 bg-gray-50">


        <div class="max-w-7xl mx-auto px-5">


            <p class="text-center text-blue-300 italic">

                Choose Your Journey

            </p>



            <h2 class="text-center text-4xl font-bold text-amber-400 mb-12">

                Popular Trips

            </h2>





            <div class="grid md:grid-cols-2 gap-8">



                @foreach($schedules as $schedule)


                    <x-home.trip-card :schedule="$schedule" />


                @endforeach



            </div>



        </div>


    </section>




    <x-home.features />



@endsection