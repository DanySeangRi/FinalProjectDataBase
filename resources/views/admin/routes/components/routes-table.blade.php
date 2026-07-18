<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">


  <table class="w-full text-sm">


    <thead>


      <tr class="border-b bg-slate-50">


        <th class="p-4 text-left">
          Origin
        </th>


        <th class="p-4 text-left">
          Destination
        </th>


        <th class="p-4 text-left">
          Distance
        </th>


        <th class="p-4 text-left">
          Duration
        </th>


        <th class="p-4 text-left">
          Created
        </th>


        <th class="p-4 text-left">
          Actions
        </th>


      </tr>


    </thead>




    <tbody>


      @foreach($routes as $route)


              <tr class="border-b hover:bg-slate-50">


                <td class="p-4 font-medium text-slate-800">

                  {{ $route->origin }}

                </td>



                <td class="p-4 text-slate-500">

                  {{ $route->destination }}

                </td>



                <td class="p-4 text-slate-500">

                  {{ $route->distance ?? '-' }} km

                </td>



                <td class="p-4 text-slate-500">

                  {{ $route->duration ?? '-' }}

                </td>



                <td class="p-4 text-slate-400">

                  {{ $route->created_at->format('M d, Y') }}

                </td>




                <td class="p-4">


                  <div class="flex gap-2">



                    <button class="
        editRouteBtn
        px-3
        py-1.5
        rounded-lg
        bg-blue-50
        text-blue-600
        " data-id="{{ $route->id }}" data-origin="{{ $route->origin }}" data-destination="{{ $route->destination }}"
                      data-distance="{{ $route->distance }}" data-duration="{{ $route->duration }}">

                      Edit

                    </button>




                    <button class="
        deleteRouteBtn
        px-3
        py-1.5
        rounded-lg
        bg-red-50
        text-red-600
        " data-id="{{ $route->id }}" data-name="{{ $route->origin }} → {{ $route->destination }}">

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

  {{ $routes->links() }}

</div>