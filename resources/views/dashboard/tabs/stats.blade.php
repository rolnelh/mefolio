{{--
    Onglet "Stats" — vue condensée des statistiques (analytics détaillées
    pas encore livrées). Variables attendues : $projects, $creatif,
    $totalLikes, $totalComments.
--}}
<h2 class="text-lg font-black text-gray-900 mb-5">Statistiques</h2>
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    @foreach ([['label' => 'Projets publiés', 'val' => count($projects)], ['label' => 'Builder Score', 'val' => number_format($creatif->builder_score ?? 0)], ['label' => 'Likes reçus', 'val' => $totalLikes], ['label' => 'Commentaires', 'val' => $totalComments], ['label' => 'Vues du profil', 'val' => number_format($creatif->profile_views ?? 0)]] as $stat)
        <div class="bg-white border border-gray-100 rounded-2xl p-5 text-center">
            <div class="text-3xl font-black text-gray-900">{{ $stat['val'] }}</div>
            <div class="text-xs text-gray-400 mt-1">{{ $stat['label'] }}</div>
        </div>
    @endforeach
</div>
<div
    class="bg-gradient-to-r from-indigo-50 to-violet-50 border border-indigo-100 rounded-2xl p-6 text-center">
    <h3 class="font-bold text-gray-900 mb-1">Analytics détaillées bientôt</h3>
    <p class="text-sm text-gray-500">Vues par projet, provenance géographique, performance,
        tout ça arrive très bientôt.</p>
</div>
