<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotDietaDiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pivot_dieta_dia')->insert([
            // Dieta 1
            ['id_dieta' => 1, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 1, 'dia_semana' => 'Martes'],
            ['id_dieta' => 1, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 1, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 1, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 1, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 1, 'dia_semana' => 'Domingo'],

            // Dieta 2
            ['id_dieta' => 2, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 2, 'dia_semana' => 'Martes'],
            ['id_dieta' => 2, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 2, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 2, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 2, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 2, 'dia_semana' => 'Domingo'],

            // Dieta 3
            ['id_dieta' => 3, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 3, 'dia_semana' => 'Martes'],
            ['id_dieta' => 3, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 3, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 3, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 3, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 3, 'dia_semana' => 'Domingo'],

            // Dieta 4
            ['id_dieta' => 4, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 4, 'dia_semana' => 'Martes'],
            ['id_dieta' => 4, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 4, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 4, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 4, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 4, 'dia_semana' => 'Domingo'],
        ]);
    }
}