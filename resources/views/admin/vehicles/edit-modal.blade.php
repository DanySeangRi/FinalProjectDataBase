<div id="editVehicleModal" class="fixed inset-0 z-50 hidden">

  <!-- Backdrop -->
  <div id="editBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
  </div>


  <!-- Modal -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">


    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200">


      <!-- Header -->
      <div class="flex items-center justify-between px-8 py-6 border-b">


        <div>
          <h2 class="text-2xl font-bold text-slate-900">
            Edit Vehicle
          </h2>

          <p class="text-sm text-slate-500">
            Update vehicle information.
          </p>
        </div>


        <button type="button" id="closeEditModal" class="w-10 h-10 rounded-xl hover:bg-slate-100">

          ✕

        </button>


      </div>



      <!-- Form -->
      <form id="editVehicleForm" method="POST" class="p-8 space-y-6">


        @csrf
        @method('PUT')


        <input type="hidden" id="edit_id">



        <!-- Vehicle Number -->

        <div>

          <label class="block text-sm font-medium mb-2">
            Vehicle Number
          </label>

          <input id="edit_vehicle_number" name="vehicle_number" type="text" class="w-full rounded-xl border px-4 py-3">

        </div>




        <!-- Brand + Plate -->

        <div class="grid md:grid-cols-2 gap-5">


          <div>

            <label class="block text-sm font-medium mb-2">
              Brand
            </label>


            <select id="edit_brand" name="brand" class="w-full rounded-xl border px-4 py-3">


              <option value="Toyota">
                Toyota
              </option>

              <option value="Hyundai">
                Hyundai
              </option>

              <option value="Mercedes-Benz">
                Mercedes-Benz
              </option>

              <option value="Yutong">
                Yutong
              </option>

              <option value="Volvo">
                Volvo
              </option>

              <option value="Isuzu">
                Isuzu
              </option>


            </select>

          </div>



          <div>

            <label class="block text-sm font-medium mb-2">
              Plate Number
            </label>


            <input id="edit_plate_number" name="plate_number" type="text" class="w-full rounded-xl border px-4 py-3">

          </div>


        </div>





        <!-- Type + Year -->

        <div class="grid md:grid-cols-2 gap-5">


          <div>

            <label class="block text-sm font-medium mb-2">
              Type
            </label>


            <select id="edit_type" name="type" class="w-full rounded-xl border px-4 py-3">


              <option value="Bus">
                Bus
              </option>


              <option value="Van">
                Van
              </option>


              <option value="Mini Bus">
                Mini Bus
              </option>


              <option value="Car">
                Car
              </option>


              <option value="Truck">
                Truck
              </option>


            </select>


          </div>



          <div>


            <label class="block text-sm font-medium mb-2">
              Year
            </label>


            <input id="edit_year" name="year" type="number" class="w-full rounded-xl border px-4 py-3">


          </div>


        </div>





        <!-- Capacity + Status -->

        <div class="grid md:grid-cols-2 gap-5">


          <div>

            <label class="block text-sm font-medium mb-2">
              Capacity
            </label>


            <input id="edit_capacity" name="capacity" type="number" class="w-full rounded-xl border px-4 py-3">


          </div>



          <div>

            <label class="block text-sm font-medium mb-2">
              Status
            </label>


            <select id="edit_status" name="status" class="w-full rounded-xl border px-4 py-3">


              <option value="active">
                Active
              </option>


              <option value="inactive">
                Inactive
              </option>


            </select>


          </div>


        </div>





        <!-- Footer -->

        <div class="flex justify-end gap-3 border-t pt-6">


          <button type="button" id="cancelEditModal" class="px-5 py-2 border rounded-xl">

            Cancel

          </button>



          <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl">

            Save Changes

          </button>


        </div>



      </form>


    </div>

  </div>

</div>