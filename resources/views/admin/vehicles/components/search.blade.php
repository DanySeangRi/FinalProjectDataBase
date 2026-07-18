<form id="searchForm" method="GET" action="{{ route('admin.vehicles') }}" class="mb-6">

    <div class="flex items-center justify-between gap-4">

        <!-- Search -->
        <div class="relative w-full max-w-md">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>

            </svg>

            <input
                id="searchInput"
                name="search"
                type="text"
                value="{{ request('search') }}"
                placeholder="Search by vehicle number, type, or driver..."
                class="w-full rounded-xl border border-slate-300 bg-white py-3 pl-12 pr-4
                       text-sm text-slate-700
                       placeholder:text-slate-400
                       outline-none
                       focus:border-blue-500
                       focus:ring-4
                       focus:ring-blue-100
                       transition">

        </div>

        @if(request('search'))

            <a href="{{ route('admin.vehicles') }}"
                class="px-4 py-3 rounded-xl border border-slate-300
                       text-sm text-slate-700
                       hover:bg-slate-100 transition">

                Clear

            </a>

        @endif

    </div>

</form>