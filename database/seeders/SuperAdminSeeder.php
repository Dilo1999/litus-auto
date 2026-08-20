<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Seed the super admin user for the CRM (Filament).
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => User::SUPER_ADMIN_EMAIL],
            [
                'name' => 'Super Admin',
                'password' => '12345678',
                'role' => User::ROLE_ADMIN,
            ]
        );
    }
}
