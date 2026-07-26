<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">


  <table class="w-full text-sm">


    <thead>

      <tr class="border-b bg-slate-50">


        <th class="p-4 text-left">
          Booking Code
        </th>


        <th class="p-4 text-left">
          Customer
        </th>


        <th class="p-4 text-left">
          Schedule
        </th>


        <th class="p-4 text-left">
          Vehicle Number
        </th>


        <th class="p-4 text-left">
          Seat
        </th>


        <th class="p-4 text-left">
          Price
        </th>


        <th class="p-4 text-left">
          Status
        </th>


        <th class="p-4 text-left">
          Actions
        </th>


      </tr>


    </thead>




    <tbody>


      @foreach($bookings as $booking)


        <tr class="border-b hover:bg-slate-50">



          <!-- Booking Code -->

          <td class="p-4 font-medium text-slate-900">

            {{ $booking->booking_code }}

          </td>





          <!-- User -->

          <td class="p-4">


            <div class="font-medium">

              {{ $booking->user->first_name }}
              {{ $booking->user->last_name }}

            </div>


            <div class="text-xs text-slate-400">

              {{ $booking->user->email }}

            </div>


          </td>






          <!-- Schedule -->

          <td class="p-4">


            <div class="font-medium">


              @if($booking->routeSchedule && $booking->routeSchedule->route)

                {{ $booking->routeSchedule->route->origin }}

                →

                {{ $booking->routeSchedule->route->destination }}

              @else

                <span class="text-red-500">
                  Schedule Deleted
                </span>

              @endif


            </div>



            <div class="text-xs text-slate-400">


              @if($booking->routeSchedule)

                {{ $booking->routeSchedule->travel_date }}

                |

                {{ $booking->routeSchedule->departure_time }}

              @else

                -

              @endif

            </div>


          </td>
          <td class="p-4 text-slate-500">

            @if($booking->routeSchedule && $booking->routeSchedule->vehicle)

              {{ $booking->routeSchedule->vehicle->vehicle_number }}

            @else

              -

            @endif

          </td>







          <!-- Seat -->

          <td class="p-4 text-slate-500">

            @foreach($booking->seats as $seat)

              <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs">

                {{ $seat->seat_number }}

              </span>

            @endforeach

          </td>







          <!-- Price -->

          <td class="p-4 text-slate-500">

            ${{ number_format($booking->total_price, 2) }}

          </td>







          <!-- Status -->

          <td class="p-4">


            @if($booking->status === 'confirmed')


              <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">

                Confirmed

              </span>



            @elseif($booking->status === 'cancelled')


              <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">

                Cancelled

              </span>



            @else


              <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">

                Pending

              </span>


            @endif


          </td>








          <!-- Actions -->

          <td class="p-4">


            <div class="flex gap-2">



              <button type="button"
                class="editBookingBtn px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100"
                data-id="{{ $booking->id }}" data-user="{{ $booking->user_id }}"
                data-schedule="{{ $booking->route_schedule_id }}"
                data-seats="{{ $booking->bookingSeats->pluck('seat_id')->implode(',') }}"
                data-status="{{ $booking->status }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2">

                  <path d="M12 20h9" />
                  <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />

                </svg>

              </button>





              <button type="button"
                class="deleteBookingBtn px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100"
                data-id="{{ $booking->id }}" data-code="{{ $booking->booking_code }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2">

                  <path d="M3 6h18" />
                  <path d="M8 6V4h8v2" />
                  <path d="M19 6l-1 14H6L5 6" />
                  <path d="M10 11v6" />
                  <path d="M14 11v6" />

                </svg>

              </button>



            </div>


          </td>



        </tr>



      @endforeach



    </tbody>


  </table>


</div>




<div class="mt-4">

  {{ $bookings->links() }}

</div>