<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotRutinaEjerciciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Asociaciones rutinas-pecho (rutinas 1 )
        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 1, 'id_ejercicio' => 1, 'dia' => 'lunes', 'repeticiones' => 12, 'series' => 4],
            ['id_rutina' => 1, 'id_ejercicio' => 2, 'dia' => 'lunes', 'repeticiones' => 15, 'series' => 3],
            ['id_rutina' => 1, 'id_ejercicio' => 3, 'dia' => 'lunes', 'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 1, 'id_ejercicio' => 4, 'dia' => 'lunes', 'repeticiones' => 12, 'series' => 4],
        ]);

        // Asociaciones rutinas-espalda (rutinas 3 )
        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 3, 'id_ejercicio' => 16, 'dia' => 'martes', 'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 3, 'id_ejercicio' => 17, 'dia' => 'martes', 'repeticiones' => 12, 'series' => 3],
            ['id_rutina' => 3, 'id_ejercicio' => 18, 'dia' => 'martes', 'repeticiones' => 8, 'series' => 4],
            ['id_rutina' => 3, 'id_ejercicio' => 19, 'dia' => 'martes', 'repeticiones' => 10, 'series' => 4],
        ]);

        // Asociaciones rutinas-hombros (rutinas 5 )
        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 5, 'id_ejercicio' => 31, 'dia' => 'miércoles', 'repeticiones' => 15, 'series' => 3],
            ['id_rutina' => 5, 'id_ejercicio' => 32, 'dia' => 'miércoles', 'repeticiones' => 12, 'series' => 4],
            ['id_rutina' => 5, 'id_ejercicio' => 33, 'dia' => 'miércoles', 'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 5, 'id_ejercicio' => 34, 'dia' => 'miércoles', 'repeticiones' => 15, 'series' => 3],
        ]);

        // Asociaciones rutinas-pierna (rutinas 7 )
        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 7, 'id_ejercicio' => 46, 'dia' => 'viernes', 'repeticiones' => 12, 'series' => 4],
            ['id_rutina' => 7, 'id_ejercicio' => 47, 'dia' => 'viernes', 'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 7, 'id_ejercicio' => 48, 'dia' => 'viernes', 'repeticiones' => 15, 'series' => 3],
            ['id_rutina' => 7, 'id_ejercicio' => 49, 'dia' => 'viernes', 'repeticiones' => 12, 'series' => 4],
        ]);
    }
}