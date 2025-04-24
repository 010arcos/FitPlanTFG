<?php

namespace Database\Seeders;

use App\Models\Dieta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DietasTableSeeder extends Seeder
{
    
    public function run(): void
    {
        // Insertar dietas de ejemplo sin created_at y updated_at
        Dieta::insert([
            [
                'nombre' => 'Dieta Alta en Proteínas',
                'descripcion' => 'Una dieta centrada en el aumento de proteínas para el desarrollo muscular.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],
            [
                'nombre' => 'Dieta Baja en Carbohidratos',
                'descripcion' => 'Una dieta que limita los carbohidratos para la pérdida de peso.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],
            [
                'nombre' => 'Dieta Mediterránea',
                'descripcion' => 'Una dieta basada en la alimentación tradicional de los países mediterráneos, rica en grasas saludables.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta Vegetariana',
                'descripcion' => 'Dieta basada en alimentos vegetales y sin carne.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-30',
            ],
            [
                'nombre' => 'Dieta Keto',
                'descripcion' => 'Dieta alta en grasas y baja en carbohidratos para la pérdida de peso rápida.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta Vegana',
                'descripcion' => 'Una dieta completamente basada en plantas, sin productos de origen animal.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-08-01',
            ],
            [
                'nombre' => 'Dieta Flexitariana',
                'descripcion' => 'Dieta principalmente vegetariana, pero con la opción de consumir carne ocasionalmente.',
                'fecha_inicio' => '2025-06-15',
                'fecha_fin' => '2025-07-15',
            ],
            [
                'nombre' => 'Dieta Paleo',
                'descripcion' => 'Dieta basada en alimentos que nuestros antepasados cazadores-recolectores consumían.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta DASH',
                'descripcion' => 'Dieta enfocada en reducir la presión arterial alta mediante un plan alimenticio saludable.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta FODMAP',
                'descripcion' => 'Dieta baja en carbohidratos fermentables, ideal para personas con problemas digestivos.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-06-30',
            ]
        ]);
    }
}