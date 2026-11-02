{{--
    Liens de navigation desktop (Explorer / Missions / Challenges /
    Communauté). Chaque menu déroulant est un méga-menu x-nav-mega : liens
    à gauche (x-nav-mega-link, regroupés sous un petit intitulé de section),
    cartes illustrées à droite (x-nav-mega-card, images dans
    public/images/*-menu.webp). Chaque menu a son propre x-data local, pas
    de state partagé. Aucune variable externe requise.
--}}
@php
    $sectionMenu = 'px-3 mb-1 text-[10px] font-bold text-gray-400 uppercase tracking-wider';
@endphp
<div class="hidden lg:flex items-center gap-1">

    {{-- Explorer --}}
    <x-nav-mega :label="__('Explorer')">
        <x-slot:liens>
            <div>
                <p class="{{ $sectionMenu }}">{{ __('Découvrir') }}</p>
                <x-nav-mega-link :href="route('projects.index')">{{ __('Projets créatifs') }}</x-nav-mega-link>
                <x-nav-mega-link :href="route('creatifs.index')">{{ __('Tous les créatifs') }}</x-nav-mega-link>
            </div>
            <div>
                <p class="{{ $sectionMenu }}">{{ __('Reconnaissance') }}</p>
                <x-nav-mega-link :href="route('classement.index')">{{ __('Classement') }}</x-nav-mega-link>
                <x-nav-mega-link :href="route('talentoftheweek.index')">Talent of the Week</x-nav-mega-link>
            </div>
        </x-slot:liens>

        <x-nav-mega-card :href="route('projects.index')" :image="asset('images/cover_photo.jpeg')"
            :title="__('Projets créatifs')"
            :description="__('Parcourez les dernières réalisations de la communauté : design, code, vidéo, photo.')" />
        <x-nav-mega-card :href="route('talentoftheweek.index')" :image="asset('images/talentoftheweek-menu.webp')"
            title="Talent of the Week"
            :description="__('Chaque semaine, un créatif mis à l\'honneur pour son travail.')" />
    </x-nav-mega>

    {{-- Missions & services --}}
    <x-nav-mega :label="__('Missions')">
        <x-slot:liens>
            <div>
                <p class="{{ $sectionMenu }}">{{ __('Freelance') }}</p>
                <x-nav-mega-link :href="route('missions.index')">{{ __('Trouver des missions') }}</x-nav-mega-link>
            </div>
            <div>
                <p class="{{ $sectionMenu }}">{{ __('Gérer') }}</p>
                @auth
                    <x-nav-mega-link :href="route('missions.create')">{{ __('Publier une mission') }}</x-nav-mega-link>
                    <x-nav-mega-link :href="route('missions.mine')">{{ __('Mes missions') }}</x-nav-mega-link>
                @endauth
                <x-nav-mega-link :href="route('services.index')" :badge="__('Bientôt')" muted>{{ __('Services') }}</x-nav-mega-link>
            </div>
        </x-slot:liens>

        <x-nav-mega-card :href="route('missions.index')" :image="asset('images/designer-menu.webp')"
            :title="__('Trouver des missions')"
            :description="__('Des missions freelance rémunérées, publiées par des entreprises qui cherchent des créatifs.')" />
        <x-nav-mega-card :href="route('services.index')" :image="asset('images/vision-menu.webp')"
            :title="__('Services')"
            :description="__('Bientôt : commandez directement des services créatifs auprès des talents Mefolio.')" />
    </x-nav-mega>

    {{-- Challenges --}}
    <a href="{{ route('challenges.index') }}"
        class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-950 rounded-full hover:bg-gray-50 transition-all">
        Challenges
    </a>

    {{-- Communauté --}}
    <x-nav-mega :label="__('Communauté')">
        <x-slot:liens>
            <div>
                <p class="{{ $sectionMenu }}">{{ __('Contenu') }}</p>
                <x-nav-mega-link :href="route('blog')">Blog</x-nav-mega-link>
                <x-nav-mega-link :href="route('hackathons.index')">{{ __('Programmes & Hackathons') }}</x-nav-mega-link>
            </div>
            <div>
                <p class="{{ $sectionMenu }}">{{ __('À propos') }}</p>
                <x-nav-mega-link href="mailto:contact@mefolio.com">{{ __('Nous contacter') }}</x-nav-mega-link>
            </div>
        </x-slot:liens>

        <x-nav-mega-card :href="route('hackathons.index')" :image="asset('images/challenges-menu.webp')"
            :title="__('Programmes & Hackathons')"
            :description="__('ASSIN, Sèmè City et d\'autres programmes pour accélérer votre parcours.')" />
        <x-nav-mega-card :href="route('blog')" :image="asset('images/profil-menu.webp')"
            title="Blog"
            :description="__('Actualités, portraits et inspiration pour les créatifs africains.')" />
    </x-nav-mega>

</div>
