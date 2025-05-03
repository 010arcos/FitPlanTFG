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
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pivot_dieta_dia')->insert([
            // Dieta Alta en Proteínas y sus alternativas (id_dieta 1, 2, 3, 4)
            ['id_dieta' => 1, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 1, 'dia_semana' => 'Martes'],
            ['id_dieta' => 1, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 2, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 2, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 2, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 2, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 3, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 3, 'dia_semana' => 'Martes'],
            ['id_dieta' => 3, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 3, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 3, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 3, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 3, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 4, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 4, 'dia_semana' => 'Martes'],
            ['id_dieta' => 4, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 4, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 4, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 4, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 4, 'dia_semana' => 'Domingo'],

            // Dieta Baja en Carbohidratos y sus alternativas (id_dieta 5, 6, 7, 8)
            ['id_dieta' => 5, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 5, 'dia_semana' => 'Martes'],
            ['id_dieta' => 5, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 5, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 5, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 5, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 5, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 6, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 6, 'dia_semana' => 'Martes'],
            ['id_dieta' => 6, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 6, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 6, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 6, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 6, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 7, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 7, 'dia_semana' => 'Martes'],
            ['id_dieta' => 7, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 7, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 7, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 7, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 7, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 8, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 8, 'dia_semana' => 'Martes'],
            ['id_dieta' => 8, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 8, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 8, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 8, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 8, 'dia_semana' => 'Domingo'],

            // Dieta Mediterránea y sus alternativas (id_dieta 9, 10, 11, 12)
            ['id_dieta' => 9, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 9, 'dia_semana' => 'Martes'],
            ['id_dieta' => 9, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 9, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 9, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 9, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 9, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 10, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 10, 'dia_semana' => 'Martes'],
            ['id_dieta' => 10, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 10, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 10, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 10, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 10, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 11, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 11, 'dia_semana' => 'Martes'],
            ['id_dieta' => 11, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 11, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 11, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 11, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 11, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 12, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 12, 'dia_semana' => 'Martes'],
            ['id_dieta' => 12, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 12, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 12, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 12, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 12, 'dia_semana' => 'Domingo'],

            // Dieta Vegetariana y sus alternativas (id_dieta 13, 14, 15, 16)
            ['id_dieta' => 13, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 13, 'dia_semana' => 'Martes'],
            ['id_dieta' => 13, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 13, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 13, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 13, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 13, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 14, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 14, 'dia_semana' => 'Martes'],
            ['id_dieta' => 14, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 14, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 14, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 14, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 14, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 15, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 15, 'dia_semana' => 'Martes'],
            ['id_dieta' => 15, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 15, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 15, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 15, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 15, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 16, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 16, 'dia_semana' => 'Martes'],
            ['id_dieta' => 16, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 16, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 16, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 16, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 16, 'dia_semana' => 'Domingo'],

            // Dieta Keto y sus alternativas (id_dieta 17, 18, 19, 20)
            ['id_dieta' => 17, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 17, 'dia_semana' => 'Martes'],
            ['id_dieta' => 17, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 17, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 17, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 17, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 17, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 18, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 18, 'dia_semana' => 'Martes'],
            ['id_dieta' => 18, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 18, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 18, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 18, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 18, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 19, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 19, 'dia_semana' => 'Martes'],
            ['id_dieta' => 19, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 19, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 19, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 19, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 19, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 20, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 20, 'dia_semana' => 'Martes'],
            ['id_dieta' => 20, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 20, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 20, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 20, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 20, 'dia_semana' => 'Domingo'],

            // Dieta Vegana y sus alternativas (id_dieta 21, 22, 23, 24)
            ['id_dieta' => 21, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 21, 'dia_semana' => 'Martes'],
            ['id_dieta' => 21, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 21, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 21, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 21, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 21, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 22, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 22, 'dia_semana' => 'Martes'],
            ['id_dieta' => 22, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 22, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 22, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 22, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 22, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 23, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 23, 'dia_semana' => 'Martes'],
            ['id_dieta' => 23, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 23, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 23, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 23, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 23, 'dia_semana' => 'Domingo'],

            ['id_dieta' => 24, 'dia_semana' => 'Lunes'],
            ['id_dieta' => 24, 'dia_semana' => 'Martes'],
            ['id_dieta' => 24, 'dia_semana' => 'Miércoles'],
            ['id_dieta' => 24, 'dia_semana' => 'Jueves'],
            ['id_dieta' => 24, 'dia_semana' => 'Viernes'],
            ['id_dieta' => 24, 'dia_semana' => 'Sábado'],
            ['id_dieta' => 24, 'dia_semana' => 'Domingo'],
        ]);
    }
}