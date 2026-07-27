<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
  <table class="w-full text-sm">
    <thead>
      <tr class="border-b bg-slate-50 text-slate-600 font-semibold text-xs uppercase">
        <th class="p-4 text-left">Route</th>
        <th class="p-4 text-left">From</th>
        <th class="p-4 text-left">To</th>
        <th class="p-4 text-left">Distance</th>
        <th class="p-4 text-left">Status</th>
        <th class="p-4 text-right">Actions</th>
      </tr>
    </thead>

    <tbody class="divide-y divide-slate-100">
      @forelse($routes as $route)
        <tr class="hover:bg-slate-50 transition">
          
          <!-- Route -->
          <td class="p-4 font-semibold text-slate-900">
            {{ $route->origin }} → {{ $route->destination }}
          </td>

          <!-- From -->
          <td class="p-4 text-slate-600">
            {{ $route->origin }}
          </td>

          <!-- To -->
          <td class="p-4 text-slate-600">
            {{ $route->destination }}
          </td>

          <!-- Distance -->
          <td class="p-4 text-slate-600">
            {{ $route->distance }} km
          </td>

          <!-- Status -->
          <td class="p-4">
            @if($route->status === 'active')
              <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                Active
              </span>
            @else
              <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                Inactive
              </span>
            @endif
          </td>

          <!-- Actions -->
          <td class="p-4 text-right">
            <div class="flex items-center justify-end gap-2">
              
              <!-- Edit Button -->
              <button 
                type="button"
                class="editRouteBtn p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition"
                data-id="{{ $route->id }}"
                data-origin="{{ $route->origin }}"
                data-destination="{{ $route->destination }}"
                data-distance="{{ $route->distance }}"
                data-status="{{ $route->status }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 20h9"/>
                  <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                </svg>
              </button>

              <!-- Delete Button -->
              <button 
                type="button"
                class="deleteRouteBtn p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition"
                data-id="{{ $route->id }}"
                data-name="{{ $route->origin }} → {{ $route->destination }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 6h18"/>
                  <path d="M8 6V4h8v2"/>
                  <path d="M19 6l-1 14H6L5 6"/>
                  <path d="M10 11v6"/>
                  <path d="M14 11v6"/>
                </svg>
              </button>

            </div>
          </td>

        </tr>
      @empty
        <tr>
          <td colspan="6" class="p-8 text-center text-slate-500">
            No routes found.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>