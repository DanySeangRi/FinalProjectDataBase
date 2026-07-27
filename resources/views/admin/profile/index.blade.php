@extends('layouts.admin', ['active' => 'admin.profile'])

@section('title', 'Profile & Settings')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    @if(session('success'))
        <div class="rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Profile & Settings</h1>
            <p class="text-slate-500 mt-2">Manage your account information and security.</p>
        </div>
        <div class="bg-white border rounded-xl px-4 py-2 text-sm text-slate-500 shadow-sm">
            {{ now()->format('F d, Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- Profile Information --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-lg font-semibold text-slate-900 mb-6">Profile Information</h2>

            <div class="flex items-center gap-4 mb-6">
                @if($user->profile_image_url)
                    <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }}"
                        class="w-20 h-20 rounded-full object-cover border-4 border-blue-50">
                @else
                    <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-2xl">
                        {{ $user->initials }}
                    </div>
                @endif
                <div>
                    <h3 class="font-semibold text-lg">{{ $user->name }}</h3>
                    <p class="text-slate-500">{{ $user->email }}</p>
                    <span class="inline-block mt-2 px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs font-medium">
                        Administrator
                    </span>
                </div>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-600">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-600">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-600">Phone</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-600">Avatar</label>
                    <input type="file" name="profile_image" accept="image/*"
                        class="mt-2 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-600 file:font-medium">
                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition">
                    Save Changes
                </button>
            </form>
        </div>

        {{-- Security --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-6">Security</h2>

            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-medium text-slate-600">Current Password</label>
                    <input type="password" name="current_password"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-600">New Password</label>
                    <input type="password" name="password"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-600">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition">
                    Update Password
                </button>
            </form>
        </div>

        {{-- Account --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 xl:col-span-2">
            <h2 class="text-lg font-semibold mb-6">Account</h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-sm">
                <div>
                    <p class="text-slate-400">Role</p>
                    <p class="font-medium text-slate-800 mt-1 capitalize">{{ $user->role ?? 'admin' }}</p>
                </div>
                <div>
                    <p class="text-slate-400">Member since</p>
                    <p class="font-medium text-slate-800 mt-1">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-slate-400">Last updated</p>
                    <p class="font-medium text-slate-800 mt-1">{{ $user->updated_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-slate-100">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="border border-slate-300 hover:bg-slate-50 px-6 py-3 rounded-xl font-medium transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
