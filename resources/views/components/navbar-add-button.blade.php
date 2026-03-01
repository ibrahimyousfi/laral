@props(['url', 'label' => 'Add'])

<x-button href="{{ $url }}" variant="primary" size="sm" icon-only aria-label="{{ $label }}">
    <x-slot:icon><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg></x-slot:icon>
</x-button>
