<form id="searchForm" method="GET" action="{{ route('admin.bookings') }}">

   <div class="relative max-w-xl mb-6">


    <svg class="absolute left-4 top-3.5 text-slate-400" width="18" height="18" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2">

      <circle cx="11" cy="11" r="8" />
      <path d="m21 21-4-4" />

    </svg>



    <input type="text" name="search" id="searchInput" value="{{ $search ?? '' }}"
      placeholder="Search origin or destination..." class="
                                                          w-full
                                                          rounded-xl
                                                          border
                                                          border-slate-200
                                                          bg-white
                                                          py-3
                                                          pl-11
                                                          pr-4
                                                          text-sm
                                                          outline-none
                                                          focus:border-blue-500
                                                          focus:ring-4
                                                          focus:ring-blue-100
                                                          " />


  </div>

</form>