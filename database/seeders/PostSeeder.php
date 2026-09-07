<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Articles de référence, publiés par l'équipe Mefolio, pour que le blog
     * ne soit pas vide tant que la communauté n'a pas encore contribué.
     * Sans auteur individuel : ils s'affichent sous "Équipe Mefolio".
     */
    public function run(): void
    {

        $posts = [
            [
                'title' => "Comment construire un portfolio qui donne envie de vous recruter",
                'category' => 'Conseils',
                'excerpt' => "Un bon portfolio ne montre pas tout ce que vous savez faire : il montre ce que vous savez faire de mieux. Voici comment le construire.",
                'body' => "Un portfolio n'est pas une archive : c'est une vitrine. Beaucoup de créatifs débutants commettent la même erreur — ils y déposent tout ce qu'ils ont produit, dans l'espoir que la quantité impressionnera. C'est l'inverse qui se produit : un portfolio surchargé dilue vos meilleurs travaux.\n\nCommencez par sélectionner 4 à 6 projets maximum, ceux qui représentent le mieux le type de mission que vous voulez décrocher demain — pas celles d'il y a trois ans. Pour chaque projet, expliquez le contexte : quel était le besoin du client, quelles contraintes aviez-vous, quel a été votre rôle exact.\n\nSur Mefolio, votre profil créatif fait office de portfolio public : photo, spécialité, bio et projets liés à votre compte. Prenez le temps de le compléter entièrement — un profil incomplet donne l'impression d'un travail inachevé, même quand vos réalisations sont excellentes.\n\nEnfin, mettez-le à jour régulièrement. Un portfolio figé depuis un an raconte une histoire qui s'arrête là. Ajoutez vos projets récents dès qu'ils sont terminés et présentables.",
                'reading_minutes' => 4,
            ],
            [
                'title' => "Fixer ses tarifs en tant que créatif freelance en Afrique",
                'category' => 'Freelance',
                'excerpt' => "Trop bas, vous vous épuisez. Trop haut sans le justifier, vous perdez des clients. Quelques repères pour trouver le bon prix.",
                'body' => "La question du tarif revient dans presque toutes les discussions entre créatifs freelances. Il n'y a pas de grille magique valable partout en Afrique — les réalités économiques varient énormément d'un pays à l'autre — mais quelques principes aident à ne pas se sous-évaluer.\n\nD'abord, ne facturez jamais uniquement votre temps : facturez la valeur que votre travail apporte au client. Un logo qui structure toute l'identité visuelle d'une entreprise vaut plus que les deux heures passées à le dessiner.\n\nEnsuite, renseignez-vous sur ce que facturent d'autres créatifs de votre spécialité et de votre niveau d'expérience, dans votre pays et dans la sous-région. Les missions publiées sur Mefolio sont une bonne source pour observer les budgets réels proposés par les clients.\n\nPensez aussi à distinguer clairement ce qui est inclus dans votre tarif (nombre de révisions, délais, formats livrés) pour éviter les malentendus qui rongent la rentabilité d'une mission. Un tarif clair et un périmètre bien défini valent mieux qu'un prix bas suivi de demandes illimitées.\n\nEnfin, augmentez vos tarifs progressivement à mesure que votre expérience et votre demande augmentent. Rester au même prix pendant des années, même en progressant, revient à se payer de moins en moins cher avec le temps.",
                'reading_minutes' => 5,
            ],
            [
                'title' => "Payer et se faire payer en Mobile Money : ce qu'il faut savoir",
                'category' => 'Guides',
                'excerpt' => "MTN, Moov, Wave... le Mobile Money est devenu le mode de paiement de référence pour beaucoup de créatifs africains. Petit guide pratique.",
                'body' => "Pour une grande partie des créatifs et des clients en Afrique de l'Ouest, le Mobile Money est plus simple et plus rapide qu'un virement bancaire classique. Pas besoin de compte bancaire, les fonds sont disponibles presque instantanément, et les frais restent généralement raisonnables pour de petits montants.\n\nQuelques bonnes pratiques avant d'accepter un paiement par Mobile Money pour une mission : convenez du montant exact et de la devise avant de commencer le travail, gardez une trace écrite de l'accord (message, email, ou description de mission sur Mefolio), et vérifiez la confirmation de réception avant de livrer le travail final si vous demandez un acompte.\n\nCôté client, le même principe s'applique : ne réglez le solde qu'une fois le livrable reçu et conforme à ce qui était convenu.\n\nMefolio prévoit d'intégrer le paiement en Mobile Money directement sur la plateforme pour les futures commandes de services — vous pouvez suivre l'avancement de cette fonctionnalité sur la page Services.",
                'reading_minutes' => 3,
            ],
            [
                'title' => "Pourquoi participer à un hackathon peut changer votre trajectoire",
                'category' => 'Opportunités',
                'excerpt' => "Au-delà du prix à gagner, un hackathon ou un programme d'accompagnement peut ouvrir des portes qu'un portfolio seul n'ouvre pas.",
                'body' => "Un hackathon n'est pas seulement une compétition avec un prix à la clé. C'est un accélérateur de réseau : en 48 heures, vous rencontrez d'autres créatifs, des mentors et parfois des recruteurs ou investisseurs que vous n'auriez pas croisés autrement.\n\nC'est aussi un excellent terrain d'entraînement. Travailler sous contrainte de temps, avec une équipe qu'on ne connaît pas forcément, force à prioriser l'essentiel et à livrer un résultat concret rapidement — une compétence directement transférable aux missions freelances.\n\nEn Afrique, plusieurs programmes structurés existent pour accompagner les talents sur la durée, bien au-delà d'un simple week-end de compétition : des cités de l'innovation comme Sèmè City au Bénin, jusqu'aux grands programmes panafricains de financement comme celui de la Fondation Tony Elumelu. Chacun a ses propres critères et son propre calendrier de candidature.\n\nLa page Programmes & Hackathons de Mefolio centralise ces opportunités pour vous éviter de les chercher une par une. Consultez-la régulièrement : de nouveaux programmes y sont ajoutés au fil du temps.",
                'reading_minutes' => 4,
            ],
        ];

        foreach ($posts as $index => $post) {
            Post::updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                $post + [
                    'slug' => Str::slug($post['title']),
                    'status' => 'published',
                    'published_at' => now()->subDays(($index + 1) * 5),
                ]
            );
        }
    }
}
