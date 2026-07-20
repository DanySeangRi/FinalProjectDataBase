@props(['active' => null])

@php
    $active = $active ?? request()->route()->getName();
@endphp

@php
    // Inline SVG icons (stroke-based, 18x18) so the component has zero JS dependencies.
    $icons = [
        'dashboard' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>',
        'users' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'routes' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="19" r="3"/><circle cx="18" cy="5" r="3"/><path d="M9 19h8.5a3.5 3.5 0 0 0 0-7h-11a3.5 3.5 0 0 1 0-7H15"/></svg>',
        'schedules' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6"/><path d="M16 2v4M8 2v4M3 10h18"/><circle cx="18" cy="18" r="4"/><path d="M18 16.5V18l1 1"/></svg>',
        'vehicles' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6v6M15 6v6M2 12h19.6M18 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62L18.5 8.6A1 1 0 0 0 17.7 8H4a2 2 0 0 0-2 2v7a1 1 0 0 0 1 1h2"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg>',
        'bookings' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
        'settings' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>',
        'logout' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>',
        'logo' => '<img src="' . asset('image/image.png') . '" 
                        alt="Logo" 
                        class="w-10 h-10 object-contain">',
    ];

    $overview = [
        ['key' => 'dashboard', 'label' => 'Dashboard', 'route' => 'admin.dashboard.index'],
    ];

    $management = [
        ['key' => 'users', 'label' => 'Users', 'route' => 'admin.users'],
        ['key' => 'routes', 'label' => 'Routes', 'route' => 'admin.routes'],
        ['key' => 'schedules', 'label' => 'Schedules', 'route' => 'admin.schedules'],
        ['key' => 'vehicles', 'label' => 'Vehicles', 'route' => 'admin.vehicles'],
        ['key' => 'bookings', 'label' => 'Bookings', 'route' => 'admin.bookings'],
    ];

    $account = [
        ['key' => 'settings', 'label' => 'settings', 'route' => 'admin.settings'],
    ];

    // Helper closure to render one nav link.
  $navLink = function ($item) use ($icons, $active) {

    $isActive = request()->routeIs($item['route']);

    $href = \Illuminate\Support\Facades\Route::has($item['route'])
        ? route($item['route'])
        : '#';

    $classes = $isActive
        ? 'bg-[#86C5FF] text-black shadow-sm'
        : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900';

    return '<a href="' . $href . '" 
        class="w-full flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors ' . $classes . '">'
        . $icons[$item['key']]
        . '<span>' . $item['label'] . '</span>'
        . '</a>';
};
@endphp

<aside class="w-64 h-full bg-white border-r border-slate-200 flex flex-col shrink-0">

    {{-- Logo / brand --}}
    <div class="flex items-center gap-3 px-5 py-6 border-b border-slate-100">
        <div class="w-10 h-10 flex items-center justify-center"> {!! $icons['logo'] !!} </div>
        <div class="leading-tight">
            <p class="text-sm font-bold text-slate-900"> Angkor  <span class="text-orange-500">Travel</span> </p>
            <p class="text-xs text-slate-400">Admin Portal</p>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4">

        <p class="px-3 mb-2 text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Overview</p>
        <div class="space-y-1">
            @foreach ($overview as $item)
                {!! $navLink($item) !!}
            @endforeach
        </div>

        <p class="px-3 mb-2 mt-6 text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Management</p>
        <div class="space-y-1">
            @foreach ($management as $item)
                {!! $navLink($item) !!}
            @endforeach
        </div>

        <p class="px-3 mb-2 mt-6 text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Account</p>
        <div class="space-y-1">
            @foreach ($account as $item)
                {!! $navLink($item) !!}
            @endforeach
        </div>

    </nav>

    {{-- Footer / user --}}
    <div class="border-t border-slate-100 px-4 py-4 flex items-center gap-3">
        <div
            class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 font-semibold text-xs flex items-center justify-center">
            {{ auth()->user()->initials ?? 'AD' }}
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-slate-800 truncate">
                {{ auth()->user()->name ?? 'Admin User' }}
            </p>
            <p class="text-xs text-slate-400 truncate">
                {{ auth()->user()->email ?? 'admin@busgo.com' }}
            </p>
        </div>
        <form method="POST" action="{{ Route::has('logout') ? route('logout') : '#' }}">
            @csrf
            <button type="submit" class="text-slate-400 hover:text-slate-600 transition-colors" aria-label="Log out">
                {!! $icons['logout'] !!}
            </button>
        </form>
    </div>

</aside>