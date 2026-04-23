<x-app-layout>
    <div class="min-h-screen bg-gray-50/30">

        {{-- BREADCRUMB --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <nav class="flex items-center gap-2 text-sm text-gray-400">
                        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Accueil</a>
                        <span>/</span>
                        <a href="{{ route('projects.index') }}"
                            class="hover:text-indigo-600 transition-colors">Projets</a>
                        <span>/</span>
                        <span class="text-gray-700 font-medium truncate max-w-[200px]">{{ $project->title }}</span>
                    </nav>
                    @if (Auth::id() === $project->user_id)
                        <div class="flex items-center gap-2">
                            <a href="{{ route('projets.edit', $project) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-gray-200 rounded-xl text-gray-700 font-semibold text-xs hover:bg-gray-50 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Modifier
                            </a>
                            <form action="{{ route('projets.destroy', $project) }}" method="POST"
                                onsubmit="return confirm('Supprimer définitivement ?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-50 text-red-600 font-semibold text-xs rounded-xl hover:bg-red-100 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row gap-8 items-start">

                {{-- ═══ CONTENU PRINCIPAL ═══ --}}
                <main class="flex-1 min-w-0 space-y-6">

                    {{-- Titre --}}
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            @if ($project->category)
                                <span
                                    class="text-[10px] font-bold uppercase tracking-widest text-indigo-500 bg-indigo-50 border border-indigo-100 px-2.5 py-1 rounded-lg">
                                    {{ $project->category }}
                                </span>
                            @endif
                            <span
                                class="text-xs text-gray-400">{{ $project->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-black text-gray-900 leading-tight">{{ $project->title }}
                        </h1>
                    </div>

                    {{-- Galerie média --}}
                    <div x-data="{
                        activeMedia: '{{ $project->image ?: '' }}',
                        activeType: 'image',
                        lightbox: false,
                        lightboxSrc: ''
                    }"
                        class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">

                        {{-- Image/vidéo principale --}}
                        <div class="relative bg-gray-900 overflow-hidden" style="max-height: 600px;">
                            <template x-if="activeType === 'image' && activeMedia">
                                <img :src="activeMedia" @click="lightbox = true; lightboxSrc = activeMedia"
                                    class="w-full h-auto max-h-[600px] object-contain mx-auto cursor-zoom-in transition-all duration-500"
                                    alt="{{ $project->title }}">
                            </template>
                            <template x-if="activeType === 'video' && activeMedia">
                                <video :src="activeMedia" class="w-full max-h-[600px] object-contain mx-auto"
                                    controls autoplay muted></video>
                            </template>
                            <template x-if="!activeMedia">
                                <div class="flex items-center justify-center h-64 text-gray-600">
                                    <p class="text-sm">Aucun média disponible</p>
                                </div>
                            </template>

                            {{-- Bouton zoom --}}
                            <button x-show="activeType === 'image' && activeMedia"
                                @click="lightbox = true; lightboxSrc = activeMedia"
                                class="absolute top-4 right-4 p-2 bg-black/40 hover:bg-black/60 text-white rounded-xl backdrop-blur-sm transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                </svg>
                            </button>
                        </div>

                        {{-- Lightbox --}}
                        <div x-show="lightbox" @click="lightbox = false" @keydown.escape.window="lightbox = false"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            class="fixed inset-0 z-[100] bg-black/90 flex items-center justify-center p-4 cursor-zoom-out">
                            <button @click.stop="lightbox = false"
                                class="absolute top-4 right-4 p-2 bg-white/10 hover:bg-white/20 text-white rounded-xl transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <img :src="lightboxSrc" class="max-w-full max-h-full object-contain rounded-2xl"
                                @click.stop>
                        </div>

                        {{-- Miniatures --}}
                        @php
                            $allMedia = is_array($project->fichiers)
                                ? $project->fichiers
                                : json_decode($project->fichiers, true) ?? [];
                        @endphp

                        @if (count($allMedia) > 1 || ($project->image && count($allMedia) > 0))
                            <div class="p-4 border-t border-gray-50 bg-gray-50/50">
                                <div class="flex gap-3 overflow-x-auto pb-1 hide-scrollbar">

                                    @if ($project->image)
                                        <button @click="activeMedia = '{{ $project->image }}'; activeType = 'image'"
                                            class="flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden border-2 transition-all duration-200 shadow-sm"
                                            :class="activeMedia === '{{ $project->image }}' ?
                                                'border-indigo-600 ring-2 ring-indigo-500/30 scale-105' :
                                                'border-transparent hover:border-gray-300'">
                                            <img src="{{ $project->image }}" class="w-full h-full object-cover"
                                                alt="Couverture">
                                        </button>
                                    @endif

                                    @foreach ($allMedia as $file)
                                        @php
                                            $ext = strtolower(
                                                pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION),
                                            );
                                            $isVideo = in_array($ext, ['mp4', 'webm', 'mov', 'avi']);
                                        @endphp
                                        <button
                                            @click="activeMedia = '{{ $file }}'; activeType = '{{ $isVideo ? 'video' : 'image' }}'"
                                            class="flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden border-2 transition-all duration-200 shadow-sm relative"
                                            :class="activeMedia === '{{ $file }}' ?
                                                'border-indigo-600 ring-2 ring-indigo-500/30 scale-105' :
                                                'border-transparent hover:border-gray-300'">
                                            @if ($isVideo)
                                                <video src="{{ $file }}" class="w-full h-full object-cover"
                                                    muted></video>
                                                <div
                                                    class="absolute inset-0 flex items-center justify-center bg-black/30">
                                                    <svg class="w-5 h-5 text-white" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </div>
                                            @else
                                                <img src="{{ $file }}" class="w-full h-full object-cover"
                                                    alt="Media">
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                        <h2 class="text-xl font-black text-gray-900 mb-6">À propos du projet</h2>

                        @if ($project->technologies)
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach (explode(',', $project->technologies) as $tech)
                                    <span
                                        class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-indigo-100">
                                        {{ trim($tech) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <div class="text-gray-600 leading-relaxed text-base prose max-w-none">
                            {!! nl2br(e($project->description)) !!}
                        </div>

                        @if ($project->lien_site || $project->lien_github)
                            <div class="flex flex-wrap gap-3 mt-8 pt-6 border-t border-gray-50">
                                @if ($project->lien_site)
                                    <a href="{{ $project->lien_site }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 hover:scale-105 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Voir le site live
                                    </a>
                                @endif
                                @if ($project->lien_github)
                                    <a href="{{ $project->lien_github }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 hover:bg-black text-white font-bold rounded-xl transition-all hover:scale-105 text-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                        </svg>
                                        Code Source
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- Commentaires --}}
                    @include('comment', ['project' => $project])

                </main>

                {{-- ═══ SIDEBAR ═══ --}}
                <aside class="w-full lg:w-80 flex-shrink-0 space-y-5 lg:sticky lg:top-24">

                    {{-- Créatif --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="p-6">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-5">Le Créatif
                            </p>

                            <div class="flex items-center gap-4 mb-5">
                                <div class="relative">
                                    <img src="{{ $project->creatif->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($project->creatif->prenom ?? 'M') . '&background=6366f1&color=fff&size=200' }}"
                                        class="w-16 h-16 rounded-2xl object-cover shadow-md ring-4 ring-indigo-50"
                                        alt="{{ $project->creatif->prenom }}">
                                    <div
                                        class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-black text-gray-900 leading-tight">
                                        {{ $project->creatif->prenom }} {{ $project->creatif->nom }}
                                    </h3>
                                    @if ($project->creatif->specialite)
                                        <p class="text-xs text-indigo-600 font-semibold mt-0.5">
                                            {{ $project->creatif->specialite }}</p>
                                    @endif
                                    @if ($project->creatif->localisation)
                                        <p class="text-xs text-gray-400 mt-0.5">📍
                                            {{ $project->creatif->localisation }}</p>
                                    @endif
                                </div>
                            </div>

                            @if ($project->creatif->bio)
                                <p class="text-xs text-gray-500 leading-relaxed mb-5 line-clamp-3">
                                    {{ $project->creatif->bio }}
                                </p>
                            @endif

                            <a href="{{ route('creatifs.show', $project->creatif->slug) }}"
                                class="flex items-center justify-center gap-2 w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-2xl transition-all hover:scale-[1.02] shadow-lg shadow-indigo-200">
                                Voir le portfolio
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>

                            @auth
                                @if (Auth::user()->creatif?->id !== $project->creatif->id)
                                    <button
                                        class="flex items-center justify-center gap-2 w-full py-2.5 mt-2 bg-gray-50 hover:bg-gray-100 text-gray-700 font-semibold text-sm rounded-2xl transition-all border border-gray-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        Contacter
                                    </button>
                                @endif
                            @endauth
                        </div>
                    </div>

                    {{-- Infos projet --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Infos projet</p>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-400">Publié le</span>
                                <span
                                    class="text-xs font-semibold text-gray-700">{{ $project->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            @if ($project->category)
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-400">Catégorie</span>
                                    <span
                                        class="text-xs font-semibold text-indigo-600">{{ $project->category }}</span>
                                </div>
                            @endif
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-400">Commentaires</span>
                                <span
                                    class="text-xs font-semibold text-gray-700">{{ $project->comments->count() }}</span>
                            </div>
                            @if ($project->technologies)
                                <div class="pt-3 border-t border-gray-50">
                                    <span class="text-xs text-gray-400 block mb-2">Technologies</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach (explode(',', $project->technologies) as $tech)
                                            <span
                                                class="text-[10px] bg-gray-50 text-gray-600 font-semibold px-2 py-0.5 rounded-full border border-gray-100">
                                                {{ trim($tech) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Partager --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Partager</p>
                        <div class="flex gap-2">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}"
                                target="_blank"
                                class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-gray-900 text-white text-xs font-bold rounded-xl hover:bg-gray-800 transition-all">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                                X / Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                target="_blank"
                                class="flex-1 flex items-center justify-center gap-2 py-2.5 bg-blue-600 text-white text-xs font-bold rounded-xl hover:bg-blue-700 transition-all">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                                LinkedIn
                            </a>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>

    <style>
        .hide-scrollbar {
            scrollbar-width: none;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</x-app-layout>
