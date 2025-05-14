<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PivotRutinaUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $fechaInicio = Carbon::now()->toDateString();
        $fechaFin = Carbon::now()->addDays(30)->toDateString();

        DB::table('pivot_usuario_rutina')->insert([
            [
                'id_usuario' => 2,
                'id_rutina' => 1,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
            ],
            [
                'id_usuario' => 2,
                'id_rutina' => 3,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
            ],
            [
                'id_usuario' => 2,
                'id_rutina' => 5,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
            ],
            [
                'id_usuario' => 2,
                'id_rutina' => 7,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
            ],
        ]);
    }
}