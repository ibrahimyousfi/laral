{{-- Sidebar: on mobile = drawer overlay; on md+ = collapsible --}}
<aside
    id="sidebar"
    class="fixed top-0 left-0 z-50 h-screen flex flex-col bg-white border-r border-gray-200 transition-all duration-300 ease-in-out w-64 -translate-x-full md:translate-x-0 md:w-16"
    :class="sidebarOpen ? 'translate-x-0 md:w-56' : ''"
    @mouseenter="sidebarHover = true"
    @mouseleave="sidebarHover = false"
>
    @php
        $appName = $appSettings['app_name'] ?? config('app.name');
        $iconPath = $appSettings['icon_path'] ?? null;
        $logoPath = $appSettings['logo_path'] ?? null;
        $iconUrl = $iconPath ? \Illuminate\Support\Facades\Storage::url($iconPath) : null;
        $logoUrl = $logoPath ? \Illuminate\Support\Facades\Storage::url($logoPath) : null;
    @endphp
    <div class="flex items-center gap-3 h-14 px-3 border-b border-gray-200 shrink-0 min-w-0">
        <button
            type="button"
            class="shrink-0 w-10 h-10 md:w-9 md:h-9 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors relative touch-manipulation"
            @click.stop="sidebarOpen = !sidebarOpen"
            :aria-label="sidebarOpen ? 'Close sidebar' : 'Open sidebar'"
        >
            {{-- 1) Normal: app icon --}}
            <svg x-show="!sidebarHover" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            {{-- 2) Hover + open: close (collapse) --}}
            <svg x-show="sidebarHover && sidebarOpen" class="w-5 h-5 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
            {{-- 3) Hover + closed: open (expand) --}}
            <svg x-show="sidebarHover && !sidebarOpen" class="w-5 h-5 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </button>
        <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 overflow-hidden min-w-0 flex-1">
            @if($logoUrl)
                <img src="{{ asset($logoUrl) }}" alt="{{ $appName }}" class="h-6 max-w-[120px] object-contain object-left" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'" />
            @else
                <span class="whitespace-nowrap truncate font-semibold" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'">
                    {{ $appName }}
                </span>
            @endif
        </a>
    </div>
    <nav class="flex-1 overflow-y-auto py-3 px-2 -webkit-overflow-scrolling-touch">
        <ul class="space-y-0.5">
            <li>
                <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 px-3 py-3 md:py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors touch-manipulation active:bg-gray-100" @click="sidebarOpen = false">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    <span class="truncate" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'">App</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <span class="truncate" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'">Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.expenses.index') }}" class="flex items-center gap-3 px-3 py-3 md:py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors touch-manipulation active:bg-gray-100" @click="sidebarOpen = false">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="truncate" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'">Expenses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <span class="truncate" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'">Settings</span>
                </a>
            </li>
            <li class="mt-auto pt-3 border-t border-gray-200">
                <form action="{{ route('logout') }}" method="post" class="block">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 px-3 py-3 md:py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors text-left touch-manipulation">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        <span class="truncate" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 w-0 overflow-hidden'">{{ __('Logout') }}</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
