@extends('layouts.admin', ['active' => 'Settings'])

@section('title', 'Settings')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Settings
            </h1>

            <p class="text-slate-500 mt-2">
                Manage your account information, password and preferences.
            </p>
        </div>

        <div class="mt-4 md:mt-0 bg-white border rounded-xl px-4 py-2 text-sm text-slate-500 shadow-sm">
            {{ now()->format('F d, Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- ================= PROFILE ================= -->

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-lg font-semibold text-slate-900 mb-6">
                Profile Information
            </h2>

            <div class="flex items-center gap-4 mb-6">

                <div
                    class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-2xl">
                    AD
                </div>

                <div>

                    <h3 class="font-semibold text-lg">
                        Admin User
                    </h3>

                    <p class="text-slate-500">
                        admin@busgo.com
                    </p>

                    <span
                        class="inline-block mt-2 px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs font-medium">
                        Administrator
                    </span>

                </div>

            </div>

            <form class="space-y-5">

                <div>

                    <label class="text-sm font-medium text-slate-600">
                        Full Name
                    </label>

                    <input
                        type="text"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        value="Admin User">

                </div>

                <div>

                    <label class="text-sm font-medium text-slate-600">
                        Email
                    </label>

                    <input
                        type="email"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500"
                        value="admin@busgo.com">

                </div>

                <div>

                    <label class="text-sm font-medium text-slate-600">
                        Phone
                    </label>

                    <input
                        type="text"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500"
                        value="+855 12 345 678">

                </div>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition">

                    Save Changes

                </button>

            </form>

        </div>

        <!-- ================= PASSWORD ================= -->

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-lg font-semibold mb-6">
                Security
            </h2>

            <form class="space-y-5">

                <div>

                    <label class="text-sm font-medium text-slate-600">
                        Current Password
                    </label>

                    <input
                        type="password"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3">

                </div>

                <div>

                    <label class="text-sm font-medium text-slate-600">
                        New Password
                    </label>

                    <input
                        type="password"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3">

                    <div class="mt-3">

                        <div class="w-full h-2 rounded-full bg-slate-200">

                            <div class="bg-green-500 h-2 rounded-full w-3/4"></div>

                        </div>

                        <p class="text-xs text-green-600 mt-2">
                            Strong Password
                        </p>

                    </div>

                </div>

                <div>

                    <label class="text-sm font-medium text-slate-600">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3">

                </div>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition">

                    Update Password

                </button>

            </form>

        </div>

        <!-- ================= PREFERENCES ================= -->

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-lg font-semibold mb-6">
                Preferences
            </h2>

            <div class="space-y-5">

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-medium">
                            Email Notifications
                        </h3>

                        <p class="text-sm text-slate-500">
                            Receive booking and payment updates.
                        </p>

                    </div>

                    <input type="checkbox" checked class="w-5 h-5">

                </div>

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-medium">
                            SMS Notifications
                        </h3>

                        <p class="text-sm text-slate-500">
                            Receive important alerts.
                        </p>

                    </div>

                    <input type="checkbox" class="w-5 h-5">

                </div>

                <div>

                    <label class="text-sm font-medium text-slate-600">
                        Language
                    </label>

                    <select class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3">

                        <option>English</option>

                        <option>Khmer</option>

                    </select>

                </div>

            </div>

        </div>

        <!-- ================= LOGIN SESSION ================= -->

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-lg font-semibold mb-6">
                Active Session
            </h2>

            <div class="space-y-4">

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Browser
                    </span>

                    <span class="font-medium">
                        Chrome
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Device
                    </span>

                    <span class="font-medium">
                        macOS
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Last Active
                    </span>

                    <span class="font-medium text-green-600">
                        Just Now
                    </span>

                </div>

                <button
                    class="mt-6 border border-red-300 text-red-600 hover:bg-red-50 px-5 py-3 rounded-xl font-medium">

                    Logout Other Devices

                </button>

            </div>

        </div>

    </div>

    <!-- ================= DANGER ZONE ================= -->

    <div class="mt-8 bg-white rounded-2xl border border-red-200 shadow-sm p-6">

        <h2 class="text-lg font-semibold text-red-600">
            Danger Zone
        </h2>

        <p class="text-slate-500 mt-2">
            These actions are irreversible. Please proceed carefully.
        </p>

        <div class="flex flex-wrap gap-4 mt-6">

            <button
                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-medium">

                Delete Account

            </button>

            <button
                class="border border-slate-300 hover:bg-slate-100 px-6 py-3 rounded-xl font-medium">

                Logout

            </button>

        </div>

    </div>

</div>

@endsection