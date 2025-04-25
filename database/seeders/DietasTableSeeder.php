<?php

namespace Database\Seeders;

use App\Models\Dieta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DietasTableSeeder extends Seeder
{

    public function run(): void
    {
        // Insertar dietas de ejemplo con alternativas
        Dieta::insert([
            // Dieta Alta en Proteínas y sus alternativas
            [
                'nombre' => 'Dieta Alta en Proteínas',
                'descripcion' => 'Una dieta centrada en el aumento de proteínas para el desarrollo muscular.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],
            [
                'nombre' => 'Dieta Alta en Proteínas Variante 1',
                'descripcion' => 'Dieta centrada en el aumento de proteínas con un enfoque diferente.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],
            [
                'nombre' => 'Dieta Alta en Proteínas Variante 2',
                'descripcion' => 'Dieta con alto contenido proteico, ideal para el desarrollo muscular, alternativa.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],
            [
                'nombre' => 'Dieta Alta en Proteínas Variante 3',
                'descripcion' => 'Alternativa de la dieta alta en proteínas, ajustada a diferentes necesidades.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],

            // Dieta Baja en Carbohidratos y sus alternativas
            [
                'nombre' => 'Dieta Baja en Carbohidratos',
                'descripcion' => 'Dieta que limita los carbohidratos para la pérdida de peso.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],
            [
                'nombre' => 'Dieta Baja en Carbohidratos Variante 1',
                'descripcion' => 'Una versión de la dieta baja en carbohidratos, diseñada para resultados rápidos.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],
            [
                'nombre' => 'Dieta Baja en Carbohidratos Variante 2',
                'descripcion' => 'Alternativa de la dieta baja en carbohidratos con enfoque balanceado.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],
            [
                'nombre' => 'Dieta Baja en Carbohidratos Variante 3',
                'descripcion' => 'Dieta baja en carbohidratos, adaptada para optimizar la pérdida de peso.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-01',
            ],

            // Dieta Mediterránea y sus alternativas
            [
                'nombre' => 'Dieta Mediterránea',
                'descripcion' => 'Una dieta basada en la alimentación tradicional de los países mediterráneos, rica en grasas saludables.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta Mediterránea Variante 1',
                'descripcion' => 'Versión alternativa de la dieta mediterránea, adaptada a preferencias personales.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta Mediterránea Variante 2',
                'descripcion' => 'Dieta mediterránea con ajustes nutricionales para mejorar la salud cardiovascular.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta Mediterránea Variante 3',
                'descripcion' => 'Una versión más sencilla de la dieta mediterránea, ideal para principiantes.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-07-01',
            ],

            // Dieta Vegetariana y sus alternativas
            [
                'nombre' => 'Dieta Vegetariana',
                'descripcion' => 'Dieta basada en alimentos vegetales y sin carne.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-30',
            ],
            [
                'nombre' => 'Dieta Vegetariana Variante 1',
                'descripcion' => 'Dieta vegetariana con una variedad de opciones ricas en proteínas vegetales.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-30',
            ],
            [
                'nombre' => 'Dieta Vegetariana Variante 2',
                'descripcion' => 'Una alternativa a la dieta vegetariana para quienes buscan variedad de vegetales.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-30',
            ],
            [
                'nombre' => 'Dieta Vegetariana Variante 3',
                'descripcion' => 'Versión de la dieta vegetariana con énfasis en la sostenibilidad y alimentos locales.',
                'fecha_inicio' => '2025-05-01',
                'fecha_fin' => '2025-06-30',
            ],

            // Dieta Keto y sus alternativas
            [
                'nombre' => 'Dieta Keto',
                'descripcion' => 'Dieta alta en grasas y baja en carbohidratos para la pérdida de peso rápida.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta Keto Variante 1',
                'descripcion' => 'Versión de la dieta keto con más enfoque en alimentos frescos y naturales.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta Keto Variante 2',
                'descripcion' => 'Una dieta keto alternativa que incluye más variedad de vegetales y grasas saludables.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-07-01',
            ],
            [
                'nombre' => 'Dieta Keto Variante 3',
                'descripcion' => 'Alternativa de la dieta keto, enfocada en facilitar la transición a una dieta baja en carbohidratos.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-07-01',
            ],

            // Dieta Vegana y sus alternativas
            [
                'nombre' => 'Dieta Vegana',
                'descripcion' => 'Una dieta completamente basada en plantas, sin productos de origen animal.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-08-01',
            ],
            [
                'nombre' => 'Dieta Vegana Variante 1',
                'descripcion' => 'Alternativa vegana centrada en la nutrición balanceada y alimentos enteros.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-08-01',
            ],
            [
                'nombre' => 'Dieta Vegana Variante 2',
                'descripcion' => 'Versión vegana para optimizar la salud digestiva y la absorción de nutrientes.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-08-01',
            ],
            [
                'nombre' => 'Dieta Vegana Variante 3',
                'descripcion' => 'Alternativa vegana enfocada en el bienestar animal y la sostenibilidad.',
                'fecha_inicio' => '2025-06-01',
                'fecha_fin' => '2025-08-01',
            ],
        ]);

    }
}