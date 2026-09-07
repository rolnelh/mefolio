@props(['href', 'icon' => null, 'title', 'description' => null, 'color' => 'indigo', 'badge' => null, 'muted' => false])

<a href="{{ $href }}"
    {{ $attributes->class(['flex items-start px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors group', 'opacity-60' => $muted]) }}>
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
