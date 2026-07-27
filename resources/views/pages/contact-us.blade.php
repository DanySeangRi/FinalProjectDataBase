@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

    <section class="bg-slate-50 py-20">
        <div class="max-w-7xl mx-auto px-5">

            <!-- Header -->
            <div class="text-center mb-16">
                <span class="text-blue-600 font-semibold uppercase tracking-widest">
                    Contact
                </span>

                <h1 class="mt-3 text-4xl md:text-5xl font-bold text-slate-900">
                    Get in Touch
                </h1>

                <p class="mt-5 max-w-2xl mx-auto text-lg text-slate-600 leading-relaxed">
                    Have questions about your booking or need assistance planning your journey?
                    Our support team is ready to help you every step of the way.
                </p>
            </div>

            <div class="grid lg:grid-cols-1 gap-10">

                <!-- Contact Information -->
                <div class="bg-white rounded-3xl shadow-lg p-10">

                    <h2 class="text-2xl font-bold text-slate-900 mb-8">
                        Contact Information
                    </h2>

                    <div class="space-y-6">

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-semibold text-slate-900">
                                    Office Address
                                </h3>

                                <p class="text-slate-600 mt-1">
                                    Phnom Penh, Cambodia
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone">
                                    <path
                                        d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-semibold text-slate-900">
                                    Phone Number
                                </h3>

                                <p class="text-slate-600 mt-1">
                                    +855 12 345 678
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail">
                                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-semibold text-slate-900">
                                    Email Address
                                </h3>

                                <p class="text-slate-600 mt-1">
                                    support@angkortravels.com
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-clock7-icon lucide-clock-7">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l-2 4" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-semibold text-slate-900">
                                    Business Hours
                                </h3>

                                <p class="text-slate-600 mt-1">
                                    Monday – Sunday
                                    <br>
                                    8:00 AM – 8:00 PM
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="mt-10 rounded-2xl bg-blue-50 border border-blue-100 p-6">
                        <h3 class="font-semibold text-blue-900">
                            Need Immediate Assistance?
                        </h3>

                        <p class="mt-2 text-blue-800 text-sm leading-relaxed">
                            For urgent booking inquiries or travel assistance,
                            please contact us directly by phone during business hours.
                        </p>
                    </div>

                </div>





            </div>

        </div>
    </section>

@endsection