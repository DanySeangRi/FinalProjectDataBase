<form method="GET" action="{{ route('admin.users') }}" id="searchForm">

    <div class="flex items-center justify-between gap-4 my-6">

        <div class="relative flex-1 max-w-xl">

            <!-- Search Icon -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="19"
                    height="19"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="text-slate-400">

                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.3-4.3"/>

                </svg>

            </div>


            <!-- Input -->
            <input
                type="text"
                name="search"
                id="searchInput"
                value="{{ $search ?? '' }}"
                placeholder="Search users by name, email, phone..."

                class="w-full rounded-xl
                border border-slate-200
                bg-white
                py-3.5
                pl-11
                pr-12
                text-sm
                text-slate-700

                placeholder:text-slate-400

                outline-none

                transition

                focus:border-blue-500
                focus:ring-4
                focus:ring-blue-100"

            />


            <!-- Shortcut -->



        </div>


        <!-- Search Status -->
        @if(isset($search) && $search)

            <a href="{{ route('admin.users') }}"
                class="text-sm text-slate-500 hover:text-blue-600 transition">

                Clear

            </a>

        @endif


    </div>

</form>