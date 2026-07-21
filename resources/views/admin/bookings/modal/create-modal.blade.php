<div id="createBookingModal" class="fixed inset-0 z-50 hidden">

    <!-- Backdrop -->
    <div id="bookingBackdrop"
        class="absolute inset-0 bg-black/50 backdrop-blur-sm">
    </div>

    <!-- Modal -->
    <div class="relative z-10 flex items-center justify-center min-h-screen p-4">

        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">

            <!-- Header -->
            <div class="flex items-center justify-between px-8 py-6 border-b">

                <div>
                    <h2 class="text-2xl font-bold text-slate-900">
                        Create Booking
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Assign a passenger to a travel schedule.
                    </p>
                </div>

                <button
                    type="button"
                    id="closeBookingModal"
                    class="w-10 h-10 rounded-xl hover:bg-slate-100">

                    ✕

                </button>

            </div>

            <form id="createBookingForm" class="p-8 space-y-6">

                @csrf

                <!-- Passenger -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Passenger
                    </label>

                    <select
                        name="user_id"
                        class="w-full rounded-xl border px-4 py-3">

                        <option value="">
                            Select Passenger
                        </option>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}">

                                {{ $user->first_name }}
                                {{ $user->last_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Schedule -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Schedule
                    </label>

                    <select
                        id="scheduleSelect"
                        name="route_schedule_id"
                        class="w-full rounded-xl border px-4 py-3">

                        <option value="">
                            Select Schedule
                        </option>

                        @foreach($schedules as $schedule)

                            <option
                                value="{{ $schedule->id }}"
                                data-price="{{ $schedule->price }}">

                                {{ $schedule->route->origin }}
                                →
                                {{ $schedule->route->destination }}

                                |

                                {{ $schedule->travel_date }}

                                |

                                {{ $schedule->departure_time }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Seat + Price -->
                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Seat Number
                        </label>

                        <input
                            type="text"
                            name="seat_number"
                            placeholder="1A"
                            class="w-full rounded-xl border px-4 py-3">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Ticket Price
                        </label>

                        <input
                            id="bookingPrice"
                            type="text"
                            readonly
                            class="w-full rounded-xl border bg-slate-100 px-4 py-3">

                    </div>

                </div>

                <div class="flex justify-end gap-3 pt-6 border-t">

                    <button
                        type="button"
                        id="cancelBooking"
                        class="px-5 py-2 rounded-xl border">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-xl">

                        Create Booking

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>