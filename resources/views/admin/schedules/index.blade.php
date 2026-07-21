@extends('layouts.admin', ['active' => 'schedules'])

@section('title', 'Schedules')

@section('content')

    @php
        $svg = fn($path) => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>';


        // In a real app, pass these in from the controller instead of hardcoding.

    @endphp

    <div class="flex items-start  justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-[#F59E0B]">Schedule Management</h1>
            <p class="text-sm text-slate-400 mt-1">Welcome back, Admin. Here's what's happening today.</p>
        </div>
        <div>
            <span class="text-sm mr-2 text-slate-500 bg-white border border-slate-200 rounded-lg px-3 py-1.5">
                {{ now()->format('F j, Y') }}
            </span>
            <button id="openCreateScheduleModal" type="button" class="bg-[#86C5FF] text-white px-4 py-2 rounded-lg">

                + Add Schedule

            </button>

        </div>

    </div>

    @include('admin.schedules.components.search')
    @include('admin.schedules.components.schedules-table')
    @include('admin.schedules.modal.create-modal')
    @include('admin.schedules.modal.edit-modal')
    @include('admin.schedules.modal.delete-modal')
    @push('scripts')

        <script src="{{ asset('js/admin/scheduleRoutes.js') }}"></script>
    @endpush
@endsection