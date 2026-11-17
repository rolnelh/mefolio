<?php

/*
|--------------------------------------------------------------------------
| Réglages éditoriaux de Mefolio
|--------------------------------------------------------------------------
|
| Contenus mis en avant sur le site qui ne viennent pas de la base de
| données. Modifier ce fichier puis redéployer suffit pour les changer
| (pas de migration). En production, `config:cache` est lancé au
| démarrage du conteneur : la nouvelle valeur est prise au déploiement.
|
*/

return [

    /*
    | Projets mis en avant dans la section "Projets récents" de l'accueil
    | (resources/views/home/recent-projects.blade.php). Ils s'affichent en
    | premier, puis les projets récents de la base complètent la grille
    | jusqu'à 6 cartes.
    |
    | - titre, sous_titre : texte sous l'image (sous_titre en gris).
    | - etiquettes        : deux étiquettes au plus, encoche en haut à droite.
    | - image             : chemin relatif à public/.
    | - url               : lien de la carte ; null mène à la galerie des
    |                       projets.
    */
    'projets_vedette' => [
        [
            'titre' => 'Baobab',
            'sous_titre' => 'Site vitrine · Bandes dessinées',
            'etiquettes' => ['Site vitrine', 'UI design'],
            'image' => 'images/projets/baobab.webp',
            'url' => null,
        ],
        [
            'titre' => 'Fiacre Studio',
            'sous_titre' => 'Portfolio photographe · Maquette et développement',
            'etiquettes' => ['Next.js', 'Tailwind CSS'],
            'image' => 'images/projets/fiacre-studio.webp',
            'url' => null,
        ],
        [
            'titre' => 'Les gourmandises de Milka',
            'sous_titre' => 'Site de commande · Desktop et mobile',
            'etiquettes' => ['Site vitrine', 'Responsive'],
            'image' => 'images/projets/milka.webp',
            'url' => null,
        ],
        [
            'titre' => 'Forma',
            'sous_titre' => 'Produits digitaux · Landing page',
            'etiquettes' => ['Landing page', 'UI design'],
            'image' => 'images/projets/forma.webp',
            'url' => null,
        ],
        [
            'titre' => 'Post',
            'sous_titre' => 'Application mobile · Onboarding',
            'etiquettes' => ['UI mobile', 'Concept'],
            'image' => 'images/projets/post.webp',
            'url' => null,
        ],
    ],

];
