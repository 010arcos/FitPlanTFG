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
                'descripcion' => 'Avena con plátano y miel',
                'calorias' => 350,
                'macros' => json_encode(['proteinas' => 8, 'carbohidratos' => 60, 'grasas' => 7]),
               
            ],
            [
                'descripcion' => 'Tostadas integrales con aguacate y huevo',
                'calorias' => 400,
                'macros' => json_encode(['proteinas' => 15, 'carbohidratos' => 45, 'grasas' => 20]),
                
            ],
            [
                'descripcion' => 'Yogur natural con granola y frutas',
                'calorias' => 300,
                'macros' => json_encode(['proteinas' => 15, 'carbohidratos' => 40, 'grasas' => 8]),
               
            ],
            [
                'descripcion' => 'Batido de avena con leche y mantequilla de maní',
                'calorias' => 450,
                'macros' => json_encode(['proteinas' => 20, 'carbohidratos' => 50, 'grasas' => 15]),
                
            ],

            // Almuerzos
            [
                'descripcion' => 'Arroz con lentejas y verduras',
                'calorias' => 500,
                'macros' => json_encode(['proteinas' => 20, 'carbohidratos' => 75, 'grasas' => 8]),
                
            ],
            [
                'descripcion' => 'Tacos de pollo con guacamole',
                'calorias' => 600,
                'macros' => json_encode(['proteinas' => 35, 'carbohidratos' => 50, 'grasas' => 25]),
                
            ],
            [
                'descripcion' => 'Sándwich integral de atún con espinacas',
                'calorias' => 450,
                'macros' => json_encode(['proteinas' => 30, 'carbohidratos' => 40, 'grasas' => 12]),
                
            ],
            [
                'descripcion' => 'Pechuga de pavo con patatas al horno',
                'calorias' => 550,
                'macros' => json_encode(['proteinas' => 40, 'carbohidratos' => 50, 'grasas' => 15]),
                
            ],
            [
                'descripcion' => 'Ensalada César con pollo a la parrilla',
                'calorias' => 400,
                'macros' => json_encode(['proteinas' => 30, 'carbohidratos' => 20, 'grasas' => 25]),
                
            ],

            // Cenas
            [
                'descripcion' => 'Salmón al horno con quinoa',
                'calorias' => 600,
                'macros' => json_encode(['proteinas' => 40, 'carbohidratos' => 45, 'grasas' => 25]),
               
            ],
            [
                'descripcion' => 'Hamburguesa de ternera con ensalada',
                'calorias' => 650,
                'macros' => json_encode(['proteinas' => 45, 'carbohidratos' => 40, 'grasas' => 30]),
                
            ],
            [
                'descripcion' => 'Pasta con salsa de tomate y albóndigas',
                'calorias' => 750,
                'macros' => json_encode(['proteinas' => 35, 'carbohidratos' => 90, 'grasas' => 25]),
                
            ],
            [
                'descripcion' => 'Sopa de pollo con fideos',
                'calorias' => 350,
                'macros' => json_encode(['proteinas' => 25, 'carbohidratos' => 40, 'grasas' => 7]),
                
            ],

            // Meriendas
            [
                'descripcion' => 'Tostadas de aguacate con tomate',
                'calorias' => 300,
                'macros' => json_encode(['proteinas' => 5, 'carbohidratos' => 30, 'grasas' => 18]),
                
            ],
            [
                'descripcion' => 'Frutos secos (almendras, nueces, pistachos)',
                'calorias' => 400,
                'macros' => json_encode(['proteinas' => 12, 'carbohidratos' => 20, 'grasas' => 30]),
                
            ],
            [
                'descripcion' => 'Batido de proteínas con leche de almendra',
                'calorias' => 350,
                'macros' => json_encode(['proteinas' => 25, 'carbohidratos' => 20, 'grasas' => 15]),
              
            ],

            // Postre
            [
                'descripcion' => 'Mousse de chocolate con aguacate',
                'calorias' => 300,
                'macros' => json_encode(['proteinas' => 5, 'carbohidratos' => 30, 'grasas' => 18]),
              
            ],
            [
                'descripcion' => 'Galletas de avena y plátano',
                'calorias' => 250,
                'macros' => json_encode(['proteinas' => 5, 'carbohidratos' => 35, 'grasas' => 10]),
               
            ],
            [
                'descripcion' => 'Yogur griego con miel y nueces',
                'calorias' => 350,
                'macros' => json_encode(['proteinas' => 20, 'carbohidratos' => 35, 'grasas' => 15]),
                
            ],

            // Otros
            [
                'descripcion' => 'Pechuga de pollo con espinacas y arroz integral',
                'calorias' => 500,
                'macros' => json_encode(['proteinas' => 40, 'carbohidratos' => 50, 'grasas' => 12]),
                
            ],
            [
                'descripcion' => 'Tortilla de patatas con cebolla',
                'calorias' => 450,
                'macros' => json_encode(['proteinas' => 15, 'carbohidratos' => 50, 'grasas' => 20]),
                
            ]
        ]);
    }
}
