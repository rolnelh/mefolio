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
                        <p class="text-xs text-gray-400 truncate">par {{ $project->user->username ?? '—' }}</p>
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
                            {{ $comment->user->username ?? '—' }} sur « {{ $comment->project->title ?? '—' }} »
                        </p>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-gray-400">Aucun commentaire pour le moment.</p>
                @endforelse
            </div>
        </div>

    </div>
</x-admin-layout>
