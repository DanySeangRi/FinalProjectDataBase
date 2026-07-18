<div id="createVehicleModal" class="fixed inset-0 z-50 hidden">


  <!-- Backdrop -->
  <div id="modalBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
  </div>



  <!-- Modal -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">


    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">


      <!-- Header -->
      <div class="flex items-center justify-between px-8 py-6 border-b border-slate-200">


        <div>

          <h2 class="text-2xl font-bold text-slate-900">
            Add New Vehicle
          </h2>


          <p class="text-sm text-slate-500 mt-1">
            Register a new vehicle into the system.
          </p>

        </div>



        <button type="button" id="closeCreateVehicleModal" class="w-10 h-10 rounded-xl flex items-center justify-center
                    text-slate-500 hover:bg-slate-100 transition">

          ✕

        </button>


      </div>





      <!-- Form -->
      <form id="createVehicleForm" class="p-8 space-y-6">


        @csrf



        <!-- Vehicle Number -->
        <div>

          <label class="block text-sm font-medium text-slate-700 mb-2">
            Vehicle Number
          </label>


          <input type="text" name="vehicle_number" placeholder="BUS-001" class="w-full rounded-xl border border-slate-300 px-4 py-3
                        text-sm focus:ring-4 focus:ring-blue-100
                        focus:border-blue-500 outline-none transition">

        </div>





        <!-- Brand + Type -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


          <!-- Brand -->
          <div>


            <label class="block text-sm font-medium text-slate-700 mb-2">
              Vehicle Brand
            </label>


            <select name="brand" class="w-full rounded-xl border border-slate-300 px-4 py-3
                            bg-white text-sm focus:ring-4 focus:ring-blue-100
                            focus:border-blue-500 outline-none">


              <option value="">
                Select Brand
              </option>

              <option value="Toyota">
                Toyota
              </option>

              <option value="Hyundai">
                Hyundai
              </option>

              <option value="Mercedes-Benz">
                Mercedes-Benz
              </option>

              <option value="Hino">
                Hino
              </option>

              <option value="Isuzu">
                Isuzu
              </option>

              <option value="Volvo">
                Volvo
              </option>

              <option value="Scania">
                Scania
              </option>

              <option value="MAN">
                MAN
              </option>

              <option value="Yutong">
                Yutong
              </option>

              <option value="King Long">
                King Long
              </option>


            </select>


          </div>





          <!-- Type -->
          <div>


            <label class="block text-sm font-medium text-slate-700 mb-2">
              Vehicle Type
            </label>


            <select name="type" class="w-full rounded-xl border border-slate-300 px-4 py-3
                            bg-white text-sm focus:ring-4 focus:ring-blue-100
                            focus:border-blue-500 outline-none">


              <option value="">
                Select Type
              </option>

              <option value="VIP Bus">
                VIP Bus
              </option>

              <option value="Standard Bus">
                Standard Bus
              </option>

              <option value="Express Bus">
                Express Bus
              </option>

              <option value="Mini Bus">
                Mini Bus
              </option>

              <option value="Van">
                Van
              </option>

              <option value="Car">
                Car
              </option>

              <option value="Truck">
                Truck
              </option>


            </select>


          </div>


        </div>





        <!-- Plate + Year -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Plate Number
            </label>


            <input type="text" name="plate_number" placeholder="2AB-1234" class="w-full rounded-xl border border-slate-300 px-4 py-3
                            text-sm focus:ring-4 focus:ring-blue-100
                            focus:border-blue-500 outline-none">


          </div>





          <div>


            <label class="block text-sm font-medium text-slate-700 mb-2">
              Manufacturing Year
            </label>


            <input type="number" name="year" placeholder="2025" min="1900" max="{{ date('Y') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3
                            text-sm focus:ring-4 focus:ring-blue-100
                            focus:border-blue-500 outline-none">


          </div>


        </div>






        <!-- Capacity + Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">



          <div>


            <label class="block text-sm font-medium text-slate-700 mb-2">
              Capacity
            </label>


            <input type="number" name="capacity" placeholder="40" class="w-full rounded-xl border border-slate-300 px-4 py-3
                            text-sm focus:ring-4 focus:ring-blue-100
                            focus:border-blue-500 outline-none">


          </div>






          <div>


            <label class="block text-sm font-medium text-slate-700 mb-2">
              Status
            </label>


            <select name="status" class="w-full rounded-xl border border-slate-300 px-4 py-3
                            bg-white text-sm focus:ring-4 focus:ring-blue-100
                            focus:border-blue-500 outline-none">


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
        <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">


          <button type="button" id="cancelCreateVehicle" class="px-5 py-2.5 rounded-xl border border-slate-300
                        text-slate-700 hover:bg-slate-100 transition">

            Cancel

          </button>




          <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 text-white
                        hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition">

            Add Vehicle

          </button>


        </div>


      </form>


    </div>


  </div>


</div>