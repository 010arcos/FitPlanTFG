<?php

namespace App\Http\Controllers\Administracion;

use App\Models\Dieta; // Importar el modelo Dieta
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Importar DB para consultas directas


class UsuariosController
{

    public function index()
    {
        $datos['usuarios'] = User::where('id', '!=', 1)->paginate(5);
        return view('administracion.usuarios.index', $datos);

    }


    public function indexUsuario()
    {

        $usuario = Auth::user();
        $idUsuario = $usuario->id;
        $user = User::findOrFail($idUsuario);
        // Obtener las rutinas del usuario
        $rutinas = $user->rutinas()->with('ejercicios')->get();

        
        $dietas = $user->dietas()->with('comidas')->get();



        // Organizar las dietas para mostrarlas en la vista
        $dietasOrganizadas = [];

        foreach ($dietas as $dieta) {
            $dietasOrganizadas[$dieta->id_dieta] = [
                'info' => $dieta,
                'comidas' => []
            ];

            foreach ($dieta->comidas as $comida) {
                $tipoComida = $comida->pivot->tipo_comida;

                if (!isset($dietasOrganizadas[$dieta->id_dieta]['comidas'][$tipoComida])) {
                    $dietasOrganizadas[$dieta->id_dieta]['comidas'][$tipoComida] = [];
                }

                $dietasOrganizadas[$dieta->id_dieta]['comidas'][$tipoComida][] = $comida;
            }
        }

        return view('usuario.index', compact('dietas', 'rutinas', 'dietasOrganizadas'));
    }



    public function create()
    {
        $dietas = Dieta::all(); // Obtener todas las dietas
        return view('administracion.usuarios.create', compact('dietas'));
    }


    public function store(Request $request)
    {
        // Validar los datos del usuario usando el método común
        $this->validateUser($request);

        // // Validar si la dieta seleccionada ya está asignada al usuario
        // $this->validateDieta($request);

        $dietas = $request->input('dietas');
        $datosUsuarios = $request->except(['_token', 'dietas']);

        $usuario = User::create($datosUsuarios);
        // Asignar la dieta al usuario en la tabla pivote
        $usuario->dietas()->attach($dietas);

        // Redirigir con mensaje de éxito
        return redirect('administracion/usuarios')->with('Mensaje', 'Usuario agregado con éxito');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $dietasAsociadas = $usuario->dietas->pluck('id_dieta')->toArray();
        $dietas = Dieta::all();
        return view('administracion.usuarios.edit', compact('usuario', 'dietas', 'dietasAsociadas'));

        // compact-> array asociativo de variables y sus valores
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validateUser($request, $id);

        // // Validar si la dieta seleccionada ya está asignada al usuario
        // $this->validateDieta($request);

        $datosUsuarios = $request->only([
            'name',
            'email',
            'password',
            'apellido',
            'edad',
            'altura',
            'peso',
            'genero',
            'activo'
        ]);

        $datosUsuarios['activo'] = $request->has('activo');
        $usuario = User::findOrFail($id);
        $usuario->update($datosUsuarios);

        $dietas = $request->input('dietas');
        $usuario->dietas()->sync($dietas);

        return redirect('administracion/usuarios')->with('Mensaje', 'Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        User::destroy($id);
        return redirect('administracion/usuarios')->with('Mensaje', 'Usuario eliminado con exito');
    }


    public function search(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('apellido', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('id', '=', $search);

        }


        $usuarios = $query->paginate(5);
        return view('administracion.usuarios.index', ['usuarios' => $usuarios]);
    }


    public function report()
    {
        // Obtener todos los usuarios, por ejemplo con sus roles
        $usuarios = User::where('id', '!=', 1)->get();

        // Generar el PDF con la vista 'usuarios.report' y pasarle los datos
        $pdf = Pdf::loadView('administracion.usuarios.report', compact('usuarios'));

        // Devolver el PDF al navegador
        return $pdf->stream('usuarios.pdf');
    }





    private function validateUser(Request $request, $id = null)
    {
        $rules = [
            "name" => "required|regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/", // Permite letras, números y espacios.
            "email" => "required|email|unique:users,email,{$id}", // Valida correo único (excluye el actual en el update)
            "password" => "required", // Requiere confirmación de contraseña
            "apellido" => "required|string|max:255",
            "edad" => "required|integer|min:0",
            "altura" => "required|numeric|min:0",
            "peso" => "required|numeric|min:0",
            "genero" => "required|string",
            "activo" => "required|boolean",
        ];

        $messages = [
            "required" => "El :attribute es requerido",
            "name.regex" => "El campo name debe contener solo letras, números y espacios.",
            "email.unique" => "El correo electrónico ya está registrado.",
            "password.required" => "La contraseña es obligatoria.",
            "email.email" => "El correo electrónico debe ser válido.",
            "edad.integer" => "La edad debe ser un número entero.",
            "altura.numeric" => "La altura debe ser un número.",
            "peso.numeric" => "El peso debe ser un número.",
        ];

        $request->validate($rules, $messages);
    }


    // public function mostrarDietaSemanal($id)
    // {
    //     $usuario = User::find($id);
    //     $dietas = $usuario->dietas; // Obtener las dietas del usuario con sus comidas asociadas

    //     $comidasPorDieta = $usuario->dietas->mapWithKeys(function ($dieta) {
    //         return [$dieta->id_dieta => $dieta->comidas]; // Asociar cada dieta con sus comidas
    //     });

    //     return view('administracion.usuarios.tablaSemanal', compact('comidasPorDieta'));
    // }

    // private function validateDieta(Request $request)
    // {
    //     $request->validate([
    //         'dieta_id' => [
    //             'nullable',
    //             function ($attribute, $value, $fail) use ($request) {
    //                 $usuarioId = $request->id;

    //                 // Verificar en la tabla pivote si la dieta ya está asignada al usuario
    //                 $dietaAsignada = DB::table('pivot_usuario_dieta')
    //                     ->where('user_id', $usuarioId)
    //                     ->where('dieta_id', $value)
    //                     ->exists();

    //                 if ($dietaAsignada) {
    //                     $fail('La dieta seleccionada ya está asignada a este usuario.');
    //                 }
    //             },
    //         ],
    //     ]);
    // }

}
