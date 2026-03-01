@props(['paginator'])

@if($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex flex-wrap items-center justify-center gap-2 mt-6">
        {{-- Previous --}}
        @if($paginator->onFirstPage())
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm" aria-label="Previous">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
        @endif

        {{-- Page numbers --}}
        <div class="flex items-center gap-1">
            @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if($page == $paginator->currentPage())
                    <span class="inline-flex items-center justify-center min-w-[2.25rem] h-9 px-2 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-medium" aria-current="page">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="inline-flex items-center justify-center min-w-[2.25rem] h-9 px-2 rounded-full border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">{{ $page }}</a>
                @endif
            @endforeach
        </div>

        {{-- Next --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm" aria-label="Next">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        @else
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-gray-200 dark:border-gray-600 text-gray-400 dark:text-gray-500 cursor-not-allowed text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </span>
        @endif
    </nav>
    <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-2">
        {{ __('Showing') }} {{ $paginator->firstItem() ?? 0 }} {{ __('to') }} {{ $paginator->lastItem() ?? 0 }} {{ __('of') }} {{ $paginator->total() }} {{ __('results') }}
    </p>
@endif
