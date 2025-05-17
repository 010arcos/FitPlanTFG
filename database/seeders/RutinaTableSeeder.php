<?php

namespace Database\Seeders;

use App\Models\Rutina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RutinaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $fechaInicio = Carbon::now();
        $fechaFin = Carbon::now()->addDays(30);

        Rutina::create([ // 1
            'nombre' => 'Rutina básica de pecho 1',
            'descripcion' => 'Rutina enfocada en el desarrollo y fuerza de pecho.',
            'dia' => 'lunes',
            'fecha_inicio' => $fechaInicio,
          
            'fecha_fin' => $fechaFin,
        ]);

        Rutina::create([ // 2
            'nombre' => 'Rutina avanzada de pecho 2',
            'descripcion' => 'Rutina avanzada para mejorar resistencia y definición en pecho.',
            'dia' => 'lunes',
            'fecha_inicio' => $fechaInicio,
           
            'fecha_fin' => $fechaFin,
        ]);

        Rutina::create([ //3
            'nombre' => 'Rutina básica de espalda 1',
            'descripcion' => 'Rutina enfocada en el desarrollo y fuerza de espalda.',
            'dia' => 'martes',
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        ]);

        Rutina::create([// 4
            'nombre' => 'Rutina avanzada de espalda 2',
            'descripcion' => 'Rutina avanzada para mejorar resistencia y definición en espalda.',
            'dia' => 'martes',
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        ]);

        Rutina::create([ // 5
            'nombre' => 'Rutina básica de hombros 1',
            'descripcion' => 'Rutina enfocada en el desarrollo y fuerza de hombros.',
            'dia' => 'miercoles',
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        ]);

        Rutina::create([ //6
            'nombre' => 'Rutina avanzada de hombros 2',
           
            'descripcion' => 'Rutina avanzada para mejorar resistencia y definición en hombros.',
            'dia' => 'miercoles',
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        ]);

        Rutina::create([ //7
            
            'nombre' => 'Rutina básica de pierna 1',
            'descripcion' => 'Rutina enfocada en el desarrollo y fuerza de pierna.',
            'dia' => 'jueves',
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        ]);

        Rutina::create([ //8
            'nombre' => 'Rutina avanzada de pierna 2',
            'descripcion' => 'Rutina avanzada para mejorar resistencia y definición en pierna.',
            'dia' => 'jueves',
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        ]);
    }
}