<?php

namespace Database\Seeders;

use App\Models\Creatif;
use App\Models\User;
use App\Services\BuilderScoreService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreatifSeeder extends Seeder
{
    /**
     * Quelques profils créatifs de référence, pour que les pages Explorer /
     * Créatifs ne soient pas vides tant que la communauté n'a pas encore
     * rejoint la plateforme en nombre. Comptes marqués comme tels, sans
     * statistiques ou photos fictives : avatar généré à partir des initiales.
     */
    public function run(): void
    {
        $profils = [
            [
                'username' => 'aisha.designs',
                'email' => 'aisha.demo@mefolio.com',
                'prenom' => 'Aisha',
                'nom' => 'Bello',
                'specialite' => 'Design & Identité visuelle',
                'localisation' => 'Lagos, Nigeria',
                'bio' => "Designer graphique spécialisée dans l'identité de marque pour des startups africaines. J'aime construire des univers visuels simples et mémorables.",
                'builder_score' => 420,
            ],
            [
                'username' => 'kwame.codes',
                'email' => 'kwame.demo@mefolio.com',
                'prenom' => 'Kwame',
                'nom' => 'Mensah',
                'specialite' => 'Développement Web',
                'localisation' => 'Accra, Ghana',
                'bio' => "Développeur full-stack. Je construis des sites et applications web rapides et accessibles pour des clients à travers l'Afrique de l'Ouest.",
                'builder_score' => 610,
            ],
            [
                'username' => 'fatou.lens',
                'email' => 'fatou.demo@mefolio.com',
                'prenom' => 'Fatou',
                'nom' => 'Diop',
                'specialite' => 'Photographie',
                'localisation' => 'Dakar, Sénégal',
                'bio' => "Photographe portrait et événementiel. Je capture des histoires africaines en images, du studio aux mariages en extérieur.",
                'builder_score' => 260,
            ],
            [
                'username' => 'kofi.motion',
                'email' => 'kofi.demo@mefolio.com',
                'prenom' => 'Kofi',
                'nom' => 'Adjei',
                'specialite' => 'Vidéo & Montage',
                'localisation' => 'Cotonou, Bénin',
                'bio' => "Monteur vidéo et motion designer. Publicités, clips et contenus pour les réseaux sociaux, pensés pour capter l'attention en quelques secondes.",
                'builder_score' => 340,
            ],
        ];

        $scoreService = new BuilderScoreService();

        foreach ($profils as $profil) {
            $user = User::firstOrCreate(
                ['email' => $profil['email']],
                [
                    'username' => $profil['username'],
                    'password' => Hash::make(Str::random(40)),
                    'role' => User::ROLE_CREATIF,
                    'email_verified_at' => now(),
                ]
            );

            $level = $scoreService->getLevel(new Creatif(['builder_score' => $profil['builder_score']]));

            Creatif::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'prenom' => $profil['prenom'],
                    'nom' => $profil['nom'],
                    'specialite' => $profil['specialite'],
                    'localisation' => $profil['localisation'],
                    'bio' => $profil['bio'],
                    'builder_score' => $profil['builder_score'],
                    'builder_level' => $level['slug'],
                    'available_for_work' => true,
                    'is_paused' => false,
                ]
            );
        }
    }
}
