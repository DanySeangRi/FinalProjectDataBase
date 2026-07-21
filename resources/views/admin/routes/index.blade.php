@extends('layouts.admin', ['active' => 'routes'])

@section('title', 'Routes')


@section('content')


    <div class="flex items-start justify-between mb-8">

        <div>

            <h1 class="text-2xl font-bold text-[#F59E0B]">
                Routes Management
            </h1>

            <p class="text-sm text-slate-400 mt-1">
                Manage travel routes and destinations.
            </p>

        </div>


        <div class="flex items-center gap-3">


            <span class="text-sm text-slate-500 bg-white border border-slate-200 rounded-lg px-3 py-1.5">

                {{ now()->format('F j, Y') }}

            </span>



            <button id="openCreateRouteModal" class="bg-[#86C5FF] text-white px-4 py-2 rounded-lg">

                + Add Route

            </button>


        </div>


    </div>



    @include('admin.routes.components.search')


    @include('admin.routes.components.routes-table')

    @include('admin.routes.modal.create-modal')


    @include('admin.routes.modal.edit-modal')


    @include('admin.routes.modal.delete-modal')



    @push('scripts')
        <script src="{{ asset('js/admin/routes.js') }}"></script>
    @endpush
@endsection