@extends('layouts.admin')

@section('title', 'Booking History')

@section('content')
  <div class="p-6 bg-slate-50 min-h-screen">

    <!-- Back -->
    <a href="{{ route('admin.users') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-blue-600 mb-6">
      ← Back to Users
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- LEFT SIDE -->
      <div class="space-y-6">

        <!-- User Card -->
        <div class="bg-white  rounded-3xl border shadow-sm p-5">

          <div class="flex flex-col items-center">

            <div
              class="w-20 h-20 rounded-3xl bg-blue-100 flex items-center justify-center text-4xl font-bold text-blue-600">
              {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
            </div>

            <h2 class="mt-5 text-xl font-bold">
              {{ $user->first_name }} {{ $user->last_name }}
            </h2>

            <span class="mt-3 px-4 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
              ● Active
            </span>

          </div>

          <div class="mt-5 space-y-2 text-slate-600">

            <div class="flex items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-mail-icon lucide-mail">
                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                <rect x="2" y="4" width="20" height="16" rx="2" />
              </svg>
              {{ $user->email }}
            </div>

            <div class="flex items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-phone-icon lucide-phone">
                <path
                  d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
              </svg>
              {{ $user->phone_number ?? 'No phone' }}
            </div>

            <div class="flex items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-calendar-range-icon lucide-calendar-range">
                <rect width="18" height="18" x="3" y="4" rx="2" />
                <path d="M16 2v4" />
                <path d="M3 10h18" />
                <path d="M8 2v4" />
                <path d="M17 14h-6" />
                <path d="M13 18H7" />
                <path d="M7 14h.01" />
                <path d="M17 18h.01" />
              </svg>
              Joined
              {{ $user->created_at->format('M d, Y') }}
            </div>

          </div>

        </div>

        <!-- Statistics -->
        <div class="bg-white rounded-3xl border shadow-sm p-6">

          <h3 class="text-xl font-bold mb-5">
            Booking Statistics
          </h3>

          <div class="grid grid-cols-2 gap-4">

            <div class="rounded-2xl bg-slate-50 p-6 text-center">

              <div class="text-3xl font-bold">
                {{ $bookings->total() }}
              </div>

              <p class="text-slate-500 mt-2">
                Total
              </p>

            </div>

            <div class="rounded-2xl bg-slate-50 p-6 text-center">

              <div class="text-3xl font-bold">
                {{ $bookings->where('status', 'confirmed')->count() }}
              </div>

              <p class="text-slate-500 mt-2">
                Confirmed
              </p>

            </div>

          </div>

        </div>

      </div>

      <!-- RIGHT SIDE -->
      <div class="lg:col-span-2">

        <div class="bg-white rounded-3xl border shadow-sm p-8">

          <h2 class="text-3xl font-bold mb-6">
            Booking History
          </h2>

          <div class="space-y-5">

            @forelse($bookings as $booking)

              @php
                $statusColors = [
                  'confirmed' => 'bg-green-100 text-green-700',
                  'pending' => 'bg-yellow-100 text-yellow-700',
                  'cancelled' => 'bg-red-100 text-red-700',
                ];
              @endphp

              <div
                class="flex justify-between items-center rounded-2xl bg-slate-50 px-6 py-5 hover:bg-slate-100 transition">

                <div>

                  <div class="flex items-center gap-3">

                    <h3 class="font-bold text-xl">
                      MN{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                    </h3>

                    <span
                      class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-700' }}">
                      {{ ucfirst($booking->status) }}
                    </span>

                  </div>

                  <p class="text-slate-500 mt-1">

                    {{ $booking->routeSchedule->route->origin }}

                    →

                    {{ $booking->routeSchedule->route->destination }}

                    •

                    {{ \Carbon\Carbon::parse($booking->routeSchedule->travel_date)->format('M d, Y') }}

                  </p>

                  <p class="text-sm text-slate-400 mt-1">

                    Seats:

                    @forelse($booking->seats as $seat)

                      {{ $seat->seat_number }}

                      @if(!$loop->last)
                        ,
                      @endif

                    @empty

                      No seat selected

                    @endforelse

                  </p>

                </div>

                <div class="text-2xl font-bold">

                  ${{ number_format($booking->total_price, 2) }}

                </div>

              </div>

            @empty

              <div class="py-20 text-center text-slate-400">

                No booking history found.

              </div>

            @endforelse

          </div>

          <div class="mt-8">
            {{ $bookings->links() }}
          </div>

        </div>

      </div>

    </div>

  </div>
@endsection