<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Crear roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);

        // Crear o actualizar usuario Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
            ]
        );
        $admin->assignRole($adminRole);

        // Crear o actualizar usuario Super Admin
        $superadmin = User::updateOrCreate(
            ['email' => 'superadmin@superadmin.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('superadmin123'),
            ]
        );
        $superadmin->assignRole($superadminRole);
    }
}
