<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SeedOnce extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:seed-once';

    /**
     * The console command description.
     */
    protected $description = 'Run the database seeders only on a truly empty database (first deploy)';

    /**
     * Lance les seeders uniquement si la base est vide.
     *
     * Le conteneur redémarre régulièrement (déploiements, veille sur les
     * plans gratuits...) et exécuter `db:seed --force` à chaque démarrage
     * ressuscitait les profils/contenus de démonstration qu'un administrateur
     * avait volontairement supprimés depuis le dashboard admin. Les seeders
     * ne doivent tourner qu'une seule fois, au tout premier démarrage.
     */
    public function handle(): int
    {
        if (User::query()->exists()) {
            $this->info('Base de données déjà initialisée — seeders ignorés.');

            return self::SUCCESS;
        }

        $this->info('Base de données vide — exécution des seeders (premier démarrage).');

        return $this->call('db:seed', ['--force' => true]);
    }
}
