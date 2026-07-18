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
                    {{ $vehicle->vehicle_number }}
                </td>


                <td class="p-4 text-slate-500">
                    {{ $vehicle->brand }}
                </td>

                 <td class="p-4 text-slate-500">
                    {{ $vehicle->type }}
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


                      <button
                          type="button"
                          class="editVehicleBtn px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100"

                          data-id="{{ $vehicle->id }}"
                          data-number="{{ $vehicle->vehicle_number }}"
                          data-brand="{{ $vehicle->brand }}"
                          data-plate="{{ $vehicle->plate_number }}"
                          data-type="{{ $vehicle->type }}"
                          data-year="{{ $vehicle->year }}"
                          data-capacity="{{ $vehicle->capacity }}"
                          data-status="{{ $vehicle->status }}"
                      >

                          Edit

                    </button>



                        <button
                            type="button"
                            class="deleteVehicleBtn px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100"

                            data-id="{{ $vehicle->id }}"
                            data-name="{{ $vehicle->vehicle_number }}"
                        >

                            Delete

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