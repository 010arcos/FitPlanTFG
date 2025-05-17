<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotUsuarioDietaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asignar dietas altas y sus alternativas a los usuarios
        DB::table('pivot_usuario_dieta')->insert([

            // Usuario 1 asignado a dietas altas y sus alternativas
            [
                'id_usuario' => 2, // Usuario 1 (Admin)
                'id_dieta' => 1,   // Dieta Alta en Proteínas
            ],
            [
                'id_usuario' => 2, // Usuario 1
                'id_dieta' => 2,   // Dieta Alta en Proteínas Variante 1
            ],
            [
                'id_usuario' => 2, // Usuario 1
                'id_dieta' => 3,   // Dieta Alta en Proteínas Variante 2
            ],
            [
                'id_usuario' => 2, // Usuario 1
                'id_dieta' => 4,   // Dieta Alta en Proteínas Variante 3
            ],

            // Usuario 2 asignado a dietas bajas y sus alternativas
            [
                'id_usuario' => 3, // Usuario 2
                'id_dieta' => 5,   // Dieta Baja en Carbohidratos
            ],
            [
                'id_usuario' => 3, // Usuario 2
                'id_dieta' => 6,   // Dieta Baja en Carbohidratos Variante 1
            ],
            [
                'id_usuario' => 3, // Usuario 2
                'id_dieta' => 7,   // Dieta Baja en Carbohidratos Variante 2
            ],
            [
                'id_usuario' => 3, // Usuario 2
                'id_dieta' => 8,   // Dieta Baja en Carbohidratos Variante 3
            ],

            // Usuario 3 asignado a dietas mediterráneas y sus alternativas
            [
                'id_usuario' => 4, // Usuario 3
                'id_dieta' => 9,   // Dieta Mediterránea
            ],
            [
                'id_usuario' => 4, // Usuario 3
                'id_dieta' => 10,  // Dieta Mediterránea Variante 1
            ],
            [
                'id_usuario' => 4, // Usuario 3
                'id_dieta' => 11,  // Dieta Mediterránea Variante 2
            ],
            [
                'id_usuario' => 4, // Usuario 3
                'id_dieta' => 12,  // Dieta Mediterránea Variante 3
            ],

            // Usuario 4 asignado a dietas vegetarianas y sus alternativas
            [
                'id_usuario' => 5, // Usuario 4
                'id_dieta' => 13,  // Dieta Vegetariana
            ],
            [
                'id_usuario' => 5, // Usuario 4
                'id_dieta' => 14,  // Dieta Vegetariana Variante 1
            ],
            [
                'id_usuario' => 5, // Usuario 4
                'id_dieta' => 15,  // Dieta Vegetariana Variante 2
            ],
            [
                'id_usuario' => 5, // Usuario 4
                'id_dieta' => 16,  // Dieta Vegetariana Variante 3
            ],

           
        ]);
    }
}