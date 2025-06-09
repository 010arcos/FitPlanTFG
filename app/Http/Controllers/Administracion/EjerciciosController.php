<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class EjerciciosController extends Controller
{

    public function index()
    {
        $datos['ejercicios'] = Ejercicio::paginate(6);
        return view('administracion.ejercicios.index', $datos);

    }
    public function create()
    {
        return view('administracion.ejercicios.create');
    }


    public function store(Request $request)
    {
        $this->validateEjercicio($request);
        $datosEjercicios = $request->except('_token');
        Ejercicio::insert($datosEjercicios);



        return redirect('administracion/ejercicios')->with('Mensaje', 'Ejercicio agregado con éxito');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $ejercicio = Ejercicio::findOrFail($id);

        return view('administracion.ejercicios.edit', compact('ejercicio'));

        // compact-> array asociativo de variables y sus valores
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->merge(['id_ejercicio' => $id]);

        $this->validateEjercicio($request);

        $datosEjercicios = request()->only([
            'nombre',
            'descripcion',
            'zona',
            'tipo',


        ]);

        $ejercicio = Ejercicio::findOrFail($id);
        $ejercicio->update($datosEjercicios);
        return redirect('administracion/ejercicios')->with('Mensaje', 'Ejercicio actualizado con éxito');
    }

    
    public function destroy($id)
    {

        Ejercicio::destroy($id);
        return redirect('administracion/ejercicios')->with('Mensaje', 'Ejercicio eliminado con exito');
    }


    public function search(Request $request)
    {
        $query = Ejercicio::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('zona', 'like', "%{$search}%")
                ->orWhere('tipo', '=', $search);

        }


        $ejercicios = $query->paginate(5);
        return view('administracion.ejercicios.index', ['ejercicios' => $ejercicios]);
    }


    public function report()
    {
        // Obtener todos los comidas, por ejemplo con sus roles
        $ejercicios = Ejercicio::all();

        // Generar el PDF con la vista 'comidas.report' y pasarle los datos
        $pdf = Pdf::loadView('administracion.ejercicios.report', compact('ejercicios'));

        // Devolver el PDF al navegador
        return $pdf->stream('ejercicios.pdf');
    }



    public function validateEjercicio(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:255|unique:ejercicios,nombre,' . ($request->id_ejercicio ?? '') . ',id_ejercicio',
            'descripcion' => 'required|string|max:500',
            'zona' => [
                'required',
                'string',
                'max:50',
                'in:pecho,espalda,hombros,pierna,brazos,abdomen,cardio,fullbody'
            ],
            'tipo' => [
                'required',
                'string',
                'max:50',
                'in:fuerza,resistencia,cardio,flexibilidad'
            ],
        ], [
            'nombre.required' => 'El nombre del ejercicio es obligatorio.',
            'nombre.unique' => 'Ya existe un ejercicio con este nombre.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',
            'descripcion.required' => 'La descripción del ejercicio es obligatoria.',
            'descripcion.max' => 'La descripción no puede exceder los 500 caracteres.',
            'zona.required' => 'La zona del ejercicio es obligatoria.',
            'zona.in' => 'La zona seleccionada no es válida. Opciones: pecho, espalda, hombros, pierna, brazos, abdomen, cardio, fullbody.',
            'tipo.required' => 'El tipo de ejercicio es obligatorio.',
            'tipo.in' => 'El tipo seleccionado no es válido. Opciones: fuerza, resistencia, cardio, flexibilidad.',
        ]);
    }


}


