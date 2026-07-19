<div id="createRouteModal" class="fixed inset-0 z-50 hidden">

  <!-- Backdrop -->
  <div id="routeBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
  </div>


  <!-- Modal Container -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">


    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">


      <!-- Header -->
      <div class="flex items-center justify-between px-8 py-6 border-b border-slate-200">


        <div>

          <h2 class="text-2xl font-bold text-slate-900">
            Create New Route
          </h2>


          <p class="mt-1 text-sm text-slate-500">
            Add a new travel route to the system.
          </p>

        </div>



        <button type="button" id="closeCreateRouteModal" class="w-10 h-10 flex items-center justify-center rounded-xl 
                    text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition">

          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

          </svg>

        </button>


      </div>




      <!-- Form -->
      <form id="createRouteForm" class="p-8 space-y-6">


        @csrf



        <!-- Origin -->
        <div>

          <label class="block text-sm font-medium text-slate-700 mb-2">
            FROM
          </label>


          <input type="text" name="origin" placeholder="Phnom Penh" class="w-full rounded-xl border border-slate-300 
                        px-4 py-3 text-sm
                        focus:outline-none
                        focus:ring-4 focus:ring-blue-100
                        focus:border-blue-500 transition">

        </div>




        <!-- Destination -->
        <div>

          <label class="block text-sm font-medium text-slate-700 mb-2">
            TO
          </label>


          <input type="text" name="destination" placeholder="Siem Reap" class="w-full rounded-xl border border-slate-300 
                        px-4 py-3 text-sm
                        focus:outline-none
                        focus:ring-4 focus:ring-blue-100
                        focus:border-blue-500 transition">

        </div>




        <!-- Distance & Duration -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


          <div>

            <label class="block text-sm font-medium text-slate-700 mb-2">
              Distance (KM)
            </label>


            <div class="relative">

              <input type="number" name="distance" placeholder="314" class="w-full rounded-xl border border-slate-300 
                                px-4 py-3 text-sm
                                focus:outline-none
                                focus:ring-4 focus:ring-blue-100
                                focus:border-blue-500 transition">


            </div>

          </div>



          <!-- Duration -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">
              Duration
            </label>

            <div class="grid grid-cols-2 gap-4">

              <div>
                <input type="number" name="duration_hours" placeholder="Hours (5)" min="0" class="w-full rounded-xl border border-slate-300 
                px-4 py-3 text-sm
                focus:outline-none
                focus:ring-4 focus:ring-blue-100
                focus:border-blue-500">
              </div>


              <div>
                <input type="number" name="duration_minutes" placeholder="Minutes (30)" min="0" max="59" class="w-full rounded-xl border border-slate-300 
                px-4 py-3 text-sm
                focus:outline-none
                focus:ring-4 focus:ring-blue-100
                focus:border-blue-500">
              </div>

            </div>
          </div>


        </div>






        <!-- Footer -->
        <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">


          <button type="button" id="cancelCreateRoute" class="px-5 py-2.5 rounded-xl border border-slate-300
                        text-slate-700 font-medium
                        hover:bg-slate-100 transition">

            Cancel

          </button>



          <button type="submit" class="px-6 py-2.5 rounded-xl
                        bg-blue-600 text-white font-medium
                        hover:bg-blue-700
                        shadow-lg shadow-blue-500/20
                        transition">

            Create Route

          </button>


        </div>


      </form>



    </div>


  </div>


</div>