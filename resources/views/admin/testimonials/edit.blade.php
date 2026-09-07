<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Modifier le témoignage</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}">
        @method('PUT')
        @include('admin.testimonials._form')
    </form>
</x-admin-layout>
