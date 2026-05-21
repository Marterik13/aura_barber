<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Create Admin Aura user
        User::updateOrCreate(
            ['email' => 'admin@aura.com'],
            [
                'name' => 'Admin Aura',
                'password' => bcrypt('12345678'),
                'id_number' => 'ADM-001',
                'phone' => '1234567890',
                'address' => 'Aura Shop HQ',
                'email_verified_at' => now(),
            ]
        )->assignRole('Administrador');

        // Create second admin user
        User::updateOrCreate(
            ['email' => 'admin2@aura.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('12345678'),
                'id_number' => 'ADM-002',
                'phone' => '1234567890',
                'address' => 'Aura Shop HQ',
                'email_verified_at' => now(),
            ]
        )->assignRole('Administrador');
    }
}