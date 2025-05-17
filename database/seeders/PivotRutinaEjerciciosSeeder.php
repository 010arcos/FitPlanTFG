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
            ['id_rutina' => 1, 'id_ejercicio' => 1,  'repeticiones' => 12, 'series' => 4],
            ['id_rutina' => 1, 'id_ejercicio' => 2,  'repeticiones' => 15, 'series' => 3],
            ['id_rutina' => 1, 'id_ejercicio' => 3,  'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 1, 'id_ejercicio' => 4,  'repeticiones' => 12, 'series' => 4],
        ]);

        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 2, 'id_ejercicio' => 5, 'repeticiones' => 12, 'series' => 4],
            ['id_rutina' => 2, 'id_ejercicio' => 6, 'repeticiones' => 15, 'series' => 3],
            ['id_rutina' => 2, 'id_ejercicio' => 7, 'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 2, 'id_ejercicio' => 8, 'repeticiones' => 12, 'series' => 4],
        ]);

        // Asociaciones rutinas-espalda (rutinas 3 )
        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 3, 'id_ejercicio' => 16,  'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 3, 'id_ejercicio' => 17,  'repeticiones' => 12, 'series' => 3],
            ['id_rutina' => 3, 'id_ejercicio' => 18, 'repeticiones' => 8, 'series' => 4],
            ['id_rutina' => 3, 'id_ejercicio' => 19,  'repeticiones' => 10, 'series' => 4],
        ]);
        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 4, 'id_ejercicio' => 20, 'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 4, 'id_ejercicio' => 21, 'repeticiones' => 12, 'series' => 3],
            ['id_rutina' => 4, 'id_ejercicio' => 22, 'repeticiones' => 8, 'series' => 4],
            ['id_rutina' => 4, 'id_ejercicio' => 23, 'repeticiones' => 10, 'series' => 4],
        ]);

        // Asociaciones rutinas-hombros (rutinas 5 )
        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 5, 'id_ejercicio' => 31, 'repeticiones' => 15, 'series' => 3],
            ['id_rutina' => 5, 'id_ejercicio' => 32,  'repeticiones' => 12, 'series' => 4],
            ['id_rutina' => 5, 'id_ejercicio' => 33,  'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 5, 'id_ejercicio' => 34,  'repeticiones' => 15, 'series' => 3],
        ]);

        // Asociaciones rutinas-pierna (rutinas 7 )
        DB::table('pivot_ejercicio_rutina')->insert([
            ['id_rutina' => 7, 'id_ejercicio' => 46,  'repeticiones' => 12, 'series' => 4],
            ['id_rutina' => 7, 'id_ejercicio' => 47,  'repeticiones' => 10, 'series' => 4],
            ['id_rutina' => 7, 'id_ejercicio' => 48,  'repeticiones' => 15, 'series' => 3],
            ['id_rutina' => 7, 'id_ejercicio' => 49,  'repeticiones' => 12, 'series' => 4],
        ]);
    }
}