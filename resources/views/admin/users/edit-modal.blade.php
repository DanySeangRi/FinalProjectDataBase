<div id="editUserModal" class="fixed inset-0 z-50 hidden">

    <!-- Backdrop -->
    <div id="editBackdrop"
        class="absolute inset-0 bg-black/50 backdrop-blur-sm">
    </div>


    <!-- Modal Container -->
    <div class="relative z-10 flex items-center justify-center min-h-screen p-4">


        <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">


            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">


                <div>
                    <h2 class="text-xl font-semibold text-slate-900">
                        Edit User
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Update user information below.
                    </p>
                </div>


                <button
                    type="button"
                    id="closeEditModal"
                    class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 transition">

                    ✕

                </button>


            </div>




            <!-- Form -->
            <form id="editUserForm" class="p-6 space-y-5">


                @csrf
                @method('PUT')


                <input 
                    type="hidden"
                    id="edit_id"
                    name="id"
                >



                <div class="grid grid-cols-2 gap-4">


                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            First Name
                        </label>


                        <input
                            id="edit_first_name"
                            name="first_name"
                            type="text"
                            placeholder="John"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none
                            focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">

                    </div>



                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Last Name
                        </label>


                        <input
                            id="edit_last_name"
                            name="last_name"
                            type="text"
                            placeholder="Doe"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none
                            focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">

                    </div>


                </div>




                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Email Address
                    </label>


                    <input
                        id="edit_email"
                        name="email"
                        type="email"
                        placeholder="john@example.com"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none
                        focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">


                </div>





                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Phone Number
                    </label>


                    <input
                        id="edit_phone"
                        name="phone_number"
                        type="text"
                        placeholder="+855 12 345 678"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none
                        focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">


                </div>





                <!-- Footer -->
                <div class="flex justify-end gap-3 pt-5 border-t border-slate-200">


                    <button
                        type="button"
                        id="cancelEditModal"
                        class="px-5 py-2.5 rounded-xl border border-slate-300 
                        text-slate-700 hover:bg-slate-100 transition">

                        Cancel

                    </button>



                    <button
                        type="submit"
                        class="px-6 py-2.5 rounded-xl bg-blue-600 text-white 
                        hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition">

                        Save Changes

                    </button>


                </div>


            </form>


        </div>


    </div>


</div>