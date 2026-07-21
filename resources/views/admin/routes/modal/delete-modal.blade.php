
<div id="deleteRouteModal" class="fixed inset-0 z-50 hidden">

  <div id="deleteRouteBackdrop" class="absolute inset-0 bg-black/50"></div>



  <div class="relative flex justify-center items-center min-h-screen">


    <div class="bg-white rounded-2xl p-6 w-full max-w-md">


      <h2 class="text-xl font-bold">
        Delete Route?
      </h2>



      <p class="text-slate-500 mt-2">

        Are you sure you want to delete

        <span id="deleteRouteName" class="font-semibold">
        </span>

        ?

      </p>




      <form id="deleteRouteForm" class="mt-6 flex justify-end gap-3">


        @csrf
        @method('DELETE')


        <button type="button" id="cancelDeleteRoute" class="px-5 py-2 border rounded-xl">

          Cancel

        </button>



        <button class="px-5 py-2 bg-red-600 text-white rounded-xl">

          Delete

        </button>


      </form>


    </div>


  </div>


</div>