<?php

namespace Database\Seeders;

use App\Models\Ejercicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EjerciciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Ejercicio::insert([
            [
                'nombre' => 'Press de banca',
                'descripcion' => 'Ejercicio para trabajar el pecho',
                'zona' => 'pecho',
                'tipo' => 'fuerza'
            ],
            [
                'nombre' => 'Elevaciones laterales',
                'descripcion' => 'Ejercicio para trabajar hombros',
                'zona' => 'hombros',
                'tipo' => 'fuerza'
            ],
            [
                'nombre' => 'Flexiones',
                'descripcion' => 'Ejercicio básico para el pecho',
                'zona' => 'pecho',
                'tipo' => 'fuerza'
            ],
            [
                'nombre' => 'Remo con barra',
                'descripcion' => 'Ejercicio para trabajar la espalda',
                'zona' => 'espalda',
                'tipo' => 'fuerza'
            ],
            [
                'nombre' => 'Curl de bíceps',
                'descripcion' => 'Ejercicio para trabajar los bíceps',
                'zona' => 'brazos',
                'tipo' => 'fuerza'
            ],
            [
                'nombre' => 'Zancadas',
                'descripcion' => 'Ejercicio para piernas',
                'zona' => 'pierna',
                'tipo' => 'fuerza'
            ],
            [
                'nombre' => 'Prensa de piernas',
                'descripcion' => 'Ejercicio para piernas',
                'zona' => 'pierna',
                'tipo' => 'fuerza'
            ],
            [
                'nombre' => 'Peso muerto',
                'descripcion' => 'Ejercicio para piernas y espalda baja',
                'zona' => 'pierna',
                'tipo' => 'fuerza'
            ],
            [
                'nombre' => 'Burpees',
                'descripcion' => 'Ejercicio cardiovascular de alta intensidad',
                'zona' => 'abdomen',
                'tipo' => 'cardio'
            ],
            [
                'nombre' => 'Saltos en caja',
                'descripcion' => 'Ejercicio de salto para mejorar la explosividad',
                'zona' => 'pierna',
                'tipo' => 'cardio'
            ],
            [
                'nombre' => 'Crunch abdominal',
                'descripcion' => 'Ejercicio para trabajar el abdomen',
                'zona' => 'abdomen',
                'tipo' => 'fuerza'
            ],
        ]);
    }
}
