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
            // 15 ejercicios de pecho
            ['nombre' => 'Press de banca', 'descripcion' => 'Ejercicio para trabajar el pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 1
            ['nombre' => 'Flexiones', 'descripcion' => 'Ejercicio básico para el pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 2
            ['nombre' => 'Press inclinado con mancuernas', 'descripcion' => 'Trabaja la parte superior del pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 3
            ['nombre' => 'Aperturas con mancuernas', 'descripcion' => 'Ejercicio para abrir el pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 4
            ['nombre' => 'Fondos en paralelas', 'descripcion' => 'Ejercicio para pecho y tríceps', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 5
            ['nombre' => 'Press declinado', 'descripcion' => 'Trabaja la parte inferior del pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 6
            ['nombre' => 'Cruce de poleas', 'descripcion' => 'Ejercicio para definición del pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 7
            ['nombre' => 'Press con máquina', 'descripcion' => 'Ejercicio guiado para pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 8
            ['nombre' => 'Push-up con aplauso', 'descripcion' => 'Ejercicio pliométrico para pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 9
            ['nombre' => 'Press con barra en banco', 'descripcion' => 'Ejercicio clásico para fuerza en pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 10
            ['nombre' => 'Flexiones inclinadas', 'descripcion' => 'Trabaja parte inferior del pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 11
            ['nombre' => 'Pullover con mancuerna', 'descripcion' => 'Ejercicio para pecho y caja torácica', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 12
            ['nombre' => 'Press con mancuernas', 'descripcion' => 'Ejercicio para fuerza y control del pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 13
            ['nombre' => 'Flexiones declinadas', 'descripcion' => 'Mayor énfasis en la parte superior del pecho', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 14
            ['nombre' => 'Fondos en anillas', 'descripcion' => 'Ejercicio avanzado para pecho y tríceps', 'zona' => 'pecho', 'tipo' => 'fuerza'], // id 15

            // 15 ejercicios de espalda
            ['nombre' => 'Remo con barra', 'descripcion' => 'Ejercicio para trabajar la espalda', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 16
            ['nombre' => 'Jalón al pecho', 'descripcion' => 'Ejercicio para dorsal ancho', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 17
            ['nombre' => 'Peso muerto', 'descripcion' => 'Ejercicio para espalda baja y piernas', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 18
            ['nombre' => 'Remo en máquina', 'descripcion' => 'Ejercicio para trabajar el medio de la espalda', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 19
            ['nombre' => 'Pull-over con mancuerna', 'descripcion' => 'Ejercicio para ampliar la caja torácica y espalda', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 20
            ['nombre' => 'Dominadas', 'descripcion' => 'Ejercicio básico para espalda y brazos', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 21
            ['nombre' => 'Remo con mancuerna', 'descripcion' => 'Ejercicio unilateral para espalda', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 22
            ['nombre' => 'Peso muerto rumano', 'descripcion' => 'Ejercicio para isquiotibiales y espalda baja', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 23
            ['nombre' => 'Face pulls', 'descripcion' => 'Ejercicio para trapecios y deltoides posteriores', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 24
            ['nombre' => 'Remo invertido', 'descripcion' => 'Ejercicio con peso corporal para espalda', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 25
            ['nombre' => 'Hiperextensiones', 'descripcion' => 'Ejercicio para espalda baja', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 26
            ['nombre' => 'Jalón tras nuca', 'descripcion' => 'Ejercicio para dorsal ancho', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 27
            ['nombre' => 'Pull-ups con agarre estrecho', 'descripcion' => 'Ejercicio avanzado para espalda', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 28
            ['nombre' => 'Remo en cable sentado', 'descripcion' => 'Ejercicio para control muscular de espalda', 'zona' => 'espalda', 'tipo' => 'fuerza'], // id 29
            ['nombre' => 'Bird-dog', 'descripcion' => 'Ejercicio de estabilidad para espalda baja', 'zona' => 'espalda', 'tipo' => 'resistencia'], // id 30

            // 15 ejercicios de hombros
            ['nombre' => 'Elevaciones laterales', 'descripcion' => 'Ejercicio para trabajar hombros', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 31
            ['nombre' => 'Press militar', 'descripcion' => 'Ejercicio para fortalecer los hombros', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 32
            ['nombre' => 'Pájaros', 'descripcion' => 'Ejercicio para deltoides posteriores', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 33
            ['nombre' => 'Encogimientos de hombros', 'descripcion' => 'Ejercicio para trapecios', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 34
            ['nombre' => 'Elevaciones frontales', 'descripcion' => 'Ejercicio para deltoides frontales', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 35
            ['nombre' => 'Press Arnold', 'descripcion' => 'Variante de press para hombros', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 36
            ['nombre' => 'Face pulls', 'descripcion' => 'Ejercicio para deltoides posteriores', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 37
            ['nombre' => 'Remo al cuello', 'descripcion' => 'Ejercicio para trapecios y hombros', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 38
            ['nombre' => 'Elevaciones en máquina', 'descripcion' => 'Ejercicio guiado para hombros', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 39
            ['nombre' => 'Press con mancuernas sentado', 'descripcion' => 'Ejercicio para fuerza de hombros', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 40
            ['nombre' => 'Rotaciones externas con banda', 'descripcion' => 'Ejercicio para rotadores del manguito', 'zona' => 'hombros', 'tipo' => 'resistencia'], // id 41
            ['nombre' => 'Elevaciones frontales con disco', 'descripcion' => 'Ejercicio para deltoides frontales', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 42
            ['nombre' => 'Remo en T', 'descripcion' => 'Ejercicio para trapecios y deltoides posteriores', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 43
            ['nombre' => 'Pájaros con mancuernas sentado', 'descripcion' => 'Ejercicio para deltoides posteriores', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 44
            ['nombre' => 'Press militar con barra', 'descripcion' => 'Ejercicio clásico para fuerza de hombros', 'zona' => 'hombros', 'tipo' => 'fuerza'], // id 45

            // 15 ejercicios de pierna
            ['nombre' => 'Sentadillas', 'descripcion' => 'Ejercicio básico para piernas', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 46
            ['nombre' => 'Prensa de piernas', 'descripcion' => 'Ejercicio para fortalecer piernas', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 47
            ['nombre' => 'Zancadas', 'descripcion' => 'Ejercicio para piernas y glúteos', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 48
            ['nombre' => 'Peso muerto rumano', 'descripcion' => 'Ejercicio para isquiotibiales y glúteos', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 49
            ['nombre' => 'Saltos pliométricos', 'descripcion' => 'Ejercicio explosivo para piernas', 'zona' => 'pierna', 'tipo' => 'cardio'], // id 50
            ['nombre' => 'Extensiones de piernas', 'descripcion' => 'Ejercicio para cuádriceps', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 51
            ['nombre' => 'Curl femoral', 'descripcion' => 'Ejercicio para isquiotibiales', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 52
            ['nombre' => 'Elevación de talones', 'descripcion' => 'Ejercicio para gemelos', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 53
            ['nombre' => 'Sentadilla búlgara', 'descripcion' => 'Ejercicio unilateral para piernas', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 54
            ['nombre' => 'Step-ups', 'descripcion' => 'Ejercicio para glúteos y piernas', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 55
            ['nombre' => 'Saltos en caja', 'descripcion' => 'Ejercicio pliométrico para piernas', 'zona' => 'pierna', 'tipo' => 'cardio'], // id 56
            ['nombre' => 'Sentadilla sumo', 'descripcion' => 'Variante para glúteos y aductores', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 57
            ['nombre' => 'Hip thrust', 'descripcion' => 'Ejercicio para glúteos', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 58
            ['nombre' => 'Peso muerto con piernas rígidas', 'descripcion' => 'Ejercicio para isquiotibiales', 'zona' => 'pierna', 'tipo' => 'fuerza'], // id 59
            ['nombre' => 'Patinador lateral', 'descripcion' => 'Ejercicio pliométrico para piernas y equilibrio', 'zona' => 'pierna', 'tipo' => 'cardio'], // id 60
        ]);

    }
}
