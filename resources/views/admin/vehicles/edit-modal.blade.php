<div id="editVehicleModal" class="fixed inset-0 z-50 hidden">

  <!-- Backdrop -->
  <div id="editBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

  <!-- Modal -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">

      <!-- Header -->
      <div class="flex items-center justify-between px-8 py-6 border-b border-slate-200">

        <div>
          <h2 class="text-2xl font-bold text-slate-900">
            Edit Vehicle
          </h2>

          <p class="mt-1 text-sm text-slate-500">
            Update the vehicle information below.
          </p>
        </div>

        <button type="button" id="closeEditModal"
          class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition">

          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

          </svg>

        </button>

      </div>

      <!-- Form -->
      <form id="editVehicleForm" method="POST" action="" class="p-8 space-y-6">

        @csrf
        @method('PUT')

        <input type="hidden" id="edit_id" name="id">

        <!-- Vehicle Number -->
        <div>

          <label class="block text-sm font-medium text-slate-700 mb-2">
            Vehicle Number
          </label>

          <input id="edit_vehicle_number" name="vehicle_number" type="text" placeholder="BUS-001" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                               focus:outline-none focus:ring-4 focus:ring-blue-100
                               focus:border-blue-500 transition">

        </div>

        <!-- Type & Capacity -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Vehicle Type
            </label>

            <select id="edit_type" name="type" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                   bg-white focus:outline-none
                                   focus:ring-4 focus:ring-blue-100
                                   focus:border-blue-500 transition">

              <option value="Bus">Bus</option>
              <option value="Van">Van</option>
              <option value="Mini Bus">Mini Bus</option>
              <option value="Car">Car</option>
              <option value="Truck">Truck</option>

            </select>

          </div>

          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Capacity
            </label>

            <input id="edit_capacity" name="capacity" type="number" placeholder="40" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                   focus:outline-none
                                   focus:ring-4 focus:ring-blue-100
                                   focus:border-blue-500 transition">

          </div>

        </div>

        <!-- Driver & Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Driver Name
            </label>

            <input id="edit_driver_name" name="driver_name" type="text" placeholder="John Smith" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                   focus:outline-none
                                   focus:ring-4 focus:ring-blue-100
                                   focus:border-blue-500 transition">

          </div>

          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Status
            </label>

            <select id="edit_status" name="status" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm
                                   bg-white focus:outline-none
                                   focus:ring-4 focus:ring-blue-100
                                   focus:border-blue-500 transition">

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
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-200">

          <button type="button" id="cancelEditModal" class="px-5 py-2.5 rounded-xl border border-slate-300
                               text-slate-700 font-medium
                               hover:bg-slate-100 transition">

            Cancel

          </button>

          <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600
                               text-white font-medium
                               hover:bg-blue-700
                               shadow-lg shadow-blue-500/20
                               transition">

            Save Changes

          </button>

        </div>

      </form>

    </div>

  </div>

</div>