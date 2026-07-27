<form id="searchForm" method="GET" action="{{ route('admin.bookings') }}">

    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6">

        <div class="relative flex-1 max-w-xl">
            <svg class="absolute left-4 top-3.5 text-slate-400" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4-4" />
            </svg>

            <input type="text" name="search" id="searchInput" value="{{ $search ?? '' }}"
                placeholder="Search booking code, customer, route..."
                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100" />
        </div>

        <div class="flex flex-wrap gap-2">
            @php
                $filters = [
                    '' => 'All',
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'cancelled' => 'Cancelled',
                    'completed' => 'Completed',
                ];
            @endphp

            @foreach($filters as $value => $label)
                <a href="{{ route('admin.bookings', array_filter(['status' => $value ?: null, 'search' => $search ?? null])) }}"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition
                        {{ ($status ?? '') === $value ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

    </div>

</form>

@if(session('success'))
    <div class="mb-4 rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
        {{ session('error') }}
    </div>
@endif
