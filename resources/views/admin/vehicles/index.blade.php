@extends('layouts.admin', ['active' => 'vehicles'])

@section('title', 'Vehicles')

@section('content')


<div class="flex items-start justify-between mb-8">

    <div>
        <h1 class="text-2xl font-bold text-[#F59E0B]">
            Vehicles Management
        </h1>

        <p class="text-sm text-slate-400 mt-1">
            Manage all vehicles.
        </p>
    </div>


    <button
        type="button"
        id="openCreateVehicleModal"
        class="bg-[#86C5FF] text-white px-4 py-2 rounded-lg">

        + Add Vehicle

    </button>


</div>



@include('admin.vehicles.components.search')

@include('admin.vehicles.components.vehicles-table')

@include('admin.vehicles.create-modal')

@include('admin.vehicles.edit-modal')

@include('admin.vehicles.delete-modal')


@endsection



@push('scripts')

<script src="{{ asset('js/admin/vehicles.js') }}"></script>

@endpush