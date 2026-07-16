<div class="bg-white rounded-xl border border-slate-200">

  <table class="w-full text-sm">

    <thead>

      <tr class="border-b">

        <th class="p-4 text-left">
          User
        </th>

        <th class="p-4 text-left">
          Phone Number
        </th>

        <th class="p-4 text-left">
          Email
        </th>

        <th class="p-4 text-left">
          Joined
        </th>

        <th class="p-4 text-left">
          Actions
        </th>

      </tr>

    </thead>



    <tbody>


      @foreach($users as $user)

        @if($user->role === 'user')
          <tr class="border-b hover:bg-slate-50">


            <td class="p-4">

              {{ $user->first_name }}
              {{ $user->last_name }}

            </td>


            <td class="p-4 text-slate-500">

              {{ $user->phone_number }}

            </td>


            <td class="p-4 text-slate-500">

              {{ $user->email }}

            </td>


            <td class="p-4 text-slate-400">

              {{ $user->created_at->format('M d, Y H:i') }}

            </td>


            <td class="p-4">

              <div class="flex gap-2">

                <!-- Edit Button -->
                <button type="button"
                  class="editUserBtn flex items-center gap-2 px-3 py-1.5 text-sm rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100"
                  data-id="{{ $user->id }}" data-first="{{ $user->first_name }}" data-last="{{ $user->last_name }}"
                  data-email="{{ $user->email }}" data-phone="{{ $user->phone_number }}">

                  <!-- Pencil Icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9" />
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                  </svg>

                  Edit

                </button>


                <!-- Delete Button -->
                <button type="button"
                  class="deleteUserBtn flex items-center gap-2 px-3 py-1.5 text-sm rounded-lg bg-red-50 text-red-600 hover:bg-red-100"
                  data-id="{{ $user->id }}" data-name="{{ $user->first_name }} {{ $user->last_name }}">

                  <!-- Trash Icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18" />
                    <path d="M8 6V4h8v2" />
                    <path d="M19 6l-1 14H6L5 6" />
                    <path d="M10 11v6" />
                    <path d="M14 11v6" />
                  </svg>

                  Delete

                </button>

              </div>

            </td>


          </tr>
        @endif

      @endforeach


    </tbody>


  </table>


</div>


<div class="mt-4">

  {{ $users->links() }}

</div>