<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use App\Models\Rutina;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Zataca\Foundation\Base\Http\ApiResponse;
use Zataca\Trazer\Bus\CommandBus\Infrastructure\CommandBusFacade;
use Zataca\Trazer\Bus\QueryBus\Infrastructure\QueryBusFacade;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RutinasController extends Controller
{


    public function index()
    {
        $datos['rutinas'] = Rutina::paginate(5);
        return view('administracion.rutinas.index', $datos);

    }
    public function create()
    {
        return view('administracion.rutinas.create');
    }


    public function store(Request $request)
    {
        $this->validateRutina($request);

        $datosrutinas = $request->except('_token');


        Rutina::insert($datosrutinas);


        return redirect('administracion/rutinas')->with('Mensaje', 'rutina agregado con éxito');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rutina = Rutina::findOrFail($id);
        return view('administracion.rutinas.edit', compact('rutina'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $this->validateRutina($request);


        $datosrutinas = $request->only([
            'nombre',
            'descripcion',
            'dia',
            'fecha_inicio',
            'fecha_fin',
        ]);
        $rutina = Rutina::findOrFail($id);
        $rutina->update($datosrutinas);
        return redirect('administracion/rutinas')->with('Mensaje', 'rutina actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Rutina::destroy($id);
        return redirect('administracion/rutinas')->with('Mensaje', 'rutina eliminado con exito');
    }


    public function search(Request $request)
    {
        $query = Rutina::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('id_rutina', '=', $search);

        }





        $rutinas = $query->paginate(5);
        return view('administracion.rutinas.index', ['rutinas' => $rutinas]);
    }


    public function report()
    {
        // Obtener todos los rutinas, por ejemplo con sus roles
        $rutinas = Rutina::all();

        // Generar el PDF con la vista 'rutinas.report' y pasarle los datos
        $pdf = Pdf::loadView('administracion.rutinas.report', compact('rutinas'));

        // Devolver el PDF al navegador
        return $pdf->stream('rutinas.pdf');
    }



    //  USUARIO 

    public function mostrarRutinaSemanal($id)
    {
        // Paso 1: Obtener el usuario
        $usuario = User::findOrFail($id);

        // Paso 2: Obtener las rutinas del usuario usando la relación
        $rutinas = $usuario->rutinas;

        // Paso 3: Organizar los ejercicios por día
        $diasSemana = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];
        $ejerciciosPorDia = [];

        foreach ($diasSemana as $dia) {
            $ejerciciosPorDia[$dia] = [];

            // Filtrar las rutinas que corresponden a este día
            $rutinasDeDia = $rutinas->filter(function ($rutina) use ($dia) {
                return $rutina->dia == $dia;
            });

            foreach ($rutinasDeDia as $rutina) {
                // Obtener todos los ejercicios de esta rutina (ya no filtramos por día en la tabla pivote)
                $ejerciciosDia = $rutina->ejercicios()
                    ->withPivot('series', 'repeticiones')
                    ->get();

                if ($ejerciciosDia->count() > 0) {
                    $ejerciciosPorDia[$dia][] = [
                        'rutina' => $rutina,
                        'ejercicios' => $ejerciciosDia
                    ];
                }
            }
        }

        // Paso 4: Pasar los datos a la vista
        return view('administracion.rutinas.tablaSemanal', compact('usuario', 'rutinas', 'ejerciciosPorDia', 'diasSemana'));
    }




    public function asignarRutinasUsuario($id)
    {
        // Obtener el usuario
        $usuario = User::findOrFail($id);

        // Obtener todas las rutinas con sus ejercicios
        $rutinas = Rutina::with('ejercicios')->get();

        // Obtener las rutinas ya asignadas al usuario
        $rutinasAsignadas = $usuario->rutinas()->pluck('rutinas.id_rutina')->toArray();

        // Preparar las rutinas por día para la vista
        $rutinasPorDia = [
            'lunes' => [],
            'martes' => [],
            'miercoles' => [],
            'jueves' => [],
            'viernes' => [],
          
        ];

        // Agrupar las rutinas por día
        foreach ($rutinas as $rutina) {
            // Usar directamente el día de la rutina
            $diaRutina = $rutina->dia;

            // Si la rutina tiene un día asignado, agregarla al arreglo correspondiente
            if ($diaRutina && array_key_exists($diaRutina, $rutinasPorDia)) {
                $rutinasPorDia[$diaRutina][] = $rutina;
            }
        }

        return view('administracion.rutinas.asignarUsuario', compact(
            'usuario',
            'rutinas',
            'rutinasAsignadas',
            'rutinasPorDia'
        ));
    }





    public function guardarRutinasUsuario(Request $request, $id)
    {
        // Obtener el usuario
        $usuario = User::findOrFail($id);

        // Eliminar todas las asignaciones actuales de rutinas para este usuario
        DB::table('pivot_usuario_rutina')->where('id_usuario', $id)->delete();

        // Obtener las rutinas seleccionadas para cada día
        $diasSemana = [
            'lunes',
            'martes',
            'miercoles',
            'jueves',
            'viernes',
            
        ];

        // Fechas por defecto (30 días)
        $fechaInicio = Carbon::now()->toDateString();
        $fechaFin = Carbon::now()->addDays(30)->toDateString();

        // Recorrer cada día y guardar la rutina seleccionada
        foreach ($diasSemana as $dia) {
            $rutinaId = $request->input('rutina_' . $dia);

            // Si se seleccionó una rutina para este día
            if (!empty($rutinaId)) {
                // Insertar en la tabla pivot con las fechas
                DB::table('pivot_usuario_rutina')->insert([
                    'id_usuario' => $id,
                    'id_rutina' => $rutinaId,
                    'fecha_inicio' => $fechaInicio,
                    'fecha_fin' => $fechaFin,
                ]);
            }
        }

        return redirect('administracion/usuarios')->with('Mensaje', 'Plan de entrenamiento semanal asignado correctamente');
    }







//EJERICIO -RUTINA 

public function asignarEjercicioRutina($id)
    {
        $rutina = Rutina::findOrFail($id);

        // Cargar ejercicios agrupados por zona muscular
        $ejerciciosPorZona = Ejercicio::orderBy('nombre')->get()->groupBy('zona');

        // Obtener ejercicios ya asignados a esta rutina
        $ejerciciosAsignados = $rutina->ejercicios()
            ->withPivot('series', 'repeticiones')
            ->get();

        // Lista de días de la semana para el selector
        $diasSemana = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];

        return view('administracion.rutinas.asignarEjercicios', compact(
            'rutina',
            'ejerciciosPorZona',
            'ejerciciosAsignados',
            'diasSemana'
        ));
    }



    public function guardarEjercicioRutina(Request $request, $id)
    {

        $this->validateEjercicioRutina($request);
        $rutina = Rutina::findOrFail($id);

        // Actualizar el día de la rutina si se ha cambiado
        if ($request->has('dia_rutina')) {
            $rutina->dia = $request->dia_rutina;
            $rutina->save();
        }

        // Eliminar todos los ejercicios actuales de esta rutina
        $rutina->ejercicios()->detach();

        // Obtener los ejercicios seleccionados
        $ejercicios = $request->input('ejercicios', []);
        $series = $request->input('series', []);
        $repeticiones = $request->input('repeticiones', []);

        // Guardar los nuevos ejercicios con sus series y repeticiones
        for ($i = 0; $i < count($ejercicios); $i++) {
            $rutina->ejercicios()->attach($ejercicios[$i], [
                'series' => $series[$i] ?? 3,
                'repeticiones' => $repeticiones[$i] ?? 12,
            ]);
        }

        return redirect()->route('administracion.rutinas.index')
            ->with('Mensaje', 'Ejercicios asignados correctamente a la rutina');
    }







    




    private function validateEjercicioRutina(Request $request)
    {
        return $request->validate([
            'ejercicios' => 'required|array|min:1',
            'series.*' => 'required|integer|min:1',
            'repeticiones.*' => 'required|integer|min:1',
        ], [
            'ejercicios.required' => 'Debes seleccionar al menos un ejercicio',
            'series.*.required' => 'Completa las series para todos los ejercicios',
            'repeticiones.*.required' => 'Completa las repeticiones para todos los ejercicios',
        ]);
    }



    private function validateRutina(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date|before:fecha_fin',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ], [
            'nombre.required' => 'El nombre de la dieta es obligatorio.',
            'nombre.string' => 'El nombre de la dieta debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la dieta no debe superar los 255 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.before' => 'La fecha de inicio debe ser anterior a la fecha de fin.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
        ]);
    }

}
