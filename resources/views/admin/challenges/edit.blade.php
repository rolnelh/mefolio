<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Modifier le challenge</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.challenges.update', $challenge) }}">
        @method('PUT')
        @include('admin.challenges._form')
    </form>
</x-admin-layout>
