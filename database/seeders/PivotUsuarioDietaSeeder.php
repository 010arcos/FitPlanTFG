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
        // Asignar dietas a los usuarios (omitiendo al admin)
        DB::table('pivot_usuario_dieta')->insert([
            // Usuario 2 (Juan Pérez) asignado a Dieta Baja en Carbohidratos
            [
                'id_usuario' => 2, // Juan Pérez
                'id_dieta' => 2, // Dieta Baja en Carbohidratos
                
            ],
            // Usuario 3 (María Gómez) asignado a Dieta Mediterránea
            [
                'id_usuario' => 3, // María Gómez
                'id_dieta' => 3, // Dieta Mediterránea
                
            ],
            // Usuario 4 (Carlos Rodríguez) asignado a Dieta Vegetariana
            [
                'id_usuario' => 4, // Carlos Rodríguez
                'id_dieta' => 4, // Dieta Vegetariana
                
            ],
            // Usuario 5 (Laura Martínez) asignado a Dieta Keto
            [
                'id_usuario' => 5, // Laura Martínez
                'id_dieta' => 5, // Dieta Keto
             
            ],
        ]);
    }
}
