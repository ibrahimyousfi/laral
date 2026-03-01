@props([
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-gray-100 text-gray-700 border border-gray-200',
        'success' => 'bg-green-100 text-green-800 border border-green-200',
        'danger' => 'bg-red-100 text-red-800 border border-red-200',
        'warning' => 'bg-amber-100 text-amber-800 border border-amber-200',
    ];
    $classes = 'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
