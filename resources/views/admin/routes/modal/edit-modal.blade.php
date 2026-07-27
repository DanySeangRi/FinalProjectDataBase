<div id="editRouteModal" class="fixed inset-0 z-50 hidden">

  <!-- Backdrop -->
  <div id="editRouteBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
  </div>


  <!-- Modal Container -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">


    <!-- Modal Box -->
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">


      <!-- Header -->
      <div class="flex items-center justify-between px-8 py-6 border-b border-slate-200">

        <div>

          <h2 class="text-2xl font-bold text-slate-900">
            Edit Route
          </h2>

          <p class="text-sm text-slate-500 mt-1">
            Update route information and save changes.
          </p>

        </div>


        <button type="button" id="closeEditRouteModal" class="w-10 h-10 flex items-center justify-center rounded-xl
                    text-slate-500 hover:bg-slate-100 transition">

          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

          </svg>

        </button>

      </div>



      <!-- Form -->
      <form id="editRouteForm" class="p-8 space-y-6">

        @csrf
        @method('PUT')


        <input type="hidden" id="edit_route_id" name="id">



        <!-- Origin + Destination -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              FROM
            </label>

            <input id="edit_origin" name="origin" type="text" class="w-full rounded-xl border border-slate-300
                            px-4 py-3 text-sm
                            focus:outline-none
                            focus:ring-4 focus:ring-blue-100
                            focus:border-blue-500">

          </div>



          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              TO
            </label>

            <input id="edit_destination" name="destination" type="text" class="w-full rounded-xl border border-slate-300
                            px-4 py-3 text-sm
                            focus:outline-none
                            focus:ring-4 focus:ring-blue-100
                            focus:border-blue-500">

          </div>


        </div>




        <!-- Distance -->
        <div>

          <label class="block text-sm font-medium text-slate-700 mb-2">
            Distance (KM)
          </label>


          <input id="edit_distance" name="distance" type="number" class="w-full rounded-xl border border-slate-300
                        px-4 py-3 text-sm
                        focus:outline-none
                        focus:ring-4 focus:ring-blue-100
                        focus:border-blue-500">

        </div>





      

       





        <!-- Footer -->

        <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">


          <button type="button" id="cancelEditRoute" class="px-5 py-2.5 rounded-xl
                        border border-slate-300
                        text-slate-700
                        hover:bg-slate-100">

            Cancel

          </button>



          <button type="submit" class="px-6 py-2.5 rounded-xl
                        bg-blue-600
                        text-white
                        hover:bg-blue-700">

            Save Changes

          </button>


        </div>


      </form>


    </div>


  </div>


</div>