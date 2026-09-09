@props(['active' => 'projets'])

@php
    $creatif = Auth::user()->creatif;
    $projectsCount = $creatif ? $creatif->projects()->count() : 0;
    $unreadMessages = \App\Models\Message::where('recipient_id', Auth::id())->whereNull('read_at')->count();
    $profilComplet =
        $creatif &&
        $creatif->nom &&
        $creatif->prenom &&
        $creatif->specialite &&
        $creatif->localisation &&
        $creatif->bio &&
        $creatif->portfolio_url &&
        $creatif->photo;

    $iconPortfolio = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />';
    $iconMissions = '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653" />';
    $iconMessages = '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />';
    $iconProductivite = '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />';
    $iconStats = '<path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />';
    $iconAssistant = '<path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />';
    $iconClassement = '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />';
    $iconServices = '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />';
    $iconPaiements = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />';
    $iconProfil = '<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />';
    $iconParametres = '<path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';

    $menuItems = [
        ['key' => 'projets', 'label' => 'Portfolio', 'href' => route('dashboard', ['tab' => 'projets']), 'count' => $projectsCount, 'icon' => $iconPortfolio],
        ['key' => 'missions', 'label' => 'Mes missions', 'href' => route('dashboard', ['tab' => 'missions']), 'count' => null, 'icon' => $iconMissions],
        ['key' => null, 'href' => route('messages.index'), 'label' => 'Messages', 'count' => $unreadMessages ?: null, 'icon' => $iconMessages, 'routeIs' => 'messages.*'],
    ];

    $insightItems = [
        ['key' => 'productivite', 'label' => 'Productivité', 'href' => route('dashboard', ['tab' => 'productivite']), 'count' => null, 'icon' => $iconProductivite],
        ['key' => 'stats', 'label' => 'Analytics', 'href' => route('dashboard', ['tab' => 'stats']), 'count' => null, 'icon' => $iconStats],
        ['key' => 'assistant', 'label' => 'Assistant IA', 'href' => route('dashboard', ['tab' => 'assistant']), 'count' => null, 'icon' => $iconAssistant],
        ['key' => null, 'href' => route('classement.index'), 'label' => 'Classement', 'count' => null, 'icon' => $iconClassement, 'routeIs' => 'classement.*'],
    ];

    $otherItems = [
        ['key' => 'services', 'label' => 'Services', 'href' => route('dashboard', ['tab' => 'services']), 'count' => null, 'icon' => $iconServices],
        ['key' => 'paiements', 'label' => 'Paiements', 'href' => route('dashboard', ['tab' => 'paiements']), 'count' => null, 'icon' => $iconPaiements],
        ['key' => 'profil', 'label' => 'Mon profil', 'href' => route('dashboard', ['tab' => 'profil']), 'count' => null, 'icon' => $iconProfil],
        ['key' => 'parametres', 'label' => 'Paramètres', 'href' => route('dashboard', ['tab' => 'parametres']), 'count' => null, 'icon' => $iconParametres],
    ];

    $allItems = [...$menuItems, ...$insightItems, ...$otherItems];

    $isItemActive = function (array $item) use ($active) {
        return $item['key'] !== null ? $active === $item['key'] : request()->routeIs($item['routeIs']);
    };
@endphp

<div x-data="{ open: false }" @keydown.escape.window="open = false" class="relative flex-shrink-0">

    {{-- Rail : icônes seules, toujours visible --}}
    <div class="w-16 bg-[#15171c] rounded-2xl p-2.5 shadow-xl shadow-gray-900/10 flex flex-col items-center gap-1">
        <div class="mb-1 pb-2.5 border-b border-white/5 w-full flex justify-center">
            <x-application-logo class="h-6 w-auto text-white" />
        </div>

        <button type="button" @click="open = true" title="Ouvrir le menu"
            class="w-11 h-11 flex items-center justify-center rounded-xl text-white/40 hover:bg-white/5 hover:text-white/80 transition-all mb-1">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
        </button>

        @foreach ($allItems as $item)
            <a href="{{ $item['href'] }}" title="{{ $item['label'] }}"
                class="relative w-11 h-11 flex items-center justify-center rounded-xl transition-all
                    {{ $isItemActive($item) ? 'bg-white/10' : 'hover:bg-white/5' }}">
                <svg class="w-[18px] h-[18px] {{ $isItemActive($item) ? 'text-indigo-400' : 'text-white/40' }}"
                    fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    {!! $item['icon'] !!}
                </svg>
                @if ($item['count'])
                    <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-indigo-400 rounded-full"></span>
                @endif
            </a>
        @endforeach

        <button type="button" @click="open = true" title="{{ $creatif?->prenom ?? Auth::user()->username }}"
            class="mt-1 pt-2.5 border-t border-white/5 w-full flex justify-center">
            @if ($creatif?->photo)
                <img src="{{ $creatif->photo }}" class="w-9 h-9 rounded-full object-cover">
            @else
                <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                    {{ strtoupper(substr($creatif?->prenom ?? Auth::user()->username, 0, 1)) }}
                </div>
            @endif
        </button>
    </div>

    {{-- Fond semi-transparent quand le menu est ouvert --}}
    <div x-show="open" x-cloak x-transition.opacity @click="open = false"
        class="fixed inset-0 z-40 bg-gray-900/30"></div>

    {{-- Menu déplié : profil, sections groupées, footer compte --}}
    <div x-show="open" x-cloak @click.outside="open = false"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 -translate-x-2"
        class="absolute top-0 left-0 z-50 w-72 max-h-[85vh] bg-[#15171c] rounded-2xl shadow-2xl shadow-gray-900/30 flex flex-col">

        {{-- Profil --}}
        <div class="flex items-center gap-3 p-4 border-b border-white/5 flex-shrink-0">
            @if ($creatif?->photo)
                <img src="{{ $creatif->photo }}" class="w-10 h-10 rounded-full object-cover flex-shrink-0">
            @else
                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-black flex-shrink-0">
                    {{ strtoupper(substr($creatif?->prenom ?? Auth::user()->username, 0, 1)) }}
                </div>
            @endif
            <div class="min-w-0 flex-1">
                <p class="text-white text-sm font-bold truncate">{{ $creatif?->prenom ? trim($creatif->prenom . ' ' . $creatif->nom) : Auth::user()->username }}</p>
                <p class="text-[11px] font-semibold {{ $creatif?->available_for_work ? 'text-green-400' : 'text-white/30' }}">
                    {{ $creatif?->available_for_work ? 'Disponible pour missions' : 'Indisponible' }}
                </p>
            </div>
            @if ($creatif?->slug)
                <a href="{{ route('creatifs.show', $creatif->slug) }}" title="Voir mon profil public"
                    class="text-white/30 hover:text-white p-1.5 rounded-lg hover:bg-white/5 transition-all flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </a>
            @endif
            <button type="button" @click="open = false" title="Fermer le menu"
                class="text-white/40 hover:text-white p-1.5 rounded-lg hover:bg-white/5 transition-all flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto p-3 space-y-4">
            @foreach (['Menu' => $menuItems, 'Insights' => $insightItems, 'Autres' => $otherItems] as $sectionLabel => $items)
                <div>
                    <p class="px-3 mb-1 text-[10px] font-bold text-white/25 uppercase tracking-wider">{{ $sectionLabel }}</p>
                    <div class="space-y-0.5">
                        @foreach ($items as $item)
                            <a href="{{ $item['href'] }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all
                                    {{ $isItemActive($item) ? 'bg-white/10 text-white' : 'text-white/50 hover:bg-white/5 hover:text-white/80' }}">
                                <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isItemActive($item) ? 'text-indigo-400' : 'text-white/40' }}"
                                    fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    {!! $item['icon'] !!}
                                </svg>
                                <span class="text-sm font-semibold flex-1 truncate">{{ $item['label'] }}</span>
                                @if ($item['count'])
                                    <span
                                        class="text-[11px] font-bold px-2 py-0.5 rounded-full
                                            {{ $isItemActive($item) ? 'bg-white/15 text-white' : 'bg-white/5 text-white/40' }}">
                                        {{ $item['count'] }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </nav>

        {{-- Action rapide --}}
        <div class="px-3 pb-3 flex-shrink-0">
            <a href="{{ $profilComplet ? route('projets.create') : route('dashboard', ['tab' => 'profil']) }}"
                class="flex items-center justify-center gap-2 w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Créer un projet
            </a>
        </div>

        {{-- Compte --}}
        <div class="flex items-center gap-3 p-4 border-t border-white/5 flex-shrink-0">
            @if ($creatif?->photo)
                <img src="{{ $creatif->photo }}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
            @else
                <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[11px] font-black flex-shrink-0">
                    {{ strtoupper(substr($creatif?->prenom ?? Auth::user()->username, 0, 1)) }}
                </div>
            @endif
            <div class="min-w-0 flex-1">
                <p class="text-white text-xs font-bold truncate">{{ $creatif?->prenom ? trim($creatif->prenom . ' ' . $creatif->nom) : Auth::user()->username }}</p>
                <p class="text-white/30 text-[10px] truncate">{{ Auth::user()->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                @csrf
                <button type="submit" title="Déconnexion"
                    class="text-white/30 hover:text-red-400 p-1.5 rounded-lg hover:bg-white/5 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
