<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Comida;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Zataca\Foundation\Base\Http\ApiResponse;
use Zataca\Trazer\Bus\CommandBus\Infrastructure\CommandBusFacade;
use Zataca\Trazer\Bus\QueryBus\Infrastructure\QueryBusFacade;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ComidasController extends Controller
{

    public function index()
    {
        $datos['comidas'] = Comida::paginate(10);
        return view('administracion.comidas.index', $datos);

    }
    public function create()
    {
        return view('administracion.comidas.create');
    }


    public function store(Request $request)
    {
        $this->validateComida($request);

        $datoscomidas = $request->only(['nombre', 'calorias']);
        $macros = [
            'proteinas' => $request->proteinas,
            'carbohidratos' => $request->carbohidratos,
            'grasas' => $request->grasas,
        ];
        $datoscomidas['macros'] = json_encode($macros);

        $ingredientes = $request->input('ingredientes', []);  // Obtener los ingredientes, o un array vacío si no se envían.
        $datoscomidas['alimentos'] = json_encode(['ingredientes' => $ingredientes]);
        Comida::insert($datoscomidas);

        // Redirigir con mensaje de éxito
        return redirect('administracion/comidas')->with('Mensaje', 'comida agregado con éxito');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comida = Comida::findOrFail($id);
        $macros = json_decode($comida->macros, true);
        $alimentos = json_decode($comida->alimentos, true);
        return view('administracion.comidas.edit', compact('comida', 'macros', 'alimentos'));

        // compact-> array asociativo de variables y sus valores
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validateComida($request);


        $datoscomidas = $request->only([
            'nombre',
            'calorias',
        ]);
        $macros = [
            'proteinas' => $request->proteinas,
            'carbohidratos' => $request->carbohidratos,
            'grasas' => $request->grasas,
        ];

        $datoscomidas['macros'] = json_encode($macros);
        $ingredientes = $request->input('ingredientes', []);  // Obtener los ingredientes, o un array vacío si no se envían.
        $datoscomidas['alimentos'] = json_encode(['ingredientes' => $ingredientes]);


        $comida = Comida::findOrFail($id);
        $comida->update($datoscomidas);
        return redirect('administracion/comidas')->with('Mensaje', 'Comida actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Comida::destroy($id);
        return redirect('administracion/comidas')->with('Mensaje', 'comida eliminado con exito');
    }


    public function search(Request $request)
    {
        $query = Comida::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('alimentos', 'like', "%{$search}%")
                ->orWhere('id_comida', '=', $search);

        }


        $comidas = $query->paginate(5);
        return view('administracion.comidas.index', ['comidas' => $comidas]);
    }


    public function report()
    {
        // Obtener todos los comidas, por ejemplo con sus roles
        $comidas = Comida::all();

        // Generar el PDF con la vista 'comidas.report' y pasarle los datos
        $pdf = Pdf::loadView('administracion.comidas.report', compact('comidas'));

        // Devolver el PDF al navegador
        return $pdf->stream('comidas.pdf');
    }



    private function validateComida(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:255|unique:comidas,nombre,' . ($request->id_comida ?? ''),
            'calorias' => 'required|integer',
            'proteinas' => 'required|numeric',
            'grasas' => 'required|numeric',
            'carbohidratos' => 'required|numeric',
            'ingredientes' => 'required|array|min:1',
            'ingredientes.*.nombre' => 'required|string|max:255',
            'ingredientes.*.cantidad' => 'required|string|regex:/^\d+g$/i',
        ], [
            'nombre.required' => 'Nombre obligatorio.',
            'nombre.unique' => 'Ya existe una comida con este nombre.',
            'calorias.required' => 'Calorías obligatorias.',
            'proteinas.required' => 'Proteínas obligatorias.',
            'grasas.required' => 'Grasas obligatorias.',
            'carbohidratos.required' => 'Carbs obligatorios.',
            'ingredientes.required' => 'Agregá al menos un ingrediente.',
            'ingredientes.array' => 'Ingredientes inválidos.',
            'ingredientes.min' => 'Agregá mínimo 1 ingrediente.',
            'ingredientes.*.nombre.required' => 'Falta nombre del ingrediente.',
            'ingredientes.*.nombre.string' => 'Nombre inválido.',
            'ingredientes.*.nombre.max' => 'Nombre muy largo.',
            'ingredientes.*.cantidad.required' => 'Falta cantidad.',
            'ingredientes.*.cantidad.regex' => 'Usá formato tipo "100g".',
        ]);
    }





}








