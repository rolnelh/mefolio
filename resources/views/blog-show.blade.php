<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-indigo-600 mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Tous les articles
        </a>

        <div class="flex items-center gap-3 mb-4">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-500">{{ $post->category }}</span>
            <span class="text-gray-200">·</span>
            <span class="text-xs text-gray-400">{{ $post->reading_minutes }} min de lecture</span>
        </div>

        <h1 class="text-4xl font-black text-gray-900 leading-tight mb-6">{{ $post->title }}</h1>

        <div class="flex items-center gap-3 mb-10">
            <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-black text-indigo-600">
                {{ substr($post->author->username ?? 'M', 0, 1) }}
            </div>
            <div>
                <p class="text-sm font-bold text-gray-900">{{ $post->author->username ?? 'Équipe Mefolio' }}</p>
                <p class="text-xs text-gray-400">{{ $post->published_at?->format('d M Y') }}</p>
            </div>
        </div>

        @if ($post->cover_image)
            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="w-full h-80 object-cover rounded-3xl mb-10">
        @endif

        <div class="prose prose-indigo max-w-none text-gray-700 leading-relaxed">
            {!! nl2br(e($post->body)) !!}
        </div>

        @if ($related->count())
            <div class="mt-16 pt-10 border-t border-gray-100">
                <h2 class="text-lg font-black text-gray-900 mb-6">À lire aussi</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach ($related as $article)
                        <a href="{{ route('blog.show', $article) }}" class="block bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-md transition-all">
                            <p class="text-[10px] font-bold uppercase text-indigo-500 mb-2">{{ $article->category }}</p>
                            <p class="text-sm font-bold text-gray-900 leading-snug">{{ $article->title }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
