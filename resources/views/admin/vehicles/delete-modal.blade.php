<div id="deleteVehicleModal"
    class="fixed inset-0 z-50 hidden">


    <div id="deleteBackdrop"
        class="absolute inset-0 bg-black/50">
    </div>



    <div class="relative flex items-center justify-center min-h-screen p-4">


        <div class="bg-white rounded-2xl w-full max-w-md">


            <div class="p-6">


                <h2 class="text-xl font-bold">
                    Delete Vehicle?
                </h2>



                <p class="mt-3 text-slate-500">

                    Delete

                    <span id="deleteVehicleName"
                        class="font-bold">
                    </span>

                    ?

                </p>


            </div>



            <form id="deleteVehicleForm"
                class="p-6 flex justify-end gap-3">


                @csrf
                @method('DELETE')



                <button
                    type="button"
                    id="cancelDelete"
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