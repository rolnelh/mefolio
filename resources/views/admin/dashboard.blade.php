<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Tableau de bord</h1>
        <p class="text-sm text-gray-500 mt-1">Vue d'ensemble de la plateforme Mefolio.</p>
    </x-slot>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        @foreach ([
            ['label' => 'Utilisateurs', 'val' => $stats['users'], 'route' => 'admin.users.index'],
            ['label' => 'Créatifs', 'val' => $stats['creatifs'], 'route' => 'admin.creatifs.index'],
            ['label' => 'Projets', 'val' => $stats['projects'], 'route' => 'admin.projects.index'],
            ['label' => 'Commentaires', 'val' => $stats['comments'], 'route' => 'admin.comments.index'],
            ['label' => 'Articles de blog', 'val' => $stats['posts'], 'route' => 'admin.posts.index'],
            ['label' => 'Missions', 'val' => $stats['missions'], 'route' => 'admin.missions.index'],
            ['label' => 'Challenges', 'val' => $stats['challenges'], 'route' => 'admin.challenges.index'],
            ['label' => 'Abonnés newsletter', 'val' => $stats['newsletter'], 'route' => 'admin.newsletter.index'],
        ] as $card)
            <a href="{{ route($card['route']) }}" class="bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all">
                <p class="text-2xl font-black text-gray-900">{{ number_format($card['val']) }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $card['label'] }}</p>
            </a>
        @endforeach
    </div>

    {{-- Visites --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

        <div class="bg-white border border-gray-100 rounded-2xl p-6 lg:col-span-2">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="font-bold text-gray-900 text-sm">Visites</h2>
                    <p class="text-xs text-gray-400 mt-0.5">14 derniers jours, hors robots connus et espace admin.</p>
                </div>
                <div class="flex gap-5 text-right">
                    <div>
                        <p class="text-lg font-black text-gray-900">{{ number_format($visits['today']) }}</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide">Aujourd'hui</p>
                    </div>
                    <div>
                        <p class="text-lg font-black text-gray-900">{{ number_format($visits['last7Days']) }}</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide">7 jours</p>
                    </div>
                    <div>
                        <p class="text-lg font-black text-gray-900">{{ number_format($visits['last30Days']) }}</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide">30 jours</p>
                    </div>
                </div>
            </div>

            @php
                $maxVisits = max($visits['dailyCounts']->max(), 1);
            @endphp

            @if ($visits['last30Days'] > 0)
                <div class="flex items-end gap-1.5" style="height: 96px;">
                    @foreach ($visits['dailyCounts'] as $day => $count)
                        <div class="group relative flex-1 flex flex-col items-center justify-end h-full">
                            <div
                                class="absolute -top-7 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity whitespace-nowrap bg-gray-900 text-white text-[10px] font-semibold px-2 py-1 rounded-lg z-10">
                                {{ \Illuminate\Support\Carbon::parse($day)->translatedFormat('d M') }} · {{ $count }}
                            </div>
                            <div class="w-full bg-indigo-600 group-hover:bg-indigo-500 rounded-t-[4px] transition-colors"
                                style="height: {{ max(2, round($count / $maxVisits * 96)) }}px;"></div>
                        </div>
                    @endforeach
                </div>
                <div class="flex gap-1.5 mt-2">
                    @foreach ($visits['dailyCounts'] as $day => $count)
                        <span class="flex-1 text-center text-[9px] text-gray-300">{{ \Illuminate\Support\Carbon::parse($day)->format('d') }}</span>
                    @endforeach
                </div>
            @else
                <div class="h-24 flex items-center justify-center text-sm text-gray-400">
                    Aucune visite enregistrée pour le moment.
                </div>
            @endif
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden lg:col-span-1">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm">D'où viennent les visites</h2>
                <p class="text-xs text-gray-400 mt-0.5">30 derniers jours</p>
            </div>
            <div class="divide-y divide-gray-50">
                <div class="px-5 py-3 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-900">Accès direct</span>
                    <span class="text-sm font-bold text-gray-400">{{ number_format($visits['directCount']) }}</span>
                </div>
                @forelse ($visits['topReferrers'] as $referrer)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <span class="text-sm font-semibold text-gray-900 truncate">{{ $referrer->referrer_host }}</span>
                        <span class="text-sm font-bold text-gray-400">{{ number_format($referrer->total) }}</span>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-gray-400">Aucun référent externe pour le moment.</p>
                @endforelse
            </div>
        </div>

    </div>

    @if ($visits['topPages']->isNotEmpty())
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden mb-10">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm">Pages les plus visitées</h2>
                <p class="text-xs text-gray-400 mt-0.5">30 derniers jours</p>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach ($visits['topPages'] as $page)
                    <div class="px-5 py-3 flex items-center justify-between gap-4">
                        <span class="text-sm font-semibold text-gray-900 truncate">{{ $page->path }}</span>
                        <span class="text-sm font-bold text-gray-400 flex-shrink-0">{{ number_format($page->total) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($stats['pending_nominations'] > 0)
        <a href="{{ route('admin.nominations.index') }}"
            class="flex items-center justify-between bg-amber-50 border border-amber-200 rounded-2xl px-6 py-4 mb-10 hover:bg-amber-100 transition-colors">
            <span class="text-sm font-semibold text-amber-700">
                {{ $stats['pending_nominations'] }} nomination(s) de talent en attente de traitement.
            </span>
            <span class="text-xs font-bold text-amber-700">Voir →</span>
        </a>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden lg:col-span-1">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm">Derniers utilisateurs</h2>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse ($recentUsers as $user)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $user->username }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wide text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full flex-shrink-0">
                            {{ $user->role }}
                        </span>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-gray-400">Aucun utilisateur pour le moment.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden lg:col-span-1">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm">Derniers projets</h2>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse ($recentProjects as $project)
                    <a href="{{ route('projects.show', $project->slug) }}" class="block px-5 py-3 hover:bg-gray-50">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $project->title }}</p>
                        <p class="text-xs text-gray-400 truncate">par {{ $project->user->username ?? '-' }}</p>
                    </a>
                @empty
                    <p class="px-5 py-6 text-sm text-gray-400">Aucun projet pour le moment.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden lg:col-span-1">
            <div class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-900 text-sm">Derniers commentaires</h2>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse ($recentComments as $comment)
                    <div class="px-5 py-3">
                        <p class="text-sm text-gray-700 line-clamp-2">{{ $comment->body }}</p>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $comment->user->username ?? '-' }} sur « {{ $comment->project->title ?? '-' }} »
                        </p>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-gray-400">Aucun commentaire pour le moment.</p>
                @endforelse
            </div>
        </div>

    </div>
</x-admin-layout>
