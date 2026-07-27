<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">


  <table class="w-full text-sm">


    <thead>

      <tr class="border-b bg-slate-50">


        <th class="p-4 text-left">
          Route
        </th>


        <th class="p-4 text-left">
          Vehicle
        </th>


        <th class="p-4 text-left">
          Travel Date
        </th>


        <th class="p-4 text-left">
          Departure Time
        </th>

        <th class="p-4 text-left">
          Duration
        </th>

        <th class="p-4 text-left">
          Price
        </th>


        <th class="p-4 text-left">
          Seats
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


      @forelse($routeSchedules as $schedule)


        <tr class="border-b hover:bg-slate-50">


          <!-- Route -->

          <td class="p-4">
            <div class="flex gap-2">
              <div class="bg-[#86C5FF] text-white p-2 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide lucide-calendar-check2-icon lucide-calendar-check-2">
                  <path d="M8 2v4" />
                  <path d="M16 2v4" />
                  <path d="M21 14V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8" />
                  <path d="M3 10h18" />
                  <path d="m16 20 2 2 4-4" />
                </svg>
              </div>
              <div class="font-medium mt-2 text-slate-900">

                {{ $schedule->route->origin ?? 'N/A' }}

                →

                {{ $schedule->route->destination ?? 'N/A' }}

              </div>
            </div>






          </td>





          <!-- Vehicle -->

          <td class="p-4 text-slate-500">


            <div>

              {{ $schedule->vehicle->vehicle_number ?? 'No Vehicle' }}

            </div>


            <div class="text-xs text-slate-400">

              {{ $schedule->vehicle->brand ?? '' }}

            </div>


          </td>





          <!-- Date -->

          <td class="p-4 text-slate-500">


            {{ \Carbon\Carbon::parse($schedule->travel_date)->format('M d, Y') }}


          </td>





          <!-- Time -->

          <<td class="p-4 text-slate-500">

            <div class="flex gap-1 items-center">

              <div class="text-blue-600">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                  <circle cx="12" cy="12" r="10" />
                  <path d="M12 6v6l4 2" />

                </svg>

              </div>


              <div>

                <div>
                  {{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }}

                  -

                  {{ \Carbon\Carbon::parse($schedule->arrival_time)->format('H:i') }}
                </div>


                <div class="text-xs text-slate-400 mt-1">

                  @php
                    $hours = floor($schedule->duration_minutes / 60);
                    $minutes = $schedule->duration_minutes % 60;
                  @endphp


                  Duration:

                  @if($hours > 0)
                    {{ $hours }}h {{ $minutes }}m
                  @else
                    {{ $minutes }}m
                  @endif

                </div>

              </div>

            </div>

            </td>






            <!-- Price -->

            <td class="p-4 font-medium">


              ${{ number_format($schedule->price, 2) }}


            </td>





            <!-- Seats -->

            <td class="p-4 text-slate-500">


              {{ $schedule->available_seats }} seats


            </td>






            <!-- Status -->

            <td class="p-4">


              @if($schedule->status === 'active')


                <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">

                  Active

                </span>


              @elseif($schedule->status === 'completed')


                <span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">

                  Completed

                </span>


              @else


                <span class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">

                  Cancelled

                </span>


              @endif


            </td>







            <!-- Actions -->

            <td class="p-4">


              <div class="flex gap-2">


                <button type="button"
                  class="editScheduleBtn px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100"
                  data-id="{{ $schedule->id }}" data-route="{{ $schedule->route_id }}"
                  data-vehicle="{{ $schedule->vehicle_id }}" data-date="{{ $schedule->travel_date }}"
                  data-departure="{{ $schedule->departure_time }}" data-arrival="{{ $schedule->arrival_time }}"
                  data-price="{{ $schedule->price }}" data-seats="{{ $schedule->available_seats }}"
                  data-status="{{ $schedule->status }}">

                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9" />
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                  </svg>

                </button>





                <button type="button"
                  class="deleteScheduleBtn px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100"
                  data-id="{{ $schedule->id }}"
                  data-name="{{ $schedule->route->origin }} → {{ $schedule->route->destination }}">


                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

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


      @empty


        <tr>

          <td colspan="8" class="p-8 text-center text-slate-500">

            No schedules found.

          </td>

        </tr>


      @endforelse



    </tbody>


  </table>



</div>
<div class="mt-6 ">


  <div>
    {{ $routeSchedules->onEachSide(1)->links() }}
  </div>

</div>