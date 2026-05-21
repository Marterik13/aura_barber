<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir roles - Asegúrate de que 'Admin' esté en la lista
        $roles = [
            'Administrador',
            'Cliente',
            'Sin rol',
            'Estilista',
            'Barbero',
            'Mixto'
        ];

        // Crear roles de forma segura
        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web' // Es mejor especificar el guard por seguridad
            ]);
        }
    }
}