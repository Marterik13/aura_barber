<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\User;

class BarberShopSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Services
        $services = [
            ['name' => 'Corte Clásico', 'price' => 15.00, 'duration' => 30, 'description' => 'Corte de cabello tradicional.'],
            ['name' => 'Corte y Barba', 'price' => 25.00, 'duration' => 45, 'description' => 'Corte de cabello más arreglo de barba con toalla caliente.'],
            ['name' => 'Perfilado de Barba', 'price' => 10.00, 'duration' => 20, 'description' => 'Alineación y perfilado de barba.'],
            ['name' => 'Colorimetría', 'price' => 40.00, 'duration' => 60, 'description' => 'Tintes y decoloraciones.'],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(['name' => $svc['name']], $svc);
        }

        // 2. Create a Specialist (Requires a User first, we can use the admin or create a new Staff user)
        $staffUser = User::updateOrCreate(
            ['email' => 'barber@aura.com'],
            [
                'name' => 'Carlos Barber',
                'password' => bcrypt('12345678'),
                'id_number' => 'BRB-001',
                'phone' => '1231231234',
                'address' => 'Local Aura',
                'email_verified_at' => now(),
            ]
        );
        $staffUser->assignRole('Staff');

        Specialist::updateOrCreate(
            ['user_id' => $staffUser->id],
            [
                'specialty' => 'Master Barber',
                'bio' => 'Especialista en cortes modernos y clásicos con 5 años de experiencia.'
            ]
        );
    }
}
