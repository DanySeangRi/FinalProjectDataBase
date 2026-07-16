<div id="deleteUserModal" class="fixed inset-0 z-50 hidden">


  <div class="absolute inset-0 bg-black/50"></div>


  <div class="relative flex items-center justify-center min-h-screen">


    <div class="bg-white rounded-xl p-6 w-96">


      <h2 class="text-lg font-bold">
        Delete User?
      </h2>


      <p class="text-slate-500 mt-2">
        Are you sure you want to delete
        <span id="deleteUserName"></span>?
      </p>



      <form id="deleteUserForm" method="POST" class="mt-5 flex justify-end">


        @csrf
        @method('DELETE')


        <button class="bg-red-600 text-white px-4 py-2 rounded-lg">
          Delete
        </button>


        <button type="button" id="cancelDelete" class="ml-2 px-4 py-2 border rounded-lg">
          Cancel
        </button>


      </form>


    </div>


  </div>


</div>