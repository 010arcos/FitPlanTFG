<?php

namespace Database\Seeders;


use Database\Seeders\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // Llamar a los seeders personalizados con y magia jejej php artisan migrate:refresh --seed 
        $this->call([
            UsersTableSeeder::class,
            EjerciciosTableSeeder::class,
            DietasTableSeeder::class,
            ComidasTableSeeder::class,
            PivotDietaComidaSeeder::class,
            PivotUsuarioDietaSeeder::class,
            RutinaTableSeeder::class,
            PivotRutinaUsuarioSeeder::class,
            EjerciciosTableSeeder::class,
            PivotRutinaEjerciciosSeeder::class,



        ]);
    }
}
