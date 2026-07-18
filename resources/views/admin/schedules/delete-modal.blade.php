<div id="deleteScheduleModal" class="fixed inset-0 z-50 hidden">


    <!-- Backdrop -->
    <div id="deleteScheduleBackdrop"
        class="absolute inset-0 bg-black/50 backdrop-blur-sm">
    </div>



    <!-- Modal -->

    <div class="relative z-10 flex items-center justify-center min-h-screen p-4">


        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">


            <h2 class="text-xl font-bold text-slate-900">
                Delete Schedule
            </h2>


            <p class="text-sm text-slate-500 mt-2">

                Are you sure you want to delete:

                <span id="deleteScheduleName"
                class="font-semibold text-slate-700">
                </span>

            </p>



            <form id="deleteScheduleForm"
                class="flex justify-end gap-3 mt-6">


                @csrf

                @method('DELETE')


                <button
                    type="button"
                    id="cancelDeleteSchedule"
                    class="px-5 py-2 border rounded-xl">

                    Cancel

                </button>



                <button
                    type="submit"
                    class="px-5 py-2 bg-red-600 text-white rounded-xl">

                    Delete

                </button>


            </form>


        </div>


    </div>


</div>