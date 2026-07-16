<form method="GET" action="{{ route('admin.users') }}" id="searchForm">

  <div class="flex items-center gap-3 my-4">

    <div class="flex-1 flex items-center rounded-xl border border-gray-300 px-4 py-3">


      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" class="text-gray-400">

        <circle cx="11" cy="11" r="8" />
        <path d="m21 21-4.35-4.35" />

      </svg>


      <input type="text" name="search" id="searchInput" value="{{ $search ?? '' }}" placeholder="Search user..."
        class="ml-2 w-full outline-none" />


    </div>

  </div>

</form>