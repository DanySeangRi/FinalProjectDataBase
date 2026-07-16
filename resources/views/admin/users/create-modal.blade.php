<div id="createUserModal" class="fixed inset-0 z-50 hidden">
   <!-- Backdrop -->
  <div id="modalBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div> <!-- Modal -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">
      <!-- Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">
          <div>
            <h2 class="text-xl font-semibold text-slate-900"> Create User </h2>
            <p class="text-sm text-slate-500 mt-1"> Add a new user to your system. </p>
          </div> <button type="button" id="closeCreateUserModal"
            class="w-10 h-10 rounded-lg hover:bg-slate-100 text-slate-500 transition"> ✕ </button>
        </div> <!-- Errors -->

      <div id="createUserErrors" class="hidden mx-6 mt-5 rounded-xl border border-red-200 bg-red-50 p-4">
        <ul id="createUserErrorList" class="text-sm text-red-700 space-y-1 list-disc list-inside"> </ul>
      </div> <!-- Form -->

      <form id="createUserForm" class="p-6 space-y-5"> 
        @csrf
        <div class="grid grid-cols-2 gap-4">

          <div> <label class="block text-sm font-medium text-slate-700 mb-2"> First Name </label> <input type="text"
              name="first_name" placeholder="John"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
          </div>

          <div> <label class="block text-sm font-medium text-slate-700 mb-2"> Last Name </label> <input type="text"
              name="last_name" placeholder="Doe"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
          </div>

        </div>

        <div>
           <label class="block text-sm font-medium text-slate-700 mb-2"> Email </label> <input type="email"
            name="email" placeholder="john@example.com"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
        </div>

        <div> 
          <label class="block text-sm font-medium text-slate-700 mb-2"> Phone </label> <input type="text"
            name="phone" placeholder="+855 12 345 678"
            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
        </div>

        <div class="grid grid-cols-2 gap-4">

          <div> <label class="block text-sm font-medium text-slate-700 mb-2"> Password </label> <input type="password"
              name="password" placeholder="••••••••"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
          </div>

          <div> 
            <label class="block text-sm font-medium text-slate-700 mb-2"> Confirm Password </label> <input
              type="password" name="password_confirmation" placeholder="••••••••"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
          </div>
        </div> <!-- Footer -->

        <div class="flex justify-end gap-3 pt-3 border-t border-slate-200"> <button type="button" id="cancelCreateUser"
            class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 transition"> Cancel
          </button> 
          <button type="submit"
            class="px-6 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition">
            Create User 
          </button> 
        </div>
      </form>
    </div>
  </div>
</div>