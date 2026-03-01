@props([
    'tag' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'iconOnly' => false,
])

@php
    $tag = $href ? 'a' : $tag;
    $base = 'inline-flex items-center justify-center gap-2 font-medium rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none relative overflow-hidden';
    $hoverCircle = 'hover:before:scale-100 hover:before:opacity-100 before:absolute before:inset-0 before:rounded-full before:scale-0 before:opacity-0 before:transition-all before:duration-200 before:bg-black/10 dark:before:bg-white/10';
    $variants = [
        'primary' => 'bg-gray-900 dark:bg-white text-white dark:text-gray-900 focus:ring-gray-500 ' . $hoverCircle,
        'secondary' => 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700 focus:ring-gray-400 ' . $hoverCircle,
        'ghost' => 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:ring-gray-400 ' . $hoverCircle,
        'danger' => 'bg-red-600 dark:bg-red-500 text-white focus:ring-red-500 ' . $hoverCircle,
    ];
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm min-w-[2rem]',
        'md' => 'px-4 py-2 text-sm min-w-[2.5rem]',
        'lg' => 'px-5 py-2.5 text-base min-w-[3rem]',
    ];
    $iconOnlyClasses = '!p-0 w-9 h-9 !min-w-0 border border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500';
    $iconSize = ['sm' => 'w-4 h-4', 'md' => 'w-4 h-4', 'lg' => 'w-5 h-5'];
    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
    if ($iconOnly) {
        $classes .= ' ' . $iconOnlyClasses;
    }
@endphp

<{{ $tag }}
    @if($tag === 'a') href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if(isset($icon))
        <span class="{{ $iconSize[$size] ?? 'w-4 h-4' }} shrink-0 flex items-center justify-center [&>svg]:w-full [&>svg]:h-full" aria-hidden="true">{{ $icon }}</span>
    @endif
    @if(isset($slot) && trim($slot))
        <span>{{ $slot }}</span>
    @endif
</{{ $tag }}>
