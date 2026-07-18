@extends('layouts.admin', ['active' => 'users'])

@section('title', 'Users')

@section('content')

@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg p-3">
    {{ session('success') }}
</div>
@endif


<div class="flex items-start justify-between mb-8">

    <div>
        <h1 class="text-2xl font-bold text-[#F59E0B]">
            Users Management
        </h1>

        <p class="text-sm text-slate-400 mt-1">
            Welcome back, Admin. Here's what's happening today.
        </p>
    </div>


    <div class="flex items-center gap-3">

        <span class="text-sm text-slate-500 bg-white border border-slate-200 rounded-lg px-3 py-1.5">
            {{ now()->format('F j, Y') }}
        </span>


        <button 
            type="button"
            id="openCreateUserModal"
            class="bg-[#86C5FF] text-white px-4 py-2 rounded-lg">
            + Add User
        </button>

    </div>

</div>



@include('admin.users.components.search')

@include('admin.users.components.user-table')

@include('admin.users.create-modal')

@include('admin.users.edit-modal')

@include('admin.users.delete-modal')

@endsection


@push('scripts')
<script src="{{ asset('js/admin/users.js') }}"></script>
@endpush