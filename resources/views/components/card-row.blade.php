@props(['href' => null])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => 'block w-full bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 hover:border-gray-300 dark:hover:border-gray-600 transition-colors']) }}
>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex-1 min-w-0">
            {{ $slot }}
        </div>
        @if(isset($actions))
            <div class="flex items-center gap-2 shrink-0 flex-wrap">
                {{ $actions }}
            </div>
        @endif
    </div>
</{{ $tag }}>
