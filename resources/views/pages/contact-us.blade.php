@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-5">

        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900">
                Contact Us
            </h1>

            <p class="mt-5 max-w-2xl mx-auto text-lg text-slate-600">
                We'd love to hear from you. Whether you have a question, need assistance
                with your booking, or would like to share your feedback, our team is here to help.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">

            <!-- Contact Information -->
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">

                <h2 class="text-2xl font-bold text-slate-900 mb-8">
                    Get in Touch
                </h2>

                <div class="space-y-6">

                    <div>
                        <h3 class="font-semibold text-slate-900">📍 Address</h3>
                        <p class="text-slate-600 mt-2">
                            Phnom Penh, Cambodia
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-900">📞 Phone</h3>
                        <p class="text-slate-600 mt-2">
                            +855 12 345 678
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-900">✉️ Email</h3>
                        <p class="text-slate-600 mt-2">
                            support@angkortravels.com
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-900">🕒 Business Hours</h3>
                        <p class="text-slate-600 mt-2">
                            Monday – Sunday
                            <br>
                            8:00 AM – 8:00 PM
                        </p>
                    </div>

                </div>

            </div>

            <!-- Contact Form -->
           

            </div>

        </div>

    </div>
</section>

@endsection