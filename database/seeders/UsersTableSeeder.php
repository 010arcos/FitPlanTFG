<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        // Obtener los roles ya creados
        $adminRole = Role::findByName('admin');
        $userRole = Role::findByName('user');

        // ADMIN
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123'),
            'apellido' => 'Administrador',
            'genero' => 'otro',
            'edad' => 30,
            'altura' => 1.75,
            'peso' => 70,
            'activo' => false,
        ]);
        // Asignar el rol admin al primer usuario
        $admin->assignRole($adminRole);

        // Crear usuario 2
        $user2 = User::create([
            'name' => 'Marco Arcos',
            'email' => 'marco1arcos@gmail.com',
            'password' => Hash::make('123'),
            'apellido' => 'Pérez',
            'genero' => 'Masculino',
            'edad' => 25,
            'altura' => 1.80,
            'peso' => 75,
            'activo' => false,
        ]);
        // Asignar el rol user a este usuario
        $user2->assignRole($userRole);

        // Crear usuario 3
        $user3 = User::create([
            'name' => 'María Gómez',
            'email' => 'maria@example.com',
            'password' => Hash::make('123'),
            'apellido' => 'Gómez',
            'genero' => 'Femenino',
            'edad' => 28,
            'altura' => 1.65,
            'peso' => 60,
            'activo' => false,
        ]);
        // Asignar el rol user a este usuario
        $user3->assignRole($userRole);

        // Crear usuario 4
        $user4 = User::create([
            'name' => 'Carlos Rodríguez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('car12345'),
            'apellido' => 'Rodríguez',
            'genero' => 'Masculino',
            'edad' => 35,
            'altura' => 1.70,
            'peso' => 80,
            'activo' => false,
        ]);
        // Asignar el rol user a este usuario
        $user4->assignRole($userRole);

        // Crear usuario 5
        $user5 = User::create([
            'name' => 'Laura Martínez',
            'email' => 'laura@example.com',
            'password' => Hash::make('laura123'),
            'apellido' => 'Martínez',
            'genero' => 'Femenino',
            'edad' => 22,
            'altura' => 1.60,
            'peso' => 55,
            'activo' => false,
        ]);
        // Asignar el rol user a este usuario
        $user5->assignRole($userRole);
    }
}
