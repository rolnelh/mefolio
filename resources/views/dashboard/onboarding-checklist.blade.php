{{--
    Carte de progression "Configurez votre espace créatif", affichée en haut
    du tableau de bord sur TOUS les onglets tant que le profil n'est pas à
    100% (voir la condition `$pourcentage < 100` autour de l'@include dans
    dashboard.blade.php) — ce n'est pas propre à l'onglet "Projets".

    Variables attendues (calculées dans dashboard.blade.php) :
    - $etapes       array{profil: bool, projet: bool}  État de chaque étape.
    - $progression  int  Nombre d'étapes complétées.
    - $total        int  Nombre total d'étapes.
    - $pourcentage  float  Pourcentage de complétion (0-100).
--}}
<div class="bg-gradient-to-r from-indigo-50 to-violet-50 border border-indigo-100 rounded-2xl p-5">
    <div class="flex items-center justify-between mb-3">
        <div>
            <h3 class="text-sm font-bold text-gray-900">Configurez votre espace créatif</h3>
            <p class="text-xs text-gray-500 mt-0.5">{{ $progression }}/{{ $total }}
                étapes complétées</p>
        </div>
        <span class="text-xl font-extrabold text-indigo-600">{{ (int) $pourcentage }}%</span>
    </div>
    <div class="w-full bg-white rounded-full h-1.5 mb-4 overflow-hidden">
        <div class="bg-indigo-600 h-1.5 rounded-full transition-all duration-500"
            style="width: {{ $pourcentage }}%"></div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <a href="{{ route('creatifs.create') }}"
            class="flex items-center gap-3 p-3 bg-white rounded-xl border {{ $etapes['profil'] ? 'border-green-200' : 'border-indigo-200 hover:border-indigo-400' }} transition-all">
            <div
                class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 {{ $etapes['profil'] ? 'bg-green-100 text-green-600' : 'bg-indigo-100 text-indigo-600' }}">
                @if ($etapes['profil'])
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p
                    class="text-xs font-semibold {{ $etapes['profil'] ? 'text-green-700' : 'text-gray-900' }}">
                    {{ $etapes['profil'] ? ' Profil complété' : 'Compléter mon profil' }}
                </p>
                <p class="text-[11px] text-gray-400">Photo, bio, spécialité, localisation</p>
            </div>
        </a>
        <a href="{{ $etapes['profil'] ? route('projets.create') : '#' }}"
            class="flex items-center gap-3 p-3 bg-white rounded-xl border {{ $etapes['projet'] ? 'border-green-200' : 'border-indigo-200' }} transition-all {{ !$etapes['profil'] ? 'opacity-50 cursor-not-allowed' : 'hover:border-indigo-400' }}">
            <div
                class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 {{ $etapes['projet'] ? 'bg-green-100 text-green-600' : 'bg-indigo-100 text-indigo-600' }}">
                @if ($etapes['projet'])
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p
                    class="text-xs font-semibold {{ $etapes['projet'] ? 'text-green-700' : 'text-gray-900' }}">
                    {{ $etapes['projet'] ? ' Premier projet ajouté' : 'Ajouter mon premier projet' }}
                </p>
                <p class="text-[11px] text-gray-400">
                    {{ !$etapes['profil'] ? 'Complétez d\'abord votre profil' : 'Partagez votre première réalisation' }}
                </p>
            </div>
        </a>
    </div>
</div>
