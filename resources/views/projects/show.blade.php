<x-app-layout>
    <div class="bg-gray-50/50 min-h-screen pb-12">

        <div class="bg-white border-b border-gray-100 mb-8">
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <nav class="flex text-sm text-gray-500 mb-2 space-x-2">
                            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Accueil</a>
                            <span>/</span>
                            <span class="text-gray-800 font-medium">Projets</span>
                        </nav>
                        <h1 class="text-4xl font-black text-gray-900 tracking-tight">{{ $project->title }}</h1>
                        <div class="flex items-center mt-3 space-x-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $project->created_at->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    @if (Auth::id() === $project->user_id)
                        <div class="flex items-center gap-3">
                            <a href="{{ route('projets.edit', $project) }}"
                                class="px-5 py-2.5 bg-white border border-gray-200 rounded-xl text-gray-700 font-bold text-sm hover:bg-gray-50 transition shadow-sm">
                                Modifier le projet
                            </a>
                            <form action="{{ route('projets.destroy', $project) }}" method="POST"
                                onsubmit="return confirm('Supprimer définitivement ?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="px-5 py-2.5 bg-red-50 text-red-600 font-bold text-sm rounded-xl hover:bg-red-100 transition">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <main class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-10">

                <div class="w-full lg:w-8/12 space-y-8">

                    <div x-data="{
                        activeMedia: '{{ $project->image ? asset('storage/' . $project->image) : 'https://via.placeholder.com/1200x800' }}',
                        activeType: 'image'
                    }"
                        class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                        <div class="aspect-video w-full group relative bg-black flex items-center justify-center">
                            <template x-if="activeType === 'image'">
                                <img :src="activeMedia"
                                    class="w-full h-full object-cover transition-all duration-700 shadow-2xl"
                                    alt="Vue principale">
                            </template>

                            <template x-if="activeType === 'video'">
                                <video :src="activeMedia" class="w-full h-full object-contain" controls autoplay
                                    muted></video>
                            </template>
                        </div>

                        @php
                            // Correction : On utilise 'fichiers' et on s'assure que c'est un tableau
                            $allMedia = is_array($project->fichiers)
                                ? $project->fichiers
                                : json_decode($project->fichiers, true) ?? [];
                        @endphp

                        @if (count($allMedia) > 0)
                            <div
                                class="p-6 grid grid-cols-4 md:grid-cols-6 gap-4 border-t border-gray-50 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-900/30">

                                @if ($project->image)
                                    <button
                                        @click="activeMedia = '{{ asset('storage/' . $project->image) }}'; activeType = 'image'"
                                        class="aspect-square rounded-xl overflow-hidden border-2 transition-all active:scale-95 shadow-sm relative group"
                                        :class="activeMedia === '{{ asset('storage/' . $project->image) }}' ?
                                            'border-indigo-600 ring-2 ring-indigo-500/20' :
                                            'border-transparent hover:border-gray-300'">
                                        <img src="{{ asset('storage/' . $project->image) }}"
                                            class="w-full h-full object-cover">
                                    </button>
                                @endif

                                @foreach ($allMedia as $file)
                                    @php
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                        $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'mov']);
                                        $fileUrl = asset('storage/' . $file);
                                    @endphp

                                    <button
                                        @click="activeMedia = '{{ $fileUrl }}'; activeType = '{{ $isVideo ? 'video' : 'image' }}'"
                                        class="aspect-square rounded-xl overflow-hidden border-2 transition-all active:scale-95 shadow-sm relative group"
                                        :class="activeMedia === '{{ $fileUrl }}' ?
                                            'border-indigo-600 ring-2 ring-indigo-500/20' :
                                            'border-transparent hover:border-gray-300'">

                                        @if ($isVideo)
                                            <div
                                                class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/40 transition-colors">
                                                <i class="fas fa-play text-white text-xs"></i>
                                            </div>
                                            <video src="{{ $fileUrl }}"
                                                class="w-full h-full object-cover"></video>
                                        @else
                                            <img src="{{ $fileUrl }}" class="w-full h-full object-cover">
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h3 class="text-xl font-black text-gray-900 mb-6">À propos du projet</h3>

                        @if ($project->technologies)
                            <div class="flex flex-wrap gap-2 mb-8">
                                @foreach (explode(',', $project->technologies) as $tech)
                                    <span
                                        class="bg-indigo-50 text-indigo-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                                        {{ trim($tech) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <div class="prose prose-indigo max-w-none text-gray-600 leading-relaxed text-lg">
                            {!! nl2br(e($project->description)) !!}
                        </div>

                        <div class="flex flex-wrap gap-4 mt-10 pt-8 border-t border-gray-50">
                            @if ($project->lien_site)
                                <a href="{{ $project->lien_site }}" target="_blank"
                                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Voir le site live
                                </a>
                            @endif
                            @if ($project->lien_github)
                                <a href="{{ $project->lien_github }}" target="_blank"
                                    class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-xl font-bold hover:bg-black transition shadow-lg shadow-gray-200">
                                    <i class="fab fa-github text-xl mr-2"></i>
                                    Code Source
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8">
                        @include('comment', ['project' => $project])
                    </div>
                </div>

                <div class="w-full lg:w-4/12 space-y-6">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden sticky top-8">
                        <div class="p-8">
                            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Le Créatif</h2>
                            <div class="flex items-center gap-4 mb-6">
                                <img src="{{ asset('storage/' . $project->creatif->photo) }}"
                                    class="w-20 h-20 rounded-2xl object-cover shadow-md rotate-3" alt="Auteur">
                                <div>
                                    <h3 class="font-black text-xl text-gray-900">{{ $project->creatif->prenom }}
                                        {{ $project->creatif->nom }}</h3>
                                    <p class="text-sm text-indigo-600 font-bold">@
                                        {{ $project->creatif->user->username ?? 'Membre' }}</p>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm leading-relaxed mb-8">
                                {{ Str::limit($project->creatif->description, 120) }}
                            </p>
                            <a href="{{ route('creatifs.show', $project->creatif->slug) }}"
                                class="w-full flex justify-center items-center py-4 bg-gray-50 text-gray-900 font-black rounded-2xl hover:bg-indigo-50 hover:text-indigo-600 transition group">
                                Voir le portfolio
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>
