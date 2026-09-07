<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-black text-gray-900 mb-8">Modifier la mission</h1>

        <div class="bg-white border border-gray-100 rounded-3xl p-8">
            <form method="POST" action="{{ route('missions.update', $mission) }}">
                @method('PUT')
                @include('missions._form')
            </form>
        </div>
    </div>
</x-app-layout>
