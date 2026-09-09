{{--
    Cloche de notifications desktop (visible uniquement connecté — inclus
    depuis le bloc @auth de navigation.blade.php). Aucune variable externe
    requise : interroge Auth::user() directement.
--}}
@php
    $navNotifications = Auth::user()->notifications()->latest()->take(8)->get();
    $navUnreadCount = Auth::user()->unreadNotifications()->count();
    $navNotifIcons = [
        'project' => 'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653',
        'project_updated' => 'M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10',
        'project_deleted' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
        'like' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
        'profile' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z',
        'message' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75',
    ];
@endphp
<div class="relative" x-data="{ openNotify: false }">
    <button @click="openNotify = !openNotify"
        class="p-2 text-gray-500 hover:text-indigo-600 transition-colors relative">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>
        @if ($navUnreadCount > 0)
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
        @endif
    </button>
    <div x-show="openNotify" @click.outside="openNotify = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden">
        <div class="flex items-center justify-between px-4 py-2.5 border-b border-gray-100">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Notifications') }}</h3>
            @if ($navUnreadCount > 0)
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf
                    <button type="submit" class="text-[11px] font-semibold text-indigo-600 hover:underline">
                        {{ __('Tout marquer comme lu') }}
                    </button>
                </form>
            @endif
        </div>
        <div class="max-h-96 overflow-y-auto">
            @forelse ($navNotifications as $notification)
                <a href="{{ $notification->data['url'] ?? '#' }}"
                    class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0 {{ is_null($notification->read_at) ? 'bg-indigo-50/40' : '' }}">
                    <span class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="{{ $navNotifIcons[$notification->data['icon'] ?? 'project'] ?? $navNotifIcons['project'] }}" />
                        </svg>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="block text-xs font-bold text-gray-900">{{ $notification->data['title'] ?? '' }}</span>
                        <span class="block text-xs text-gray-500 mt-0.5 line-clamp-2">{{ $notification->data['message'] ?? '' }}</span>
                        <span class="block text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</span>
                    </span>
                    @if (is_null($notification->read_at))
                        <span class="w-1.5 h-1.5 bg-indigo-600 rounded-full flex-shrink-0 mt-1.5"></span>
                    @endif
                </a>
            @empty
                <div class="px-4 py-8 text-center text-sm text-gray-400">
                    {{ __('Aucune notification pour le moment.') }}
                </div>
            @endforelse
        </div>
    </div>
</div>
