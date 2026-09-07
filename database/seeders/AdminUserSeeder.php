<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Crée (ou promeut) le compte administrateur par défaut de la plateforme.
     */
    public function run(): void
    {
        $email = env('MEFOLIO_ADMIN_EMAIL', 'koudadjefiacre09@gmail.com');

        $admin = User::where('email', $email)->first();

        if ($admin) {
            $admin->update(['role' => User::ROLE_ADMIN]);
            return;
        }

        User::create([
            'username' => 'admin',
            'email' => $email,
            'password' => Hash::make(env('MEFOLIO_ADMIN_PASSWORD', 'ChangeMe!2026')),
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);
    }
}
