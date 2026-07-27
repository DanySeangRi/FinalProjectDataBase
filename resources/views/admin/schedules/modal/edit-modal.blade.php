<div id="editScheduleModal" class="fixed inset-0 z-50 hidden">


  <div id="editScheduleBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
  </div>



  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">


    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">


      <h2 class="text-2xl font-bold mb-6">
        Edit Schedule
      </h2>



      <form id="editScheduleForm">


        @csrf
        @method('PUT')


        <select id="edit_route" name="route_id" class="w-full border rounded-xl p-3 mb-4">


          @foreach($routes as $route)

            <option value="{{ $route->id }}">

              {{ $route->origin }}
              -
              {{ $route->destination }}

            </option>

          @endforeach


        </select>




        <select id="edit_vehicle" name="vehicle_id" class="w-full border rounded-xl p-3 mb-4">


          @foreach($vehicles as $vehicle)

            <option value="{{ $vehicle->id }}">

              {{ $vehicle->vehicle_number }}

            </option>

          @endforeach


        </select>




        <input id="edit_date" name="travel_date" type="date" class="w-full border rounded-xl p-3 mb-4">



        <div class="grid grid-cols-2 gap-4">


          <input id="edit_departure" name="departure_time" type="time" class="border rounded-xl p-3">



          <input id="edit_arrival" name="arrival_time" type="time" class="border rounded-xl p-3">


        </div>



        <input id="edit_price" name="price" type="number" step="0.01" class="w-full border rounded-xl p-3 mt-4">



        <input id="edit_seats" name="available_seats" type="number" class="w-full border rounded-xl p-3 mt-4">
        <div class="mt-4">
          <label class="block text-sm font-medium text-slate-700 mb-2">
            Duration
          </label>

          <div id="editDurationPreview" class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3">
            0h 0m
          </div>

          <input type="hidden" id="edit_duration_minutes" name="duration_minutes">
        </div>





        <div class="flex justify-end gap-3 mt-6">


          <button type="button" id="cancelEditSchedule" class="px-5 py-2 border rounded-xl">

            Cancel

          </button>


          <button class="px-6 py-2 bg-blue-600 text-white rounded-xl">

            Save

          </button>


        </div>



      </form>


    </div>


  </div>


</div>