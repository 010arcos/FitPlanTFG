<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Comida;
use App\Models\Dieta;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Zataca\Foundation\Base\Http\ApiResponse;
use Zataca\Trazer\Bus\CommandBus\Infrastructure\CommandBusFacade;
use Zataca\Trazer\Bus\QueryBus\Infrastructure\QueryBusFacade;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class DietasController extends Controller
{

    public function index()
    {
        $datos['dietas'] = Dieta::paginate(5);
        return view('administracion.dietas.index', $datos);

    }
    public function create()
    {
        return view('administracion.dietas.create');
    }


    public function store(Request $request)
    {
        $this->validateDieta($request);

        $datosdietas = $request->except('_token');

        // Insertar el nuevo dieta en la base de datos
        Dieta::insert($datosdietas);

        // Redirigir con mensaje de éxito
        return redirect('administracion/dietas')->with('Mensaje', 'dieta agregado con éxito');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dieta = Dieta::findOrFail($id);
        return view('administracion.dietas.edit', compact('dieta'));

        // compact-> array asociativo de variables y sus valores
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $this->validateDieta($request);


        $datosdietas = $request->only([
            'nombre',
            'descripcion',
            'fecha_inicio',
            'fecha_fin',
        ]);
        $dieta = Dieta::findOrFail($id);
        $dieta->update($datosdietas);
        return redirect('administracion/dietas')->with('Mensaje', 'dieta actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Dieta::destroy($id);
        return redirect('administracion/dietas')->with('Mensaje', 'dieta eliminado con exito');
    }


    public function search(Request $request)
    {
        $query = Dieta::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('descripcion', 'like', "%{$search}%")
                ->orWhere('id_dieta', '=', $search);

        }


        $dietas = $query->paginate(5);
        return view('administracion.dietas.index', ['dietas' => $dietas]);
    }


    public function report()
    {
        // Obtener todos los dietas, por ejemplo con sus roles
        $dietas = Dieta::all();

        // Generar el PDF con la vista 'dietas.report' y pasarle los datos
        $pdf = Pdf::loadView('administracion.dietas.report', compact('dietas'));

        // Devolver el PDF al navegador
        return $pdf->stream('dietas.pdf');
    }

    public function mostrarDietaSemanal($id)
    {
        $usuario = User::find($id);
        $dietas = $usuario->dietas; // Obtener las dietas del usuario con sus comidas asociadas

        $comidasPorDieta = $usuario->dietas->mapWithKeys(function ($dieta) {
            return [$dieta->id_dieta => $dieta->comidas]; // Asociar cada dieta con sus comidas
        });

        return view('administracion.dietas.tablaSemanal', compact('comidasPorDieta', 'usuario', 'dietas'));
    }


    public function asignarComidaDieta($id)
    {
        $dieta = Dieta::findOrFail($id);
        $comidas = Comida::all(); // Obtener todas las comidas disponibles
        $comidasDieta = $dieta->comidas;
        return view('administracion.dietas.asignarComidas', compact('dieta', 'comidasDieta', 'comidas'));


    }

    public function guardarComidaDieta(Request $request, $id)
    {
        $this->validateGuardarComidaDieta($request);

        $dieta = Dieta::findOrFail($id);

        // Obtener las comidas enviadas
        $comidas = collect($request->input('comidas'));

        // Validar que no se repitan IDs de comidas
       

        // Preparar los datos para sincronizar
        $comidasPreparadas = $comidas->mapWithKeys(function ($idComida, $tipo) {
            return [$idComida => ['tipo_comida' => $tipo]];
        });

        // Sincronizar las comidas con la dieta
        $dieta->comidas()->sync($comidasPreparadas);

        return redirect()->route('administracion.dietas.index')->with('Mensaje', 'Comidas asignadas con éxito a la dieta.');
    }

    public function eliminarDietaUsuario(Request $request)
    {
        // $request->validate([
        //     'usuario_id' => 'required|exists:users,id',
        //     'dieta_id' => 'required|exists:dietas,id_dieta',
        // ]);

        $usuario = User::findOrFail($request->usuario_id);

        // Eliminar la relación entre el usuario y la dieta
        $usuario->dietas()->detach($request->dieta_id);

        return redirect()->back()->with('Mensaje', 'Dieta eliminada del usuario con éxito');
    }




    private function validateGuardarComidaDieta(Request $request)
    {
        $comidas = $request->input('comidas');

        // Obtener solo los valores (los IDs)
        $ids = array_values($comidas);

        // Validar que no haya valores vacíos o nulos
        foreach ($ids as $id) {
            if (empty($id)) {
                throw ValidationException::withMessages([
                    'comidas' => 'Todos los IDs de las comidas deben estar completos.'
                ]);
            }
        }

        // Validar que no haya IDs duplicados
        if (count($ids) !== count(array_unique($ids))) {
            throw ValidationException::withMessages([
                'comidas' => 'No se pueden repetir los IDs de las comidas.'
            ]);
        }
    }

    private function validateDieta(Request $request)
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
