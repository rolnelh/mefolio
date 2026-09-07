<x-app-layout>

    <section class="relative bg-[#F7F6F1] py-24 overflow-hidden">
        <div class="absolute inset-0 z-0 pointer-events-none opacity-60"
            style="background-image: radial-gradient(#00000014 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        @php
            $badges = [
                ['pos' => 'top-[8%] left-[8%] lg:left-[16%]', 'rotate' => '-rotate-6', 'bg' => 'text-amber-500', 'icon' => 'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35'],
                ['pos' => 'top-[10%] right-[8%] lg:right-[16%]', 'rotate' => 'rotate-6', 'bg' => 'text-indigo-500', 'icon' => 'M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42'],
                ['pos' => 'top-[42%] left-[2%] lg:left-[8%]', 'rotate' => 'rotate-3', 'bg' => 'text-violet-500', 'icon' => 'M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z'],
                ['pos' => 'top-[40%] right-[2%] lg:right-[8%]', 'rotate' => '-rotate-3', 'bg' => 'text-emerald-500', 'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'],
            ];
        @endphp

        @foreach ($badges as $badge)
            <div class="hidden md:flex absolute {{ $badge['pos'] }} {{ $badge['rotate'] }} w-14 h-14 bg-white rounded-2xl shadow-lg ring-4 ring-white items-center justify-center z-10">
                <svg class="w-6 h-6 {{ $badge['bg'] }}" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $badge['icon'] }}" />
                </svg>
            </div>
        @endforeach

        <div class="relative z-10 max-w-2xl mx-auto px-6 text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-relaxed mb-6">
                Prouvez votre<br>
                <span class="text-amber-500">talent.</span>
            </h1>
            <p class="text-lg text-slate-500 max-w-xl mx-auto leading-relaxed mb-8">
                Participez à des défis créatifs, gagnez des prix et faites reconnaître vos compétences par la
                communauté Mefolio.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mb-16">
                <a href="#defis"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02]">
                    Découvrir les défis
                </a>
                <a href="{{ route('classement.index') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-700 px-8 py-3.5 rounded-full text-sm font-bold hover:border-gray-400 transition-all">
                    Voir le classement
                </a>
            </div>

            <img src="{{ asset('/images/challenges.webp') }}" alt="Challenges Mefolio"
                class="w-full max-w-sm mx-auto rounded-2xl shadow-xl">
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
