<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    /**
     * Programmes et hackathons africains de référence, affichés sur la page
     * "Programmes & Hackathons" tant que la communauté n'en a pas soumis d'autres.
     */
    public function run(): void
    {
        $programs = [
            [
                'name' => 'ASSIN',
                'full_name' => "Agence du Service Civique National de l'Innovation",
                'country' => 'Bénin',
                'type' => 'Programme annuel',
                'description' => "L'Agence du Service Civique National de l'Innovation (ASSIN) accompagne les jeunes entrepreneurs béninois à travers des programmes d'incubation, de financement et de formation pour transformer leurs idées en startups viables.",
                'tags' => ['Entrepreneuriat', 'Innovation', 'Tech', 'Financement', 'Incubation'],
                'featured' => true,
            ],
            [
                'name' => 'Sèmè City',
                'full_name' => "Cité de l'innovation et du savoir",
                'country' => 'Bénin',
                'type' => 'Programme continu',
                'description' => "Cité de l'innovation et du savoir du Bénin, Sèmè City est un écosystème unique qui réunit créateurs, chercheurs et entrepreneurs africains pour co-construire l'avenir du continent à travers des résidences, labs et programmes d'accélération.",
                'tags' => ['Innovation', 'Résidence', 'Créativité', 'Recherche', 'Afrique'],
                'url' => 'https://semecity.bj',
                'featured' => true,
            ],
            [
                'name' => 'SENUM',
                'full_name' => 'Semaine du Numérique',
                'country' => 'Bénin',
                'type' => 'Événement annuel',
                'description' => 'La grande semaine nationale dédiée au numérique au Bénin — conférences, hackathons, expositions tech.',
                'tags' => ['Numérique', 'Tech', 'Hackathon'],
            ],
            [
                'name' => 'Talents4Startup',
                'full_name' => 'From Bénin to the World',
                'country' => 'Bénin',
                'type' => "Programme d'accélération",
                'description' => "Programme d'accompagnement des jeunes entrepreneurs béninois vers les marchés internationaux.",
                'tags' => ['Startup', 'Mentoring', 'International'],
            ],
            [
                'name' => 'Tony Elumelu',
                'full_name' => 'TEF Entrepreneurship Programme',
                'country' => 'Panafricain',
                'type' => 'Financement panafricain',
                'description' => 'Le plus grand programme philanthropique dédié aux entrepreneurs africains — 5 000 $ de financement de départ.',
                'tags' => ['Financement', 'Panafricain', '5000 USD'],
                'url' => 'https://www.tefconnect.com',
                'featured' => true,
            ],
            [
                'name' => 'Epitech Bénin',
                'full_name' => "École de l'innovation et de l'expertise informatique",
                'country' => 'Bénin',
                'type' => 'École / Formation',
                'description' => "Campus béninois du réseau Epitech, école d'informatique et d'innovation qui forme aux métiers du numérique par la pédagogie par projets.",
                'tags' => ['Formation', 'Tech', 'Numérique', 'Éducation'],
                'featured' => true,
            ],
            [
                'name' => 'Orange Fab',
                'full_name' => 'Orange Digital Center',
                'country' => 'Panafricain',
                'type' => 'Accélérateur',
                'description' => "Programme d'accélération pour startups tech en Afrique subsaharienne avec accompagnement Orange.",
                'tags' => ['Tech', 'Accélération', 'Mobile'],
            ],
            [
                'name' => 'CTIC Dakar',
                'full_name' => 'Centre TIC Sénégal',
                'country' => 'Sénégal',
                'type' => 'Incubateur',
                'description' => "Premier incubateur de startups numériques en Afrique de l'Ouest, basé à Dakar.",
                'tags' => ['Sénégal', 'Incubation', 'Afrique de l\'Ouest'],
            ],
            [
                'name' => 'iHub Nairobi',
                'full_name' => 'Innovation Hub',
                'country' => 'Kenya',
                'type' => 'Hub tech',
                'description' => "Le hub technologique le plus influent d'Afrique de l'Est, berceau de nombreuses startups du continent.",
                'tags' => ['Kenya', 'Hub', "Afrique de l'Est"],
            ],
        ];

        foreach ($programs as $program) {
            Program::updateOrCreate(
                ['slug' => Str::slug($program['name'])],
                $program + ['slug' => Str::slug($program['name']), 'status' => 'active']
            );
        }
    }
}
