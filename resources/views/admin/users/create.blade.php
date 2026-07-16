@extends('layouts.admin', ['active' => 'users'])

@section('title', 'Create User')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-slate-50 py-10">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-200 p-8">

        <div class="text-center mb-8">
            <div class="mx-auto w-14 h-14 flex items-center justify-center rounded-full bg-blue-100 mb-4">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4v16m8-8H4"/>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-slate-800">
                Create User
            </h1>

            <p class="text-sm text-slate-500 mt-2">
                Add a new user account
            </p>
        </div>


        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                <ul class="space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">

            @csrf


            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="text-sm font-medium text-slate-700">
                        First Name
                    </label>

                    <input 
                        type="text"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        class="mt-2 w-full outline-none rounded-xl p-2
                    focus:border-blue-500 focus:ring-blue-500 border border-gray-400"
                        placeholder="John">
                </div>


                <div>
                    <label class="text-sm font-medium text-slate-700">
                        Last Name
                    </label>

                    <input 
                        type="text"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        class="mt-2 w-full outline-none rounded-xl p-2
                    focus:border-blue-500 focus:ring-blue-500 border border-gray-400"
                        placeholder="Doe">
                </div>

            </div>



            <div>
                <label class="text-sm font-medium text-slate-700">
                    Email
                </label>

                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="mt-2 w-full outline-none rounded-xl p-2
                    focus:border-blue-500 focus:ring-blue-500 border border-gray-400"
                    placeholder="john@example.com">
            </div>



            <div>
                <label class="text-sm font-medium text-slate-700">
                    Phone
                </label>

                <input 
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="mt-2 w-full outline-none rounded-xl p-2
                    focus:border-blue-500 focus:ring-blue-500 border border-gray-400"
                    placeholder="+855 12 345 678">
            </div>



            <div>
                <label class="text-sm font-medium text-slate-700">
                    Password
                </label>

                <input 
                    type="password"
                    name="password"
                    class="mt-2 w-full outline-none rounded-xl p-2
                    focus:border-blue-500 focus:ring-blue-500 border border-gray-400"
                    placeholder="••••••••">
            </div>



            <div>
                <label class="text-sm font-medium text-slate-700">
                    Confirm Password
                </label>

                <input 
                    type="password"
                    name="password_confirmation"
                    class="mt-2 w-full outline-none rounded-xl p-2
                    focus:border-blue-500 focus:ring-blue-500 border border-gray-400" 
                    placeholder="••••••••">
            </div>



        <div class="flex justify-center">
                      <button 
                class="w-md rounded-2xl bg-blue-600 hover:bg-blue-700 
                text-white font-semibold py-3 outline-none text-[14px] p-3
                transition duration-200 shadow-md hover:shadow-lg">

                Create User

            </button>
        </div>


        </form>

    </div>

</div>

@endsection