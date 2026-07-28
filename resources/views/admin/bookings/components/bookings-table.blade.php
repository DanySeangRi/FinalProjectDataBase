<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

    <table class="w-full text-sm">

        <thead>
            <tr class="border-b bg-slate-50">
                <th class="p-4 text-left">Booking Code</th>
                <th class="p-4 text-left">Customer</th>
                <th class="p-4 text-left">Schedule</th>
                <th class="p-4 text-left">Vehicle</th>
                <th class="p-4 text-left">Seat</th>
                <th class="p-4 text-left">Price</th>
                <th class="p-4 text-left">Status</th>
                <th class="p-4 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bookings as $booking)
            <tr class="border-b hover:bg-slate-50">

                <td class="p-4 font-medium text-slate-900">
                    {{ $booking->booking_code }}
                </td>

                <td class="p-4">
                    <div class="font-medium">
                        {{ $booking->user?->name ?? 'Guest' }}
                    </div>
                    <div class="text-xs text-slate-400">
                        {{ $booking->user?->email }}
                    </div>
                </td>

                <td class="p-4">
                    <div class="font-medium">
                        @if($booking->routeSchedule && $booking->routeSchedule->route)
                        {{ $booking->routeSchedule->route->origin }}
                        →
                        {{ $booking->routeSchedule->route->destination }}
                        @else
                        <span class="text-red-500">Schedule Deleted</span>
                        @endif
                    </div>
                    <div class="text-xs text-slate-400">
                        @if($booking->routeSchedule)
                        {{ $booking->routeSchedule->travel_date?->format('d M Y') }}
                        | {{ $booking->routeSchedule->departure_time }}
                        @else
                        -
                        @endif
                    </div>
                </td>

                <td class="p-4 text-slate-500">
                    {{ $booking->routeSchedule?->vehicle?->vehicle_number ?? $booking->routeSchedule?->vehicle?->plate_number ?? '-' }}
                </td>

                <td class="p-4 text-slate-500">
                    @forelse($booking->seats as $seat)
                    <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs mr-1">
                        {{ $seat->seat_number }}
                    </span>
                    @empty
                    -
                    @endforelse
                </td>

                <td class="p-4 text-slate-500">
                    ${{ number_format($booking->total_price, 2) }}
                </td>

                <td class="p-4">
                    @php
                    $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-700',
                    'confirmed' => 'bg-green-100 text-green-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                    'completed' => 'bg-blue-100 text-blue-700',
                    ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$booking->status] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>

                <td class="p-4">
                    <div class="flex flex-wrap gap-1">

                        @if($booking->status === 'pending')
                        <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" title="Confirm"
                                class="px-2 py-1.5 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 text-xs font-medium">
                                Confirm
                            </button>
                        </form>
                        <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST" class="inline"
                            onsubmit="return confirm('Cancel this booking?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" title="Cancel"
                                class="px-2 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium">
                                Cancel
                            </button>
                        </form>
                        @endif

                        @if($booking->status === 'confirmed')
                        <form action="{{ route('admin.bookings.complete', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" title="Complete"
                                class="px-2 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-medium">
                                Complete
                            </button>
                        </form>
                        @endif

                        <button type="button"
                            class="editBookingBtn rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 p-3"
                            type="button"
                            class="editBookingBtn"
                            data-id="{{ $booking->id }}"
                            data-user="{{ $booking->user_id }}"
                            data-schedule="{{ $booking->route_schedule_id }}"
                            data-seats="{{ $booking->seats->pluck('seat_number')->implode(',') }}"
                            data-status="{{ $booking->status }}" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9" />
                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                            </svg>
                        </button>

                        <button type="button"
                            class="deleteBookingBtn px-2 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100"
                            data-id="{{ $booking->id }}" data-code="{{ $booking->booking_code }}" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18" />
                                <path d="M8 6V4h8v2" />
                                <path d="M19 6l-1 14H6L5 6" />
                            </svg>
                        </button>

                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="8" class="p-8 text-center text-slate-500">
                    No bookings found.
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>

<div class="mt-4">
    {{ $bookings->links() }}
</div>