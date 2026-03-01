{{-- Navbar: page title, center search + filter, right add button --}}
<header class="sticky top-0 z-30 h-14 px-4 flex items-center justify-between gap-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <h1 class="text-lg font-semibold truncate shrink-0">
        {{ $pageTitle ?? 'Dashboard' }}
    </h1>
    <div class="flex-1 flex items-center justify-center max-w-xl mx-4 gap-2">
        @hasSection('navbar-search')
            @yield('navbar-search')
        @else
            <div class="w-full flex items-center gap-2 bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-2">
                <svg class="w-4 h-4 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="search" placeholder="{{ $searchPlaceholder ?? 'Search...' }}" class="flex-1 bg-transparent border-0 outline-none text-sm placeholder-gray-500"
                    @if(isset($searchName)) name="{{ $searchName }}" @endif
                    @if(isset($searchValue)) value="{{ $searchValue }}" @endif
                >
            </div>
            <button type="button" class="shrink-0 w-9 h-9 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" aria-label="Filter">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
            </button>
        @endif
    </div>
    <div class="shrink-0">
        @hasSection('navbar-add-button')
            @yield('navbar-add-button')
        @elseif(isset($addUrl))
            <a href="{{ $addUrl }}" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors relative overflow-hidden before:absolute before:inset-0 before:rounded-full before:scale-0 hover:before:scale-100 before:opacity-0 hover:before:opacity-100 before:bg-black/10 before:transition-all before:duration-200" aria-label="Add">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            </a>
        @endif
    </div>
</header>
