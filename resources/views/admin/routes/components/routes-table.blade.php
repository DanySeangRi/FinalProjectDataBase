<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">


  <table class="w-full text-sm">


    <thead>


      <tr class="border-b   bg-slate-50">
        <th class="p-4  text-left">
          ROUTE
        </th>


        <th class="p-4 text-left">
          FROM
        </th>


        <th class="p-4 text-left">
          TO
        </th>


        <th class="p-4 text-left">
          DISTANCE
        </th>


        <th class="p-4 text-left">
          DURATION
        </th>


        <th class="p-4 text-left">
          STATUS
        </th>


        <th class="p-4 text-left">
          ACTIONS
        </th>


      </tr>


    </thead>




    <tbody>


      @foreach($routes as $route)


        <tr class="border-b  hover:bg-slate-50 text-[13px]">

          <td class="p-2 flex items-center mt-3 font-bold text-slate-800">
          <div class="bg-green-100 text-green-700 mr-3 p-1 rounded-2xl ">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-route-icon   lucide-route">
              <circle cx="6" cy="19" r="3" />
              <path d="M9 19h8.5a3.5 3.5 0 0 0 0-7h-11a3.5 3.5 0 0 1 0-7H15" />
              <circle cx="18" cy="5" r="3" />
            </svg>


          </div>
        

            <p> {{ $route->origin }} </p>
            <div class="flex justify-center items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-move-right-icon mx-1  lucide-move-right">
                <path d="M18 8L22 12L18 16" />
                <path d="M2 12H22" />
              </svg>

            </div>

            <p>
              {{ $route->destination }}
            </p>

          </td>


          <td class="p-4  text-slate-800">

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



          <td class="p-4">

            @if($route->status === 'active')

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



              <button class="
                    editRouteBtn
                    px-3
                    py-1.5
                    rounded-lg
                    bg-blue-50
                    text-blue-600
                    " data-id="{{ $route->id }}" data-origin="{{ $route->origin }}"
                data-destination="{{ $route->destination }}" data-distance="{{ $route->distance }}"
                data-duration="{{ $route->duration }}">

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