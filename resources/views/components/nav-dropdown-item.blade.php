@props(['href', 'icon', 'title', 'description' => null, 'color' => 'indigo', 'badge' => null, 'muted' => false])

@php
    $colors = [
        'indigo' => 'bg-indigo-50 text-indigo-600',
        'violet' => 'bg-violet-50 text-violet-600',
        'amber' => 'bg-amber-50 text-amber-600',
        'green' => 'bg-green-50 text-green-600',
        'blue' => 'bg-blue-50 text-blue-600',
        'pink' => 'bg-pink-50 text-pink-600',
        'gray' => 'bg-gray-100 text-gray-500',
    ];
@endphp

<a href="{{ $href }}"
    {{ $attributes->class(['flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors group', 'opacity-60' => $muted]) }}>
    <span class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center {{ $colors[$color] ?? $colors['indigo'] }}">
        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
        </svg>
    </span>
    <span class="min-w-0">
        <span class="flex items-center gap-1.5">
            <span class="text-sm font-semibold text-gray-900 group-hover:text-gray-950">{{ $title }}</span>
            @if ($badge)
                <span class="text-[10px] bg-amber-100 text-amber-600 font-bold px-1.5 py-0.5 rounded-full">{{ $badge }}</span>
            @endif
        </span>
        @if ($description)
            <span class="block text-xs text-gray-400 mt-0.5">{{ $description }}</span>
        @endif
    </span>
</a>
