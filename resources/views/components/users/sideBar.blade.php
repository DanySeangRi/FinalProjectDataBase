@props(['active' => null])

@php
    $active = $active ?? request()->route()->getName();

    $icons = [
        'home' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></svg>',

        'search' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>',

        'ticket' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v2a2 2 0 0 0 0 4v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 0 0-4V9z"/><path d="M9 9v6"/><path d="M15 9v6"/></svg>',

        'history' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 3v6h6"/><path d="M12 7v5l3 3"/></svg>',

        'profile' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>',

        'settings' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 7.04 4.3l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06A2 2 0 1 1 19.7 7.04l-.06.06A1.65 1.65 0 0 0 19.4 9c0 .66.39 1.26 1 1.51H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>',

        'logout' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>',

        'logo' => '<img src="' . asset('image/image.png') . '" class="w-10 h-10 object-contain">',
    ];

    $menu = [
    [
        'title' => 'Main',
        'items' => [
            [
                'key'=>'home',
                'label'=>'Dashboard',
                'route'=>'user.dashboard'
            ],

            [
                'key'=>'history',
                'label'=>'My Bookings',
                'route'=>'user.bookings'
            ],
        ]
    ],

    [
        'title' => 'Account',
        'items' => [
            [
                'key'=>'profile',
                'label'=>'My Profile',
                'route'=>'user.profile'
            ],
        ]
    ]
];

    $navLink = function ($item) use ($icons) {

        $active = request()->routeIs($item['route']);

        $class = $active
        ? 'bg-[#86C5FF] text-black shadow-sm'
        : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900';

        return '<a href="'.route($item['route']).'"
            class="flex items-center gap-3 rounded-xl px-3 py-3 transition '.$class.'">
            '.$icons[$item['key']].'
            <span class="font-medium">'.$item['label'].'</span>
        </a>';
    };
@endphp

<aside class="w-64 bg-white border-r border-slate-200 h-screen flex flex-col">

    {{-- Logo --}}
    <div class="flex items-center gap-3 p-6 border-b">
        {!! $icons['logo'] !!}
        <div>
            <h2 class="font-bold text-lg">
                Angkor <span class="text-orange-500">Travel</span>
            </h2>
            <p class="text-xs text-slate-400">
                User Portal
            </p>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto p-4">

        @foreach($menu as $group)

            <p class="text-xs uppercase tracking-wider text-slate-400 font-semibold mb-3">
                {{ $group['title'] }}
            </p>

            <div class="space-y-2 mb-6">
                @foreach($group['items'] as $item)
                    {!! $navLink($item) !!}
                @endforeach
            </div>

        @endforeach

    </nav>

    {{-- User --}}
    <div class="border-t p-4 flex items-center gap-3">

        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-semibold text-blue-600 overflow-hidden shrink-0">
            @if(auth()->user()->profile_image_url)
                <img src="{{ auth()->user()->profile_image_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
            @else
                {{ auth()->user()->initials ?? 'U' }}
            @endif
        </div>

        <div class="flex-1 min-w-0">
            <p class="font-medium truncate">
                {{ auth()->user()->name }}
            </p>

            <p class="text-xs text-slate-500 truncate">
                {{ auth()->user()->email }}
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-slate-500 hover:text-red-500">
                {!! $icons['logout'] !!}
            </button>
        </form>

    </div>

</aside>