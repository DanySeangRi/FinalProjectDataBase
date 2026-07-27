@extends('layouts.user', ['active' => 'profile'])

@section('title', 'My Profile')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

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

    <div>
        <h1 class="text-3xl font-bold text-slate-800">My Profile</h1>
        <p class="text-slate-500 mt-1">Manage your personal information and account security.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Profile Card --}}
        <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-6">
            <div class="text-center">
                @if($user->profile_image_url)
                    <img src="{{ $user->profile_image_url }}"
                        alt="{{ $user->name }}"
                        class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-blue-50">
                @else
                    <div class="w-24 h-24 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-2xl font-bold mx-auto">
                        {{ $user->initials }}
                    </div>
                @endif

                <h2 class="text-xl font-bold text-slate-800 mt-4">{{ $user->name }}</h2>
                <p class="text-slate-500 text-sm">{{ $user->email }}</p>

                <span class="inline-block mt-3 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
                    Traveler
                </span>
            </div>

            <div class="mt-6 space-y-4 text-sm">
                <div>
                    <p class="text-slate-400">Phone</p>
                    <p class="font-medium text-slate-700">{{ $user->phone_number ?? 'Not set' }}</p>
                </div>
                <div>
                    <p class="text-slate-400">Address</p>
                    <p class="font-medium text-slate-700">{{ $user->address ?? 'Not set' }}</p>
                </div>
                <div>
                    <p class="text-slate-400">Member since</p>
                    <p class="font-medium text-slate-700">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Right: Edit Forms --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Profile Information --}}
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-6">Edit Profile</h3>

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">Phone</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">Address</label>
                        <textarea name="address" rows="3"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">Profile Photo</label>
                        <input type="file" name="profile_image" accept="image/*"
                            class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-600 file:font-medium hover:file:bg-blue-100">
                    </div>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition">
                        Save Changes
                    </button>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-6">Change Password</h3>

                <form action="{{ route('user.profile.password') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">Current Password</label>
                        <input type="password" name="current_password"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">New Password</label>
                        <input type="password" name="password"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition">
                        Update Password
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
