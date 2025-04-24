<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PivotDietaComidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pivot_dieta_comida')->insert([
            // Dieta 1
            ['id_dieta' => 1, 'id_comida' => 1, 'tipo_comida' => 'desayuno'], // Avena con plátano y miel
            ['id_dieta' => 1, 'id_comida' => 2, 'tipo_comida' => 'almuerzo'], // Tostadas integrales con aguacate y huevo
            ['id_dieta' => 1, 'id_comida' => 3, 'tipo_comida' => 'comida'],   // Yogur natural con granola y frutas
            ['id_dieta' => 1, 'id_comida' => 4, 'tipo_comida' => 'merienda'], // Batido de avena con leche y mantequilla de maní
            ['id_dieta' => 1, 'id_comida' => 5, 'tipo_comida' => 'cena'],     // Arroz con lentejas y verduras

            // Dieta 2
            ['id_dieta' => 2, 'id_comida' => 6, 'tipo_comida' => 'desayuno'], // Tacos de pollo con guacamole
            ['id_dieta' => 2, 'id_comida' => 7, 'tipo_comida' => 'almuerzo'], // Sándwich integral de atún con espinacas
            ['id_dieta' => 2, 'id_comida' => 8, 'tipo_comida' => 'comida'],   // Pechuga de pavo con patatas al horno
            ['id_dieta' => 2, 'id_comida' => 9, 'tipo_comida' => 'merienda'], // Ensalada César con pollo a la parrilla
            ['id_dieta' => 2, 'id_comida' => 10, 'tipo_comida' => 'cena'],    // Salmón al horno con quinoa

            // Dieta 3
            ['id_dieta' => 3, 'id_comida' => 11, 'tipo_comida' => 'desayuno'], // Hamburguesa de ternera con ensalada
            ['id_dieta' => 3, 'id_comida' => 12, 'tipo_comida' => 'almuerzo'], // Pasta con salsa de tomate y albóndigas
            ['id_dieta' => 3, 'id_comida' => 13, 'tipo_comida' => 'comida'],   // Sopa de pollo con fideos
            ['id_dieta' => 3, 'id_comida' => 14, 'tipo_comida' => 'merienda'], // Tostadas de aguacate con tomate
            ['id_dieta' => 3, 'id_comida' => 15, 'tipo_comida' => 'cena'],     // Frutos secos (almendras, nueces, pistachos)

            // Dieta 4
            ['id_dieta' => 4, 'id_comida' => 16, 'tipo_comida' => 'desayuno'], // Batido de proteínas con leche de almendra
            ['id_dieta' => 4, 'id_comida' => 17, 'tipo_comida' => 'almuerzo'], // Mousse de chocolate con aguacate
            ['id_dieta' => 4, 'id_comida' => 18, 'tipo_comida' => 'comida'],   // Galletas de avena y plátano
            ['id_dieta' => 4, 'id_comida' => 19, 'tipo_comida' => 'merienda'], // Yogur griego con miel y nueces
            ['id_dieta' => 4, 'id_comida' => 20, 'tipo_comida' => 'cena'],     // Pechuga de pollo con espinacas y arroz integral
        ]);
    }
}
