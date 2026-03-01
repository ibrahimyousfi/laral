{{--
  Card body: reusable content for card-row. Supports:
  - image: optional image URL (shown at start, 10x10 rounded)
  - title: first line (bold)
  - subtitle: second line (muted, can be multiple items)
  - leading slot: custom content at start (icon/avatar) instead of image
  - badges slot: small badges row (use <x-badge>)
  - default slot: custom content (when no title/subtitle), or extra content below them
--}}
@props([
    'title' => null,
    'subtitle' => null,
    'image' => null,
])

@php
    $hasLeading = $image || isset($leading);
    $hasStructured = filled($title) || filled($subtitle);
@endphp

<div class="flex items-start gap-3 min-w-0 flex-1">
    @if($hasLeading)
        <div class="shrink-0 mt-0.5">
            @if(isset($leading))
                {{ $leading }}
            @elseif($image)
                <img src="{{ $image }}" alt="" class="w-10 h-10 rounded-lg object-cover bg-gray-100" />
            @endif
        </div>
    @endif

    <div class="min-w-0 flex-1 space-y-1">
        @if(isset($slot) && trim($slot) && !$hasStructured)
            {{ $slot }}
        @else
            @if(filled($title))
                <div class="font-medium text-gray-900 truncate">
                    {{ $title }}
                </div>
            @endif
            @if(filled($subtitle))
                <div class="text-sm text-gray-500 flex flex-wrap items-center gap-x-3 gap-y-0.5">
                    {{ $subtitle }}
                </div>
            @endif
            @if(isset($badges) && trim($badges))
                <div class="flex flex-wrap gap-1.5 pt-0.5">
                    {{ $badges }}
                </div>
            @endif
            @if(isset($slot) && trim($slot) && $hasStructured)
                <div class="pt-0.5">
                    {{ $slot }}
                </div>
            @endif
        @endif
    </div>
</div>
