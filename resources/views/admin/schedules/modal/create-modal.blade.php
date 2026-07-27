<!-- Create Schedule Modal -->

<div id="createScheduleModal" class="fixed inset-0 z-50 hidden">


  <!-- Backdrop -->
  <div id="scheduleBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
  </div>



  <!-- Modal Wrapper -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">


    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">


      <!-- Header -->
      <div class="flex justify-between items-center px-8 py-6 border-b">


        <div>

          <h2 class="text-2xl font-bold text-slate-900">
            Create New Schedule
          </h2>


          <p class="text-sm text-slate-500 mt-1">
            Assign route and vehicle for a travel schedule.
          </p>

        </div>



        <button type="button" id="closeScheduleModal" class="w-10 h-10 rounded-xl hover:bg-slate-100">

          ✕

        </button>


      </div>





      <!-- Form -->

      <form id="createScheduleForm" class="p-8 space-y-6">


        @csrf



        <!-- Route + Vehicle -->

        <div class="grid md:grid-cols-2 gap-5">


          <!-- Route -->

          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Route
            </label>


            <select name="route_id" class="w-full rounded-xl border border-slate-300 px-4 py-3">


              <option value="">
                Select Route
              </option>


              @foreach($routes as $route)

                <option value="{{ $route->id }}">

                  {{ $route->origin }}
                  →
                  {{ $route->destination }}

                </option>

              @endforeach


            </select>


          </div>





          <!-- Vehicle -->

          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Vehicle
            </label>


            <select name="vehicle_id" class="w-full rounded-xl border border-slate-300 px-4 py-3">


              <option value="">
                Select Vehicle
              </option>


              @foreach($vehicles as $vehicle)


                <option value="{{ $vehicle->id }}">

                  {{ $vehicle->vehicle_number }}
                  -
                  {{ $vehicle->brand }}

                </option>


              @endforeach


            </select>


          </div>


        </div>







        <!-- Date -->

        <div>


          <label class="block text-sm font-medium text-slate-700 mb-2">
            Travel Date
          </label>


          <input type="date" name="travel_date" class="w-full rounded-xl border border-slate-300 px-4 py-3">


        </div>







        <!-- Time -->

        <div class="grid md:grid-cols-2 gap-5">


          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Departure Time
            </label>


            <input id="departure_time" type="time" name="departure_time"
              class="w-full rounded-xl border border-slate-300 px-4 py-3">


          </div>




          <div>


            <label class="block text-sm font-medium text-slate-700 mb-2">
              Arrival Time
            </label>


            <input id="arrival_time" type="time" name="arrival_time"
              class="w-full rounded-xl border border-slate-300 px-4 py-3">


          </div>



        </div>








        <!-- Price + Seats -->

        <div class="grid md:grid-cols-2 gap-5">


          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Ticket Price ($)
            </label>


            <input type="number" name="price" step="0.01" placeholder="12.00"
              class="w-full rounded-xl border border-slate-300 px-4 py-3">


          </div>



        </div>








        <!-- Footer -->

        <div class="flex justify-end gap-3 pt-6 border-t">


          <button type="button" id="cancelSchedule" class="px-5 py-2.5 rounded-xl border">

            Cancel

          </button>





          <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

            Create Schedule

          </button>



        </div>



      </form>



    </div>


  </div>


</div>