<x-app-layout>

    <section class="relative bg-[#050810] py-20 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[50%] h-[60%] rounded-full bg-yellow-500/10 blur-[120px]"></div>
            <div class="absolute bottom-0 left-0 w-[40%] h-[50%] rounded-full bg-indigo-600/10 blur-[100px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-relaxed mb-6">
                        Prouvez votre<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-400">
                            talent.
                        </span>
                    </h1>
                    <p class="text-lg text-gray-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Participez à des défis créatifs, gagnez des prix et faites reconnaître vos compétences par la
                        communauté Mefolio.
                    </p>
                </div>
                <div class="flex justify-center lg:justify-end">
                    <img src="{{ asset('/images/challenges.webp') }}" alt="Challenges Mefolio"
                        class="w-full max-w-lg rounded-xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

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
