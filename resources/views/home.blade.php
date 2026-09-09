{{--
    Page d'accueil publique. Chaque section visuelle est déléguée à une vue
    dédiée sous resources/views/home/ — voir le commentaire en tête de
    chaque partial pour les variables qu'il attend.

    Variables reçues du contrôleur (HomeController::index) :
    - $heroCreatifs   Collection  Créatifs avec photo, pour les grappes du hero.
    - $creatifCount   int         Nombre de créatifs actifs (compteur social proof).
    - $projects       Collection  Projets récents.
    - $creatifs       Collection  Créatifs mis en avant.
    - $testimonials   Collection  Témoignages publiés (peut être vide).
--}}
<x-app-layout>
    @include('home.hero')
    @include('home.avantages')
    @include('home.benefits')
    @include('home.steps')
    @include('home.recent-projects')
    @include('home.talents')
    @include('home.testimonials')
    @include('home.faq-cta')
</x-app-layout>
