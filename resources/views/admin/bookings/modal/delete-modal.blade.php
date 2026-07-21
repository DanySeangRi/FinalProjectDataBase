<div id="deleteBookingModal" class="fixed inset-0 z-50 hidden">

  <!-- Backdrop -->
  <div id="deleteBookingBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
  </div>

  <!-- Modal -->
  <div class="relative z-10 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl">

      <div class="p-8">

        <div class="w-14 h-14 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-5">

          🗑️

        </div>

        <h2 class="text-xl font-bold text-center">
          Delete Booking
        </h2>

        <p class="text-slate-500 text-center mt-2">

          Are you sure you want to delete

          <br>

          <strong id="deleteBookingCode"></strong>?

        </p>

        <form id="deleteBookingForm" method="POST" action="" class="mt-8">

          @csrf
          @method('DELETE')

          <div class="flex justify-end gap-3">

            <button type="button" id="cancelDeleteBooking" class="px-5 py-2 rounded-xl border">

              Cancel

            </button>

            <button class="px-5 py-2 rounded-xl bg-red-600 text-white">

              Delete

            </button>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>