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







          <!-- Seat -->

          <td class="p-4 text-slate-500">

            {{ $booking->seat_number }}

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
                class="editBookingBtn px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">


                Edit


              </button>





              <button type="button"
                class="deleteBookingBtn px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">


                Delete


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