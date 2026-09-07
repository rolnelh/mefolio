<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Nouveau programme</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.programs.store') }}">
        @include('admin.programs._form')
    </form>
</x-admin-layout>
