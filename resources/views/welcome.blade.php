<x-app-layout>

    <body class="antialiased">

        @if (Route::has('login'))
            @auth
                @include('layouts.navigation')
            @else
                @include('layouts.navigation')
            @endauth
        @endif

        <!-- CONTENU PRINCIPAL -->
        <main class="max-w-7xl mx-auto p-6 mt-16">
            <!-- Contenu welcome ou autre ici -->
        </main>

    </body>
</x-app-layout>
