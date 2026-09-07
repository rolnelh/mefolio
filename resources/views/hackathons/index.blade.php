<x-app-layout>

    <section class="relative bg-white py-8 lg:py-16 overflow-hidden border-b border-gray-100 min-h-[60vh] flex items-center">
        <div class="absolute inset-0 z-0 opacity-[0.02]"
            style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-[10%] right-[5%] w-[40%] h-[50%] rounded-full bg-orange-50/50 blur-[100px]"></div>
            <div class="absolute bottom-0 left-[5%] w-[30%] h-[40%] rounded-full bg-indigo-50/40 blur-[80px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <div class="text-left order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 bg-orange-50 border border-orange-100 text-orange-600 text-[10px] font-black px-4 py-1.5 rounded-full mb-6 uppercase tracking-[0.2em]">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                        Hub des opportunités africaines
                    </div>

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-slate-900 tracking-tight leading-[0.95] mb-6">
                        Programmes &<br>
                        <span class="text-orange-500">Hackathons</span>
                    </h1>

                    <p class="text-lg text-slate-500 max-w-xl leading-relaxed mb-8">
                        Découvrez les meilleurs programmes d'accompagnement et compétitions tech en Afrique,
                        centralisés sur Mefolio.
                    </p>
                </div>

                <div class="relative order-1 lg:order-2 lg:-mt-16">
                    <div class="relative p-2 rounded-[2.2rem] overflow-hidden">
                        <img src="{{ asset('images/designer.png') }}" alt="Programmes et Hackathons Afrique"
                            class="w-full h-auto rounded-[1.8rem] object-cover">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">

        @if ($featured->count())
            <div class="mb-20">
                <div class="mb-10">
                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-orange-500 mb-2">À la une</p>
                    <h2 class="text-3xl font-black text-gray-900">Programmes phares</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach ($featured as $program)
                        <div class="relative bg-gradient-to-br from-slate-900 to-indigo-900 rounded-3xl p-8 text-white overflow-hidden">
                            <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-500/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-6">
                                    <div>
                                        <p class="text-xs text-indigo-300 font-bold uppercase tracking-wider">{{ $program->country }} · {{ $program->type }}</p>
                                        <h3 class="text-xl font-black">{{ $program->name }}</h3>
                                    </div>
                                </div>
                                <p class="text-indigo-100 text-sm leading-relaxed mb-6">{{ $program->description }}</p>
                                @if (!empty($program->tags))
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach ($program->tags as $tag)
                                            <span class="text-xs bg-white/10 text-indigo-200 px-2.5 py-1 rounded-full">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                @if ($program->url)
                                    <a href="{{ $program->url }}" target="_blank" rel="noopener"
                                        class="inline-flex items-center gap-2 text-sm font-bold text-white border-b-2 border-white/40 hover:border-white transition-colors">
                                        Voir le programme →
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-black text-gray-900">Tous les programmes</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($programs as $program)
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 hover:shadow-md transition-all">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">{{ $program->country }} · {{ $program->type }}</p>
                                <h3 class="text-lg font-black text-gray-900">{{ $program->name }}</h3>
                                <p class="text-xs text-gray-500">{{ $program->full_name }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed mb-4">{{ $program->description }}</p>
                        @if (!empty($program->tags))
                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach ($program->tags as $tag)
                                    <span class="text-[11px] bg-white text-gray-600 font-medium px-2 py-0.5 rounded-full border border-gray-100">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                        @if ($program->url)
                            <a href="{{ $program->url }}" target="_blank" rel="noopener" class="text-xs font-bold text-indigo-600 hover:underline">
                                Site officiel →
                            </a>
                        @endif
                    </div>
                @empty
                    <p class="col-span-full text-center py-16 text-gray-400 text-sm">Aucun programme référencé pour le moment.</p>
                @endforelse
            </div>

            <div class="mt-8">{{ $programs->links() }}</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <div class="bg-gray-50 border border-gray-100 rounded-3xl p-8">
                <h3 class="text-xl font-black text-gray-900 mb-2">Vous organisez un programme ?</h3>
                <p class="text-gray-500 text-sm mb-6">Référencez votre hackathon, concours ou programme d'accélération
                    sur Mefolio et touchez des milliers de talents africains.</p>
                <a href="mailto:contact@mefolio.com"
                    class="inline-flex items-center gap-2 bg-gray-900 text-white text-sm font-bold px-6 py-2.5 rounded-xl hover:bg-indigo-600 transition-all">
                    Nous contacter →
                </a>
            </div>
            <x-newsletter-cta title="Soyez alerté" description="Recevez une notification dès qu'un programme correspond à votre profil." source="hackathons" />
        </div>

    </div>
</x-app-layout>
