@extends('layouts.admin', ['active' => 'users'])

@section('title', 'Users')

@section('content')

  @php
    // use App\Models\User;

    // $users = User::all();

    $svg = fn($path) => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>';
  @endphp


  <div class="flex items-start justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold text-slate-900">Users</h1>
      <p class="text-sm text-slate-400 mt-1">
        Welcome back, Admin. Here's what's happening today.
      </p>
    </div>

    <span class="text-sm text-slate-500 bg-white border border-slate-200 rounded-lg px-3 py-1.5">
      {{ now()->format('F j, Y') }}
    </span>
  </div>
  <form method="GET" action="{{ route('admin.users') }}" id="searchForm">
    <div class="flex items-center gap-3 my-4">

      <div class="flex-1 flex items-center rounded-xl border border-gray-300 px-4 py-3">

        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" class="text-gray-400">
          <circle cx="11" cy="11" r="8" />
          <path d="m21 21-4.35-4.35" />
        </svg>

        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search user..." id="searchInput"
          class="ml-2 w-full bg-none outline-none">

      </div>


    </div>
  </form>
  <div class="bg-white rounded-xl border border-slate-200">

    <table class="w-full text-sm">

      <thead>
        <tr class="border-b">
          <th class="p-4 text-left">Name</th>
          <th class="p-4 text-left">Email</th>
          <th class="p-4 text-left">Created</th>
        </tr>
      </thead>

      <tbody>

        @foreach($users as $user)

          <tr class="border-b hover:bg-slate-50">



            <td class="p-4">
              {{ $user->first_name }}
              {{ $user->last_name }}
            </td>

            <td class="p-4 text-slate-500">
              {{ $user->email }}
            </td>

            <td class="p-4 text-slate-400">
              {{ $user->created_at->format('M d, Y') }}
            </td>

          </tr>

        @endforeach

      </tbody>

    </table>

  </div>
  <script>
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    let timer;

    searchInput.addEventListener('input', function () {

      clearTimeout(timer);

      timer = setTimeout(() => {
        searchForm.submit();
      }, 500);

    });
  </script>
@endsection