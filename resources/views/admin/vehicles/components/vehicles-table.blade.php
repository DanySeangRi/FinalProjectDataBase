<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

  <table class="w-full text-sm">

    <thead>
      <tr class="border-b bg-slate-50">

        <th class="p-4 text-left">
          Vehicle Number
        </th>

        <th class="p-4 text-left">
          Brand
        </th>
        <th class="p-4 text-left">
          Type
        </th>

        <th class="p-4 text-left">
          Capacity
        </th>

        <th class="p-4 text-left">
          Driver
        </th>

        <th class="p-4 text-left">
          Status
        </th>



        <th class="p-4 text-left">
          Actions
        </th>

      </tr>
    </thead>


    <tbody>

      @foreach($vehicles as $vehicle)

        <tr class="border-b hover:bg-slate-50">


          <td class="p-4 font-medium">
            <div class="flex">
              <div class="bg-[#DBEAFE] text-[#2563EB] mr-3 p-1 rounded-2xl ">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide lucide-bus-icon lucide-bus">
                  <path d="M8 6v6" />
                  <path d="M15 6v6" />
                  <path d="M2 12h19.6" />
                  <path
                    d="M18 18h3s.5-1.7.8-2.8c.1-.4.2-.8.2-1.2 0-.4-.1-.8-.2-1.2l-1.4-5C20.1 6.8 19.1 6 18 6H4a2 2 0 0 0-2 2v10h3" />
                  <circle cx="7" cy="18" r="2" />
                  <path d="M9 18h5" />
                  <circle cx="16" cy="18" r="2" />
                </svg>


              </div>
              <div class="mt-1">
                {{ $vehicle->vehicle_number }}
              </div>



            </div>
          </td>


          <td class="p-4 text-slate-500">
            {{ $vehicle->brand }}
          </td>

          <td class="p-4">
            @if ($vehicle->type == "VIP Sleeper")
              <span
                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-700 border border-purple-200">
                VIP Sleeper
              </span>

            @elseif ($vehicle->type == "Express Bus")
              <span
                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700 border border-blue-200">
                Express Bus
              </span>

            @elseif ($vehicle->type == "Standard Bus")
              <span
                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">
                Standard Bus
              </span>

            @else
              <span
                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                {{ $vehicle->type }}
              </span>
            @endif
          </td>


          <td class="p-4 text-slate-500">
            {{ $vehicle->capacity }} seats
          </td>


          <td class="p-4 text-slate-500">
            {{ $vehicle->driver_name ?? 'No Driver' }}
          </td>


          <td class="p-4">

            @if($vehicle->status === 'active')

              <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">
                Active
              </span>

            @else

              <span class="px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">
                Inactive
              </span>

            @endif

          </td>


          <td class="p-4">

            <div class="flex gap-2">


              <button type="button"
                class="editVehicleBtn px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100"
                data-id="{{ $vehicle->id }}" data-number="{{ $vehicle->vehicle_number }}"
                data-brand="{{ $vehicle->brand }}" data-plate="{{ $vehicle->plate_number }}"
                data-type="{{ $vehicle->type }}" data-year="{{ $vehicle->year }}" data-capacity="{{ $vehicle->capacity }}"
                data-status="{{ $vehicle->status }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 20h9" />
                  <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                </svg>

              </button>



              <button type="button"
                class="deleteVehicleBtn px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100"
                data-id="{{ $vehicle->id }}" data-name="{{ $vehicle->vehicle_number }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 6h18" />
                  <path d="M8 6V4h8v2" />
                  <path d="M19 6l-1 14H6L5 6" />
                  <path d="M10 11v6" />
                  <path d="M14 11v6" />
                </svg>



              </button>


            </div>

          </td>


        </tr>


      @endforeach


    </tbody>


  </table>


</div>


<div class="mt-4">

  {{ $vehicles->links() }}

</div>