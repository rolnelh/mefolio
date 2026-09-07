<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Nouveau challenge</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.challenges.store') }}">
        @include('admin.challenges._form')
    </form>
</x-admin-layout>
