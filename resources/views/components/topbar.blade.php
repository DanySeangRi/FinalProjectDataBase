<div class="flex justify-end gap-4 px-8 py-4 border-b border-slate-200 bg-white shrink-0">



    <div class="flex items-center gap-4">
        <button class="relative text-slate-400 hover:text-slate-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
            </svg>
            <span class="absolute -top-0.5 -right-0.5 w-2 h-2 rounded-full bg-orange-500"></span>
        </button>

        <button class="flex items-center gap-2 pl-2">
            <div
                class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-semibold text-xs flex items-center justify-center">
                {{ auth()->user()->initials ?? 'AD' }}
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-slate-400">
                <polyline points="6 9 12 15 18 9" />
            </svg> 
        </button>
    </div>

</div>