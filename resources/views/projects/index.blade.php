<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-10">

        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-4">

            <div class="mb-6 md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ __('Découvrez les meilleures réalisations de nos') }} <span class="text-indigo-600">{{ __('créatifs') }}</span>
                </h1>
                <p class="text-gray-500 mt-2 text-base font-medium">
                    {{ __('Explorez des projets inspirants réalisés par la communauté africaine.') }}
                </p>
            </div>

            <form method="GET" class="flex flex-wrap items-center gap-3 pt-6 border-t border-gray-100 dark:border-gray-800 mb-10">
                <a href="{{ route('projects.index') }}"
                    class="px-4 py-1.5 border rounded-full text-xs font-bold transition-all {{ !request('category') ? 'bg-gray-900 text-white border-gray-900' : 'border-gray-200 dark:border-gray-800 text-gray-500 hover:border-indigo-600 hover:text-indigo-600' }}">
                    {{ __('Tous') }}
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('projects.index', ['category' => $cat]) }}"
                        class="px-4 py-1.5 border rounded-full text-xs font-bold transition-all {{ request('category') === $cat ? 'bg-gray-900 text-white border-gray-900' : 'border-gray-200 dark:border-gray-800 text-gray-500 hover:border-indigo-600 hover:text-indigo-600' }}">
                        {{ $cat }}
                    </a>
                @endforeach

                <input type="hidden" name="category" value="{{ request('category') }}">
                <div class="ml-auto flex-1 max-w-xs">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Rechercher un projet...') }}"
                        class="w-full bg-gray-100 dark:bg-gray-900 border-none rounded-xl py-2.5 px-4 text-sm focus:ring-2 focus:ring-indigo-500 transition-all">
                </div>
                <button class="px-4 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-bold hover:bg-indigo-600 transition-all">
                    {{ __('Chercher') }}
                </button>
            </form>

        </div>

        <div class="grid gap-x-8 gap-y-14 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                <article class="group">

                    <div
                        class="relative aspect-[4/3] overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800 transition-all duration-500 group-hover:shadow-2xl group-hover:shadow-blue-500/10 group-hover:-translate-y-1">

                        <a href="{{ route('projects.show', $project->slug) }}">
                            <img src="{{ $project->image ?: 'https://via.placeholder.com/400x300' }}"
                                alt="{{ $project->title }}"
                                class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" />
                        </a>

                        <div class="absolute top-4 left-4 z-20">
                            <span
                                class="inline-flex items-center rounded-full bg-white/90 dark:bg-gray-900/80 px-3 py-1 text-[9px] font-bold uppercase tracking-widest text-gray-900 dark:text-white backdrop-blur-md border border-white/20">
                                {{ $project->category ?? __('Créatif') }}
                            </span>
                        </div>

                        <div
                            class="absolute inset-0 z-10 opacity-0 group-hover:opacity-100 transition-all duration-500 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-6 pointer-events-none">
                            <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-500 pointer-events-auto">

                                <div class="flex items-start justify-between gap-4">
                                    <a href="{{ route('projects.show', $project->slug) }}" class="flex-1">
                                        <h3 class="text-base font-bold text-white leading-tight">
                                            {{ $project->title }}
                                        </h3>

                                        <p class="mt-2 text-xs text-gray-200 line-clamp-2 font-light leading-relaxed">
                                            {{ $project->description }}
                                        </p>
                                    </a>

                                    <a href="{{ route('projects.show', $project->slug) }}"
                                        class="size-9 shrink-0 flex items-center justify-center rounded-full bg-white text-gray-900 shadow-xl hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between px-1">
                        <a href="{{ route('creatifs.show', $project->creatif->slug ?? '') }}"
                            class="flex items-center gap-3 group/author">
                            <div class="relative">
                                <img src="{{ $project->creatif->photo ?? null ?: 'https://ui-avatars.com/api/?name=' . urlencode($project->creatif->prenom ?? '?') }}"
                                    class="size-8 rounded-full object-cover grayscale group-hover/author:grayscale-0 transition-all duration-300" />
                                <div
                                    class="absolute -bottom-0.5 -right-0.5 size-2 rounded-full bg-green-500 border-2 border-white dark:border-gray-950">
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 leading-none">
                                    {{ $project->creatif->prenom ?? $project->user->username }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-medium mt-1">
                                    @ {{ $project->creatif->slug ?? $project->user->username }}
                                </span>
                            </div>
                        </a>

                        @auth
                            <form method="POST" action="{{ route('projects.like', $project) }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-1.5 px-2 py-1 transition-all duration-300 {{ $project->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                        fill="{{ $project->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    <span class="text-[11px] font-bold">{{ $project->likes->count() }}</span>
                                </button>
                            </form>
                        @else
                            <div class="flex items-center gap-1.5 px-2 py-1 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="text-[11px] font-bold">{{ $project->likes->count() }}</span>
                            </div>
                        @endauth
                    </div>
                </article>

            @empty
                <div class="col-span-full py-32 flex flex-col items-center text-center">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 15.803a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Aucun projet trouvé') }}</h3>
                    <p class="text-sm text-gray-400 max-w-sm">{{ __("Aucun créatif n'a encore publié de projet correspondant à vos critères.") }}</p>
                    <a href="{{ route('projects.index') }}"
                        class="mt-8 px-6 py-2.5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-bold rounded-full hover:bg-indigo-600 transition-all">
                        {{ __('Voir tous les projets') }}
                    </a>
                </div>
            @endforelse
        </div>

        @if ($projects->hasPages())
            <div class="mt-20 pt-10 border-t border-gray-100 dark:border-gray-800">
                {{ $projects->links() }}
            </div>
        @endif

    </div>
</x-app-layout>
