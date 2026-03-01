<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>@yield('title', $pageTitle ?? 'App') - App</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
    <style>
        @supports (padding-bottom: env(safe-area-inset-bottom)) {
            body { padding-bottom: env(safe-area-inset-bottom); }
            #sidebar { padding-left: env(safe-area-inset-left); }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-gray-900 antialiased" x-data="{ sidebarOpen: false, sidebarHover: false }">
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 md:hidden" aria-hidden="true"></div>
    @include('layouts.sidebar')

    <div class="min-h-screen transition-all duration-300 ml-0 md:ml-16" :class="sidebarOpen ? 'md:ml-56' : ''">
        <header class="sticky top-0 z-30 h-14 px-3 sm:px-4 flex items-center justify-between gap-2 sm:gap-4 bg-white border-b border-gray-200" x-data="{ showFlash: true }" x-init="setTimeout(() => showFlash = false, 5000)">
            <div class="flex items-center gap-2 sm:gap-3 min-w-0 shrink">
                <button type="button" @click="sidebarOpen = !sidebarOpen" class="md:hidden shrink-0 w-10 h-10 -ml-1 flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100" aria-label="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <h1 class="text-base sm:text-lg font-semibold truncate">{{ $pageTitle ?? 'App' }}</h1>
                @if(session('success'))
                    <span x-show="showFlash" x-transition class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">{{ session('success') }}</span>
                @endif
                @if(session('error'))
                    <span x-show="showFlash" x-transition class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">{{ session('error') }}</span>
                @endif
            </div>
            <div class="flex-1 flex items-center justify-center max-w-xl mx-2 sm:mx-4 gap-1 sm:gap-2 min-w-0">
                @hasSection('navbar-search')
                    @yield('navbar-search')
                @else
                    <div class="w-full max-w-xs sm:max-w-none flex items-center gap-2 bg-gray-100 rounded-full px-2.5 sm:px-3 py-1.5 sm:py-2">
                        <svg class="w-4 h-4 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        <input type="search" placeholder="{{ $searchPlaceholder ?? 'Search...' }}" class="flex-1 min-w-0 bg-transparent border-0 outline-none text-sm placeholder-gray-500" @if(isset($searchName)) name="{{ $searchName }}" @endif @if(isset($searchValue)) value="{{ $searchValue }}" @endif>
                    </div>
                    <button type="button" class="shrink-0 w-9 h-9 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-colors" aria-label="Filter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                    </button>
                @endif
            </div>
            <div class="shrink-0">
                @hasSection('navbar-add-button')
                    @yield('navbar-add-button')
                @elseif(isset($addUrl))
                    <x-button href="{{ $addUrl }}" variant="primary" size="sm" icon-only aria-label="Add">
                        <x-slot:icon><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg></x-slot:icon>
                    </x-button>
                @endif
            </div>
        </header>

        <main class="p-3 sm:p-4 pb-6">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>
