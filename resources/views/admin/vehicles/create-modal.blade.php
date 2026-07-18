<div id="createVehicleModal" class="fixed inset-0 z-50 hidden">

  <!-- Backdrop -->
  <div id="modalBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

  <!-- Modal -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">

      <!-- Header -->
      <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">

        <div>
          <h2 class="text-xl font-semibold text-slate-900">
            Add New Vehicle
          </h2>

          <p class="text-sm text-slate-500 mt-1">
            Enter the information below to register a new vehicle.
          </p>
        </div>

        <button type="button" id="closeCreateVehicleModal"
          class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 transition">

          ✕

        </button>

      </div>

      <!-- Form -->
      <form id="createVehicleForm" class="p-6 space-y-5">

        @csrf

        <!-- Vehicle Number -->
        <div>

          <label class="block text-sm font-medium text-slate-700 mb-2">
            Vehicle Number
          </label>

          <input type="text" name="vehicle_number" placeholder="BUS-001" class="w-full rounded-xl border border-slate-300 px-4 py-3
                        text-sm outline-none
                        focus:border-blue-500
                        focus:ring-4
                        focus:ring-blue-100
                        transition">

        </div>

        <!-- Type & Capacity -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Vehicle Type
            </label>

            <select name="type" class="w-full rounded-xl border border-slate-300 px-4 py-3
                            text-sm outline-none bg-white
                            focus:border-blue-500
                            focus:ring-4
                            focus:ring-blue-100
                            transition">

              <option value="">Select Type</option>
              <option value="Bus">Bus</option>
              <option value="Van">Van</option>
              <option value="Car">Car</option>
              <option value="Mini Bus">Mini Bus</option>
              <option value="Truck">Truck</option>

            </select>

          </div>

          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Capacity
            </label>

            <input type="number" name="capacity" placeholder="40" class="w-full rounded-xl border border-slate-300 px-4 py-3
                            text-sm outline-none
                            focus:border-blue-500
                            focus:ring-4
                            focus:ring-blue-100
                            transition">

          </div>

        </div>

        <!-- Driver -->
        <div>

          <label class="block text-sm font-medium text-slate-700 mb-2">
            Driver Name
          </label>

          <input type="text" name="driver_name" placeholder="John Smith" class="w-full rounded-xl border border-slate-300 px-4 py-3
                        text-sm outline-none
                        focus:border-blue-500
                        focus:ring-4
                        focus:ring-blue-100
                        transition">

        </div>

        <!-- Status -->
        <div>

          <label class="block text-sm font-medium text-slate-700 mb-2">
            Status
          </label>

          <select name="status" class="w-full rounded-xl border border-slate-300 px-4 py-3
                        text-sm outline-none bg-white
                        focus:border-blue-500
                        focus:ring-4
                        focus:ring-blue-100
                        transition">

            <option value="active">Active</option>
            <option value="inactive">Inactive</option>

          </select>

        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 pt-5 border-t border-slate-200">

          <button type="button" id="cancelCreateVehicle" class="px-5 py-2.5 rounded-xl border border-slate-300
                        text-sm font-medium text-slate-700
                        hover:bg-slate-100 transition">

            Cancel

          </button>

          <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600
                        text-white text-sm font-medium
                        hover:bg-blue-700
                        shadow-lg shadow-blue-500/20
                        transition">

            Add Vehicle

          </button>

        </div>

      </form>

    </div>

  </div>

</div>