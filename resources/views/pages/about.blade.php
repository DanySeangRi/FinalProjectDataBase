@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-5">

        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900">
                About Angkor Travels
            </h1>

            <p class="mt-5 max-w-3xl mx-auto text-lg text-slate-600 leading-8">
                Angkor Travels is a modern online bus ticket booking platform
                dedicated to making travel across Cambodia simple, convenient,
                and reliable. We connect passengers with trusted bus operators,
                allowing them to search routes, compare schedules, select seats,
                and book tickets anytime, anywhere.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">
                    Our Mission
                </h2>

                <p class="text-slate-600 leading-8 mb-6">
                    Our mission is to simplify bus travel in Cambodia by providing
                    an easy-to-use digital booking experience. We strive to help
                    travelers save time, travel with confidence, and enjoy a
                    seamless journey from booking to arrival.
                </p>

                <h2 class="text-2xl font-bold text-slate-900 mb-4">
                    Our Vision
                </h2>

                <p class="text-slate-600 leading-8">
                    We envision becoming Cambodia's leading transportation booking
                    platform by connecting passengers with quality transport
                    services through innovative technology, excellent customer
                    service, and reliable travel information.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
                <h2 class="text-2xl font-bold mb-6 text-slate-900">
                    Why Choose Angkor Travels?
                </h2>

                <div class="space-y-5">

                    <div class="flex gap-4">
                        <div class="text-2xl"><i data-lucide="van" class="w-8 h-8"></i>  </div>
                        <div>
                            <h3 class="font-semibold">Easy Online Booking</h3>
                            <p class="text-slate-600">
                                Book your bus tickets quickly with a simple and
                                user-friendly booking process.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="text-2xl"><i data-lucide="sofa" class="w-8 h-8"></i>  </div>
                        <div>
                            <h3 class="font-semibold">Seat Selection</h3>
                            <p class="text-slate-600">
                                Choose your preferred seat before completing your
                                booking.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="text-2xl"><i data-lucide="road" class="w-8 h-8"></i>  </div>
                        <div>
                            <h3 class="font-semibold">Nationwide Routes</h3>
                            <p class="text-slate-600">
                                Explore popular destinations across Cambodia with
                                trusted transportation providers.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="text-2xl"><i data-lucide="lock" class="w-8 h-8"></i>  </div>
                        <div>
                            <h3 class="font-semibold">Secure Booking</h3>
                            <p class="text-slate-600">
                                Your booking information is handled securely to
                                provide a safe and reliable experience.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

@endsection