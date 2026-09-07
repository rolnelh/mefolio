<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administration · {{ config('app.name', 'Mefolio') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-syne antialiased bg-gray-50">
    @php
        $adminNav = [
            ['route' => 'admin.dashboard', 'label' => 'Tableau de bord', 'icon' => 'home'],
            ['route' => 'admin.users.index', 'label' => 'Utilisateurs', 'icon' => 'users'],
            ['route' => 'admin.creatifs.index', 'label' => 'Créatifs', 'icon' => 'sparkles'],
            ['route' => 'admin.projects.index', 'label' => 'Projets', 'icon' => 'folder'],
            ['route' => 'admin.comments.index', 'label' => 'Commentaires', 'icon' => 'chat'],
            ['route' => 'admin.posts.index', 'label' => 'Blog', 'icon' => 'document'],
            ['route' => 'admin.missions.index', 'label' => 'Missions', 'icon' => 'briefcase'],
            ['route' => 'admin.challenges.index', 'label' => 'Challenges', 'icon' => 'bolt'],
            ['route' => 'admin.programs.index', 'label' => 'Programmes', 'icon' => 'academic'],
            ['route' => 'admin.spotlights.index', 'label' => 'Talent de la semaine', 'icon' => 'star'],
            ['route' => 'admin.nominations.index', 'label' => 'Nominations', 'icon' => 'flag'],
            ['route' => 'admin.newsletter.index', 'label' => 'Newsletter', 'icon' => 'mail'],
        ];

        $icons = [
            'home' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
            'users' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
            'sparkles' => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z',
            'folder' => 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-19.5 0v6a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25v-6m-19.5 0h19.5M4.5 9.75V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M19.5 9.75V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M8.25 3.75h7.5',
            'chat' => 'M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 0h13.5m-13.5 0h1.5m-1.5 0a2.25 2.25 0 01-2.25-2.25V6.75a2.25 2.25 0 012.25-2.25h13.5a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-2.25l-3.75 3.75-3.75-3.75H4.5',
            'document' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6 12l-1.5 1.5m1.5-1.5l1.5 1.5m-6-1.5l-1.5 1.5m0 0l-1.5-1.5m1.5 1.5V9',
            'briefcase' => 'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653m16.5 0a2.183 2.183 0 01-.75.13H4.5a2.193 2.193 0 01-.75-.13m16.5 0v-.494c0-.617-.336-1.191-.883-1.487l-6.75-3.657a2.25 2.25 0 00-2.117 0l-6.75 3.657a1.687 1.687 0 00-.883 1.487v.494',
            'bolt' => 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z',
            'academic' => 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347M12 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0a50.717 50.717 0 00-2.658-.814 59.906 59.906 0 0110.399-5.84',
            'star' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z',
            'flag' => 'M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5',
            'mail' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75',
        ];
    @endphp

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="hidden lg:flex lg:flex-col w-64 bg-[#050810] text-white flex-shrink-0">
            <div class="px-6 py-6 border-b border-white/10">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <x-application-logo class="h-7 w-auto fill-current text-indigo-400" />
                    <span class="font-black tracking-tight">Mefolio</span>
                </a>
                <p class="text-[10px] uppercase tracking-[0.2em] text-indigo-400 font-bold mt-1">Administration</p>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                @foreach ($adminNav as $item)
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs(str_replace('.index', '', $item['route']) . '*') || request()->routeIs($item['route']) ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons[$item['icon']] }}" />
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="p-3 border-t border-white/10">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Retour au site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-red-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        {{-- Contenu --}}
        <div class="flex-1 min-w-0">
            {{-- Barre mobile --}}
            <div class="lg:hidden bg-[#050810] text-white px-4 py-3 flex items-center justify-between" x-data="{ open: false }">
                <a href="{{ route('admin.dashboard') }}" class="font-black text-sm tracking-tight">Mefolio · Admin</a>
                <button @click="open = !open" class="p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="absolute top-12 left-0 right-0 bg-[#050810] border-t border-white/10 px-3 py-3 space-y-1 z-50">
                    @foreach ($adminNav as $item)
                        <a href="{{ route($item['route']) }}" class="block px-3 py-2 rounded-lg text-sm text-gray-200 hover:bg-white/10">{{ $item['label'] }}</a>
                    @endforeach
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-400 hover:bg-white/10">Retour au site</a>
                </div>
            </div>

            @if (isset($header))
                <header class="bg-white border-b border-gray-100">
                    <div class="px-4 sm:px-8 py-6">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <x-flash />

            <main class="p-4 sm:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
