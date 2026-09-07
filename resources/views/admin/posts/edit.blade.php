<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Modifier l'article</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @method('PUT')
        @include('admin.posts._form')
    </form>
</x-admin-layout>
