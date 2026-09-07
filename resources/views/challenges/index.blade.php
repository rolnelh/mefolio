<x-app-layout>

    <section class="relative bg-[#F7F6F1] py-20 overflow-hidden">
        <div class="absolute inset-0 z-0 pointer-events-none opacity-60"
            style="background-image: radial-gradient(#00000014 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="flex justify-center lg:justify-start order-2 lg:order-1">
                    <img src="{{ asset('/images/challenges.webp') }}" alt="Challenges Mefolio"
                        class="w-full max-w-md rounded-2xl shadow-xl">
                </div>
                <div class="text-center lg:text-left order-1 lg:order-2">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-relaxed mb-6">
                        Prouvez votre<br>
                        <span class="text-amber-500">talent.</span>
                    </h1>
                    <p class="text-lg text-slate-500 max-w-xl mx-auto lg:mx-0 leading-relaxed mb-8">
                        Participez à des défis créatifs, gagnez des prix et faites reconnaître vos compétences par la
                        communauté Mefolio.
                    </p>
                    <a href="#defis"
                        class="inline-flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02]">
                        Découvrir les défis
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div id="defis" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 scroll-mt-24">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($challenges as $challenge)
                <a href="{{ route('challenges.show', $challenge) }}"
                    class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    @if ($challenge->image)
                        <div class="h-40 overflow-hidden">
                            <img src="{{ $challenge->image }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $challenge->status === 'open' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                {{ $challenge->status === 'open' ? 'Ouvert' : 'Fermé' }}
                            </span>
                            @if ($challenge->category)
                                <span class="text-[11px] font-semibold text-indigo-500">{{ $challenge->category }}</span>
                            @endif
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $challenge->title }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $challenge->description }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-50 text-xs text-gray-400">
                            <span>{{ $challenge->participants_count }} participant(s)</span>
                            @if ($challenge->prize)
                                <span class="font-bold text-gray-900">{{ $challenge->prize }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-20 text-gray-400">
                    <p class="text-sm font-medium">Aucun challenge n'est publié pour le moment. Revenez bientôt !</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">{{ $challenges->links() }}</div>

        <x-newsletter-cta title="Soyez alerté des nouveaux challenges"
            description="Recevez une notification dès qu'un nouveau challenge créatif est publié." source="challenges" />
    </div>
</x-app-layout>
