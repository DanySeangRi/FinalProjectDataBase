<section class="py-20 bg-white">


    <div class="max-w-7xl mx-auto px-5">


        {{-- Header --}}

        <div class="text-center mb-12">


            <p class="text-blue-300 italic">
                Travel With Confidence
            </p>


            <h2 class="text-4xl font-bold text-amber-400">
                Why Choose Us!
            </h2>


            <p class="mt-4 text-gray-600 max-w-3xl mx-auto">

                Our schedule covers the major destinations in Cambodia
                and also operate to Bangkok and Ho Chi Minh City.

            </p>


        </div>





        {{-- Features --}}


        @php

        $features = [

            [
                'icon' => 'droplets',
                'title' => 'Complimentary',
                'description' =>
                'We offer a bottle of pure drinking water on board.'
            ],


            [
                'icon' => 'shield-check',
                'title' => 'Liability Insurance',
                'description' =>
                'All of our fleets are covered by liability insurance for domestic and international routes.'
            ],


            [
                'icon' => 'battery-charging',
                'title' => 'Power & USB Charger',
                'description' =>
                'All fleets equip individual power outlets or USB chargers to keep your devices charged.'
            ],


            [
                'icon' => 'headset',
                'title' => 'Customer Service',
                'description' =>
                'Our 24h call center representatives are ready to answer your questions in Khmer and English.'
            ],


            [
                'icon' => 'snowflake',
                'title' => 'Air Conditioned',
                'description' =>
                'Our professional mechanics regularly check air-conditioning systems for your comfort.'
            ],


            [
                'icon' => 'credit-card',
                'title' => 'Payment & Ticket',
                'description' =>
                'Purchase tickets online with multiple payment methods and receive e-tickets by email.'
            ],


            [
                'icon' => 'armchair',
                'title' => 'Comfortable Seat',
                'description' =>
                'We reduce seats to provide more space and comfortable reclining seats.'
            ],


            [
                'icon' => 'map',
                'title' => 'GPS Tracking System',
                'description' =>
                'Our tracking staff monitor fleet operation and driver speed for safety.'
            ],


            [
                'icon' => 'calendar-days',
                'title' => 'Schedule',
                'description' =>
                'Multiple schedules across Cambodia, Bangkok and Ho Chi Minh City for convenient planning.'
            ],


            [
                'icon' => 'user-round-check',
                'title' => 'Our Driver',
                'description' =>
                'Professional drivers are recruited and trained to operate buses safely.'
            ],


        ];

        @endphp







        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">



            @foreach($features as $feature)


            <div
                class="
                bg-gray-50
                rounded-[5px]
                p-6
                border
                border-gray-100
                hover:shadow-lg
                hover:-translate-y-1
                transition
                "
            >



                {{-- Icon --}}


                <div
                    class="
                    w-12
                    h-12
                    flex
                    items-center
                    justify-center
                    rounded-xl
                    bg-amber-100
                    text-amber-500
                    mb-5
                    "
                >


                    <i
                        data-lucide="{{ $feature['icon'] }}"
                        class="w-6 h-6"
                    ></i>


                </div>





                <h3
                    class="
                    text-lg
                    font-bold
                    text-gray-800
                    mb-2
                    "
                >

                    {{ $feature['title'] }}

                </h3>




                <p class="text-sm text-gray-600 leading-relaxed">

                    {{ $feature['description'] }}

                </p>



            </div>



            @endforeach



        </div>



    </div>


</section>