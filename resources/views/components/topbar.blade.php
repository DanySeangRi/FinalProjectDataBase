<div class="relative p-2 flex justify-end">

    <button id="profileButton" class="flex items-center gap-2 pl-2">
        <div
            class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-semibold text-xs flex items-center justify-center">
            {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
            {{ strtoupper(substr(auth()->user()->last_name, 0, 1)) }}
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="text-slate-400">
            <polyline points="6 9 12 15 18 9" />
        </svg>
    </button>


    <!-- Profile Dropdown -->
    <div id="profileDropdown"
        class="hidden absolute -top-2 right-3 mt-3 w-72 bg-white rounded-xl shadow-xl border border-slate-200 overflow-hidden z-50">


        <!-- Header -->
        <div class="p-5 bg-blue-50">

            <div class="flex items-center gap-4">

                <div
                    class="w-14 h-14 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-lg">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    {{ strtoupper(substr(auth()->user()->last_name, 0, 1)) }}
                </div>


                <div>
                    <h3 class="font-semibold text-slate-900">
                        {{ auth()->user()->first_name }}
                        {{ auth()->user()->last_name }}
                    </h3>

                    <p class="text-sm text-slate-500">
                        Admin
                    </p>
                </div>

            </div>

        </div>


        <!-- Details -->
        <div class="p-5 space-y-3">

            <div>
                <p class="text-xs text-slate-400">
                    Email
                </p>

                <p class="text-sm text-slate-700">
                    {{ auth()->user()->email }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-400">
                    Phone
                </p>

                <p class="text-sm text-slate-700">
                    {{ auth()->user()->phone ?? 'No phone number' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-400">
                    Joined
                </p>

                <p class="text-sm text-slate-700">
                    {{ auth()->user()->created_at->format('M d, Y') }}
                </p>
            </div>

        </div>


        <!-- Footer -->
        <div class="border-t p-4">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="w-full text-left text-sm text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg">
                    Logout
                </button>

            </form>

        </div>


    </div>

</div>
<script>
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');

    profileButton.addEventListener('click', () => {
        profileDropdown.classList.toggle('hidden');
    });


    document.addEventListener('click', (e) => {

        if (!profileButton.contains(e.target) &&
            !profileDropdown.contains(e.target)) {

            profileDropdown.classList.add('hidden');

        }

    });
</script>