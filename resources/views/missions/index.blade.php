<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        {{-- HERO --}}
        <section class="relative bg-white py-20 overflow-hidden rounded-2xl border border-gray-100">
            <div class="absolute inset-0 z-0 pointer-events-none opacity-60"
                style="background-image: radial-gradient(#00000014 1px, transparent 1px); background-size: 28px 28px;">
            </div>
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-violet-100/60 blur-[120px]">
                </div>
                <div class="absolute -bottom-[10%] -left-[10%] w-[50%] h-[50%] rounded-full bg-indigo-100/60 blur-[100px]">
                </div>
            </div>
            <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">

                @if ($creatifCount > 0)
                    <div class="inline-flex items-center gap-2.5 bg-gray-50 border border-gray-100 rounded-full pl-2 pr-4 py-1.5 mb-6">
                        @if ($badgeCreatifs->count())
                            <div class="flex -space-x-2.5">
                                @foreach ($badgeCreatifs as $bc)
                                    <img src="{{ $bc->photo }}"
                                        class="w-6 h-6 rounded-full object-cover ring-2 ring-gray-50">
                                @endforeach
                            </div>
                        @endif
                        <span class="text-xs font-semibold text-gray-500">
                            <span class="text-gray-900 font-bold">{{ number_format($creatifCount) }}</span>
                            créatif{{ $creatifCount > 1 ? 's' : '' }} déjà sur Mefolio
                        </span>
                    </div>
                @endif

                <h1 class="text-5xl sm:text-6xl font-black text-slate-900 tracking-tight leading-[1.05] mb-6">
                    Votre prochaine<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">
                        mission freelance
                    </span>
                </h1>
                <p class="text-lg text-slate-500 max-w-xl mx-auto leading-relaxed">
                    Proposez vos services et connectez-vous directement avec des clients africains.
                </p>

                <div class="mt-10 flex justify-center">
                    @auth
                        <a href="{{ route('missions.create') }}"
                            class="inline-flex items-center gap-2 px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-full transition-all hover:scale-105 text-sm">
                            Publier une mission →
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-full transition-all hover:scale-105 text-sm">
                            Publier une mission →
                        </a>
                    @endauth
                </div>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-xs text-gray-500">
                    @foreach (['Publication gratuite', 'Candidature en un clic', 'Directement avec le client'] as $point)
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            {{ $point }}
                        </span>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- FILTRES --}}
            <form method="GET" class="flex flex-wrap items-center gap-3 mb-8">
                <div class="relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher une mission..."
                        class="w-52 pl-9 pr-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 placeholder:font-normal focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <select name="domaine" onchange="this.form.submit()"
                    class="px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Tous les domaines</option>
                    @foreach ($domaines as $domaine)
                        <option value="{{ $domaine }}" @selected(request('domaine') === $domaine)>{{ $domaine }}</option>
                    @endforeach
                </select>

                <select name="niveau" onchange="this.form.submit()"
                    class="px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Tous niveaux</option>
                    <option value="Junior" @selected(request('niveau') === 'Junior')>Junior</option>
                    <option value="Intermédiaire" @selected(request('niveau') === 'Intermédiaire')>Intermédiaire</option>
                    <option value="Senior" @selected(request('niveau') === 'Senior')>Senior</option>
                </select>

                <input type="text" name="lieu" value="{{ request('lieu') }}" placeholder="Lieu (remote, Cotonou...)"
                    onchange="this.form.submit()"
                    class="px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                <select name="tri" onchange="this.form.submit()"
                    class="ml-auto px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="recent" @selected(request('tri', 'recent') === 'recent')>Plus récentes</option>
                    <option value="budget-desc" @selected(request('tri') === 'budget-desc')>Budget décroissant</option>
                    <option value="budget-asc" @selected(request('tri') === 'budget-asc')>Budget croissant</option>
                </select>

                @if (request()->anyFilled(['domaine', 'niveau', 'lieu', 'q']))
                    <a href="{{ route('missions.index') }}"
                        class="px-4 py-2 rounded-full border border-red-200 bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition-all">
                        Effacer les filtres
                    </a>
                @endif
            </form>

            <p class="text-sm text-gray-500 mb-6">
                <span class="font-bold text-gray-900">{{ $missions->total() }}</span> mission(s) disponible(s)
            </p>

            {{-- GRILLE MISSIONS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($missions as $mission)
                    <a href="{{ route('missions.show', $mission) }}"
                        class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg hover:border-indigo-100 transition-all duration-300">

                        <div class="p-5 pb-4">
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653" />
                                    </svg>
                                </div>
                                @if ($mission->urgent)
                                    <span class="text-[10px] bg-red-50 text-red-600 border border-red-100 font-bold px-2 py-0.5 rounded-full uppercase tracking-wide">
                                        Urgent
                                    </span>
                                @endif
                            </div>

                            <h3 class="font-bold text-gray-900 text-sm leading-snug mb-2 group-hover:text-indigo-600 transition-colors">
                                {{ $mission->title }}
                            </h3>

                            <p class="text-[11px] font-bold text-indigo-500 mb-3">{{ $mission->domaine }}</p>

                            <div class="space-y-1.5 mb-4 text-xs text-gray-500">
                                <p>{{ $mission->lieu ?: ($mission->remote ? 'Remote' : '—') }}</p>
                                @if ($mission->duree)
                                    <p>{{ $mission->duree }}</p>
                                @endif
                                @if ($mission->niveau)
                                    <p>{{ $mission->niveau }}</p>
                                @endif
                            </div>

                            @if (!empty($mission->tags))
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($mission->tags as $tag)
                                        <span class="text-[11px] bg-gray-50 text-gray-600 font-medium px-2 py-0.5 rounded-full border border-gray-100">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="px-5 py-3.5 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-black text-indigo-600 flex-shrink-0">
                                    {{ substr($mission->user->username ?? '?', 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-gray-900 truncate">{{ $mission->user->username ?? '—' }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $mission->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                @if ($mission->budget_min || $mission->budget_max)
                                    <p class="text-sm font-black text-gray-900">
                                        {{ number_format($mission->budget_min ?? $mission->budget_max) }}
                                        @if ($mission->budget_max && $mission->budget_min && $mission->budget_max != $mission->budget_min)
                                            – {{ number_format($mission->budget_max) }}
                                        @endif
                                        FCFA
                                    </p>
                                @endif
                                <span class="text-[10px] text-gray-400">{{ $mission->applications_count }} candidature(s)</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-20 text-gray-400">
                        <p class="text-sm font-medium">Aucune mission ne correspond à votre recherche pour le moment.</p>
                        @auth
                            <a href="{{ route('missions.create') }}" class="inline-block mt-4 text-indigo-600 font-semibold text-sm hover:underline">
                                Publier la première mission →
                            </a>
                        @endauth
                    </div>
                @endforelse
            </div>

            <div class="mt-10">{{ $missions->links() }}</div>
        </div>

        <x-newsletter-cta title="Soyez notifié en premier"
            description="Inscrivez-vous pour recevoir les nouvelles missions publiées sur Mefolio." source="missions" />
    </div>
</x-app-layout>
