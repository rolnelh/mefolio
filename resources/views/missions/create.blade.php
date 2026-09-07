<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-black text-gray-900 mb-2">Publier une mission</h1>
        <p class="text-sm text-gray-500 mb-8">Décrivez votre besoin, les créatifs de Mefolio pourront y postuler.</p>

        <div class="bg-white border border-gray-100 rounded-3xl p-8">
            <form method="POST" action="{{ route('missions.store') }}">
                @include('missions._form')
            </form>
        </div>
    </div>
</x-app-layout>
