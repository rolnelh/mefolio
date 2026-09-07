@props(['title' => 'Soyez notifié en premier', 'description' => 'Laissez votre email pour être alerté des nouveautés Mefolio.', 'source' => 'site'])

<div class="mt-12 bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-8 md:p-10 text-center text-white">
    <h2 class="text-xl md:text-2xl font-black mb-2">{{ $title }}</h2>
    <p class="text-indigo-200 text-sm mb-6 max-w-lg mx-auto">{{ $description }}</p>
    <form method="POST" action="{{ route('newsletter.store') }}" class="flex gap-3 max-w-sm mx-auto">
        @csrf
        <input type="hidden" name="source" value="{{ $source }}">
        <input type="email" name="email" required placeholder="votre@email.com"
            class="flex-1 px-4 py-3 rounded-xl text-gray-900 text-sm focus:outline-none">
        <button type="submit"
            class="bg-white text-indigo-600 font-bold px-5 py-3 rounded-xl hover:bg-indigo-50 transition whitespace-nowrap text-sm">
            M'alerter
        </button>
    </form>
</div>
