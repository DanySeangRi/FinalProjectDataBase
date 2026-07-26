<div id="editBookingModal" class="fixed inset-0 z-50 hidden">

    <div id="editBookingBackdrop"
        class="absolute inset-0 bg-black/50 backdrop-blur-sm">
    </div>

    <div class="relative z-10 flex items-center justify-center min-h-screen p-4">

        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl">

            <div class="flex justify-between items-center px-8 py-6 border-b">

                <div>

                    <h2 class="text-2xl font-bold">
                        Edit Booking
                    </h2>

                    <p class="text-sm text-slate-500">
                        Update booking information.
                    </p>

                </div>

                <button
                    type="button"
                    id="closeEditBookingModal">

                    ✕

                </button>

            </div>

            <form
                id="editBookingForm"
                method="POST"
                action=""
                class="p-8 space-y-6">

                @csrf
                @method('PUT')

                <!-- Passenger -->

                <div>

                    <label class="block mb-2">
                        Passenger
                    </label>

                    <select
                        id="edit_user"
                        name="user_id"
                        class="w-full rounded-xl border px-4 py-3">

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

                    <label class="block mb-2">
                        Schedule
                    </label>

                    <select
                        id="edit_schedule"
                        name="route_schedule_id"
                        class="w-full rounded-xl border px-4 py-3">

                        @foreach($schedules as $schedule)

                            <option value="{{ $schedule->id }}">

                                {{ $schedule->route->origin }}
                                →

                                {{ $schedule->route->destination }}

                                |

                                {{ $schedule->travel_date }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Seat -->

                <div>

                    <label class="block mb-2">
                        Seat Number
                    </label>

                    <input
                        id="edit_seat"
                        name="seat_number"
                        class="w-full rounded-xl border px-4 py-3">

                    <input type="hidden" name="seats[]" value="">

                </div>

                <!-- Status -->

                <div>

                    <label class="block mb-2">
                        Status
                    </label>

                    <select
                        id="edit_status"
                        name="status"
                        class="w-full rounded-xl border px-4 py-3">

                        <option value="pending">
                            Pending
                        </option>

                        <option value="confirmed">
                            Confirmed
                        </option>

                        <option value="cancelled">
                            Cancelled
                        </option>

                    </select>

                </div>

                <div class="flex justify-end gap-3 pt-6 border-t">

                    <button
                        type="button"
                        id="cancelEditBooking">

                        Cancel

                    </button>

                    <button
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl">

                        Save Changes

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>