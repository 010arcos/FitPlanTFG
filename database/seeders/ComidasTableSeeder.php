<?php

namespace Database\Seeders;

use App\Models\Comida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComidasTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comida::insert([
            // Desayunos
            [
                'nombre' => 'Avena con plátano y miel',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Avena', 'cantidad' => '50g'],
                        ['nombre' => 'Plátano', 'cantidad' => '100g'],
                        ['nombre' => 'Miel', 'cantidad' => '15g']
                    ]
                ]),
                'calorias' => 350,
                'macros' => json_encode(['proteinas' => 8, 'carbohidratos' => 60, 'grasas' => 7]),
            ], // 1
            [
                'nombre' => 'Tostadas integrales con aguacate y huevo',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Tostada integral', 'cantidad' => '2 rebanadas'],
                        ['nombre' => 'Aguacate', 'cantidad' => '50g'],
                        ['nombre' => 'Huevo', 'cantidad' => '1']
                    ]
                ]),
                'calorias' => 400,
                'macros' => json_encode(['proteinas' => 15, 'carbohidratos' => 45, 'grasas' => 20]),
            ], // 2
            [
                'nombre' => 'Yogur natural con granola y frutas',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Yogur natural', 'cantidad' => '150g'],
                        ['nombre' => 'Granola', 'cantidad' => '30g'],
                        ['nombre' => 'Fresas', 'cantidad' => '50g'],
                        ['nombre' => 'Plátano', 'cantidad' => '50g']
                    ]
                ]),
                'calorias' => 300,
                'macros' => json_encode(['proteinas' => 15, 'carbohidratos' => 40, 'grasas' => 8]),
            ], // 3
            [
                'nombre' => 'Batido de avena con leche y mantequilla de maní',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Avena', 'cantidad' => '40g'],
                        ['nombre' => 'Leche', 'cantidad' => '200ml'],
                        ['nombre' => 'Mantequilla de maní', 'cantidad' => '20g']
                    ]
                ]),
                'calorias' => 450,
                'macros' => json_encode(['proteinas' => 20, 'carbohidratos' => 50, 'grasas' => 15]),
            ], // 4

            // Almuerzos
            [
                'nombre' => 'Arroz con lentejas y verduras',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Arroz integral', 'cantidad' => '100g'],
                        ['nombre' => 'Lentejas', 'cantidad' => '100g'],
                        ['nombre' => 'Zanahoria', 'cantidad' => '50g'],
                        ['nombre' => 'Espinacas', 'cantidad' => '50g']
                    ]
                ]),
                'calorias' => 500,
                'macros' => json_encode(['proteinas' => 20, 'carbohidratos' => 75, 'grasas' => 8]),
            ], // 5
            [
                'nombre' => 'Tacos de pollo con guacamole',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Pollo', 'cantidad' => '100g'],
                        ['nombre' => 'Tortilla de maíz', 'cantidad' => '2'],
                        ['nombre' => 'Guacamole', 'cantidad' => '50g']
                    ]
                ]),
                'calorias' => 600,
                'macros' => json_encode(['proteinas' => 35, 'carbohidratos' => 50, 'grasas' => 25]),
            ], // 6
            [
                'nombre' => 'Sándwich integral de atún con espinacas',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Pan integral', 'cantidad' => '2 rebanadas'],
                        ['nombre' => 'Atún', 'cantidad' => '100g'],
                        ['nombre' => 'Espinacas', 'cantidad' => '50g']
                    ]
                ]),
                'calorias' => 450,
                'macros' => json_encode(['proteinas' => 30, 'carbohidratos' => 40, 'grasas' => 12]),
            ], // 7

            // Cenas
            [
                'nombre' => 'Salmón al horno con quinoa',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Salmón', 'cantidad' => '150g'],
                        ['nombre' => 'Quinoa', 'cantidad' => '100g']
                    ]
                ]),
                'calorias' => 600,
                'macros' => json_encode(['proteinas' => 40, 'carbohidratos' => 45, 'grasas' => 25]),
            ], // 8
            [
                'nombre' => 'Hamburguesa de ternera con ensalada',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Carne de ternera', 'cantidad' => '150g'],
                        ['nombre' => 'Pan integral', 'cantidad' => '1'],
                        ['nombre' => 'Lechuga', 'cantidad' => '30g'],
                        ['nombre' => 'Tomate', 'cantidad' => '30g'],
                        ['nombre' => 'Cebolla', 'cantidad' => '30g']
                    ]
                ]),
                'calorias' => 650,
                'macros' => json_encode(['proteinas' => 45, 'carbohidratos' => 40, 'grasas' => 30]),
            ], // 9
            [
                'nombre' => 'Pasta con salsa de tomate y albóndigas',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Pasta', 'cantidad' => '100g'],
                        ['nombre' => 'Albóndigas de carne', 'cantidad' => '150g'],
                        ['nombre' => 'Salsa de tomate', 'cantidad' => '50g']
                    ]
                ]),
                'calorias' => 750,
                'macros' => json_encode(['proteinas' => 35, 'carbohidratos' => 90, 'grasas' => 25]),
            ], // 10
            [
                'nombre' => 'Sopa de pollo con fideos',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Pollo', 'cantidad' => '100g'],
                        ['nombre' => 'Fideos', 'cantidad' => '50g'],
                        ['nombre' => 'Zanahorias', 'cantidad' => '30g'],
                        ['nombre' => 'Apio', 'cantidad' => '20g']
                    ]
                ]),
                'calorias' => 350,
                'macros' => json_encode(['proteinas' => 25, 'carbohidratos' => 40, 'grasas' => 7]),
            ], // 11

            // Meriendas
            [
                'nombre' => 'Tostadas de aguacate con tomate',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Aguacate', 'cantidad' => '50g'],
                        ['nombre' => 'Pan integral', 'cantidad' => '2 rebanadas'],
                        ['nombre' => 'Tomate', 'cantidad' => '30g']
                    ]
                ]),
                'calorias' => 300,
                'macros' => json_encode(['proteinas' => 5, 'carbohidratos' => 30, 'grasas' => 18]),
            ], // 12
            [
                'nombre' => 'Frutos secos (almendras, nueces, pistachos)',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Almendras', 'cantidad' => '30g'],
                        ['nombre' => 'Nueces', 'cantidad' => '30g'],
                        ['nombre' => 'Pistachos', 'cantidad' => '30g']
                    ]
                ]),
                'calorias' => 400,
                'macros' => json_encode(['proteinas' => 12, 'carbohidratos' => 20, 'grasas' => 30]),
            ], // 13
            [
                'nombre' => 'Batido de proteínas con leche de almendra',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Proteína en polvo', 'cantidad' => '25g'],
                        ['nombre' => 'Leche de almendra', 'cantidad' => '250ml']
                    ]
                ]),
                'calorias' => 350,
                'macros' => json_encode(['proteinas' => 25, 'carbohidratos' => 20, 'grasas' => 15]),
            ], // 14

            // Postre
            [
                'nombre' => 'Mousse de chocolate con aguacate',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Aguacate', 'cantidad' => '100g'],
                        ['nombre' => 'Cacao en polvo', 'cantidad' => '20g'],
                        ['nombre' => 'Miel', 'cantidad' => '15g']
                    ]
                ]),
                'calorias' => 300,
                'macros' => json_encode(['proteinas' => 5, 'carbohidratos' => 30, 'grasas' => 18]),
            ], // 15
            [
                'nombre' => 'Galletas de avena y plátano',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Avena', 'cantidad' => '50g'],
                        ['nombre' => 'Plátano', 'cantidad' => '100g'],
                        ['nombre' => 'Miel', 'cantidad' => '15g']
                    ]
                ]),
                'calorias' => 250,
                'macros' => json_encode(['proteinas' => 5, 'carbohidratos' => 35, 'grasas' => 10]),
            ], // 16
            [
                'nombre' => 'Yogur griego con miel y nueces',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Yogur griego', 'cantidad' => '150g'],
                        ['nombre' => 'Miel', 'cantidad' => '10g'],
                        ['nombre' => 'Nueces', 'cantidad' => '20g']
                    ]
                ]),
                'calorias' => 350,
                'macros' => json_encode(['proteinas' => 20, 'carbohidratos' => 35, 'grasas' => 15]),
            ], // 17

            // Otros
            [
                'nombre' => 'Pechuga de pollo con espinacas y arroz integral',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Pechuga de pollo', 'cantidad' => '150g'],
                        ['nombre' => 'Espinacas', 'cantidad' => '50g'],
                        ['nombre' => 'Arroz integral', 'cantidad' => '100g']
                    ]
                ]),
                'calorias' => 500,
                'macros' => json_encode(['proteinas' => 40, 'carbohidratos' => 50, 'grasas' => 12]),
            ], // 18
            [
                'nombre' => 'Tortilla de patatas con cebolla',
                'alimentos' => json_encode([
                    'ingredientes' => [
                        ['nombre' => 'Huevos', 'cantidad' => '3'],
                        ['nombre' => 'Patatas', 'cantidad' => '200g'],
                        ['nombre' => 'Cebolla', 'cantidad' => '50g']
                    ]
                ]),
                'calorias' => 450,
                'macros' => json_encode(['proteinas' => 15, 'carbohidratos' => 50, 'grasas' => 20]),
            ], // 19
        ]);
    }
}