<?php

namespace Database\Seeders;

use App\Models\HistorialPeso;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HistorialPesoSeeder extends Seeder
{
    public function run()
    {
        // Obtener el usuario Marco con ID 2
        $usuario = User::find(2);
        
        if (!$usuario) {
            $this->command->error('❌ Usuario con ID 2 no encontrado');
            return;
        }

        $this->command->info('📊 Creando historial para: ' . $usuario->name);

        // Crear registros de los últimos 6 meses (1-2 por mes)
        $fechaInicio = Carbon::now()->subMonths(6);
        $pesoInicial = 78.5;
        $altura = 1.75;

        // Array con fechas específicas (más realista)
        $fechas = [
            $fechaInicio->copy(),                    // Hace 6 meses
            $fechaInicio->copy()->addWeeks(3),       // Hace 5.5 meses
            $fechaInicio->copy()->addMonths(1),      // Hace 5 meses
            $fechaInicio->copy()->addMonths(2),      // Hace 4 meses
            $fechaInicio->copy()->addMonths(2)->addWeeks(2), // Hace 3.5 meses
            $fechaInicio->copy()->addMonths(3),      // Hace 3 meses
            $fechaInicio->copy()->addMonths(4)->addWeeks(1), // Hace 2.5 meses
            $fechaInicio->copy()->addMonths(4)->addWeeks(3), // Hace 2 meses
            $fechaInicio->copy()->addMonths(5),      // Hace 1 mes
            $fechaInicio->copy()->addMonths(5)->addWeeks(2), // Hace 2 semanas
        ];

        foreach ($fechas as $index => $fecha) {
            // Pérdida gradual más realista (0.3-0.8 kg por mes)
            $perdidaTotal = ($index * 0.5) + (rand(-2, 1) / 10);
            $peso = $pesoInicial - $perdidaTotal;
            
            // Mantener en rango realista
            $peso = max(70, min(82, $peso));
            
            HistorialPeso::create([
                'id_usuario' => 2,
                'peso' => round($peso, 1),
                'altura' => $altura,
                'fecha_registro' => $fecha->format('Y-m-d'),
                'notas' => $this->generarNotaRealista($index),
            ]);
        }

        $this->command->info('✅ Historial creado: 10 registros en 6 meses');
        $this->command->info('📈 Progreso realista de pérdida de peso');
    }

    private function generarNotaRealista($index)
    {
        $notas = [
            'Empezando mi plan de fitness',
            'Primera semana de dieta',
            'Notando pequeños cambios',
            'Manteniéndome constante',
            'Buen progreso este mes',
            'Semana complicada pero bien',
            'Muy contento con los resultados',
            'Ajustando la rutina',
            'Excelente mes de entrenamiento',
            'Casi llegando a mi objetivo',
        ];

        // Algunas sin notas (más realista)
        return rand(1, 10) <= 7 ? $notas[$index] : null;
    }
}
