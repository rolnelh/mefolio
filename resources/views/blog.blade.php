<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div>
                <h1 class="text-4xl sm:text-5xl font-black text-gray-900 leading-none">
                    {{ __('Actualités &') }}
                    <span class="text-indigo-600">{{ __('Inspiration.') }}</span>
                </h1>
            </div>
            <p class="text-sm text-gray-700 max-w-xs leading-relaxed">
                {{ __('Ressources, conseils et histoires pour les créatifs africains qui construisent leur avenir.') }}
            </p>
        </div>

        @if ($categories->count())
            <div class="flex flex-wrap gap-2 mb-10">
                <a href="{{ route('blog') }}"
                    class="{{ !request('categorie') ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-indigo-300' }} px-4 py-2 rounded-full text-sm font-semibold transition-all">
                    {{ __('Tous') }}
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('blog', ['categorie' => $cat]) }}"
                        class="{{ request('categorie') === $cat ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-indigo-300' }} px-4 py-2 rounded-full text-sm font-semibold transition-all">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($featured)
            <a href="{{ route('blog.show', $featured) }}"
                class="group relative block bg-[#050810] rounded-3xl overflow-hidden mb-12 cursor-pointer">
                <img src="{{ $featured->cover_image ?: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=1200&auto=format&fit=crop' }}"
                    alt="{{ $featured->title }}"
                    class="w-full h-80 object-cover opacity-50 group-hover:opacity-40 transition-opacity duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-xs bg-indigo-600 text-white font-bold px-3 py-1 rounded-full">{{ __('À la une') }}</span>
                        <span class="text-xs text-gray-300">{{ $featured->category }} · {{ trans_choice(':count min de lecture', $featured->reading_minutes, ['count' => $featured->reading_minutes]) }}</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-black text-white mb-3 leading-tight">{{ $featured->title }}</h2>
                    @if ($featured->excerpt)
                        <p class="text-gray-300 text-sm mb-4 max-w-2xl line-clamp-2">{{ $featured->excerpt }}</p>
                    @endif
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-black">
                            {{ substr($featured->author->username ?? 'M', 0, 1) }}
                        </div>
                        <span class="text-gray-300 text-xs">
                            {{ $featured->author->username ?? __('Équipe Mefolio') }} · {{ $featured->published_at?->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </a>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-16">
            @forelse ($posts as $article)
                <article
                    class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 cursor-pointer">
                    <a href="{{ route('blog.show', $article) }}">
                        <div class="overflow-hidden" style="height: 190px;">
                            <img src="{{ $article->cover_image ?: 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&auto=format&fit=crop' }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-500">{{ $article->category }}</span>
                                <span class="text-gray-200">·</span>
                                <span class="text-[11px] text-gray-400">{{ trans_choice(':count min de lecture', $article->reading_minutes, ['count' => $article->reading_minutes]) }}</span>
                            </div>
                            <h3 class="font-bold text-gray-900 leading-snug mb-3 group-hover:text-indigo-600 transition-colors text-sm">
                                {{ $article->title }}
                            </h3>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-black text-indigo-600">
                                        {{ substr($article->author->username ?? 'M', 0, 1) }}
                                    </div>
                                    <span class="text-[11px] text-gray-500 font-medium">{{ $article->author->username ?? __('Équipe Mefolio') }}</span>
                                </div>
                                <span class="text-[11px] text-gray-400">{{ $article->published_at?->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <div class="col-span-full text-center py-20 text-gray-400">
                    <p class="text-sm font-medium">{{ __('Aucun article publié pour le moment. Revenez bientôt !') }}</p>
                </div>
            @endforelse
        </div>

        <div class="mb-16">{{ $posts->links() }}</div>

        <x-newsletter-cta title="Newsletter Mefolio"
            :description="__('Recevez chaque semaine les meilleurs articles, opportunités et actualités du monde créatif africain.')"
            source="blog" />

    </div>
</x-app-layout>
