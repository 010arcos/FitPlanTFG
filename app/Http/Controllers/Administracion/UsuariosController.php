<?php

namespace App\Http\Controllers\Administracion;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class UsuariosController 
{
    
    public function index()
    {
        $datos['usuarios'] = User::where('id', '!=', 1)->paginate(5);
        return view('administracion.usuarios.index', $datos);
        
    } 


   public function create()
   {
         return view('administracion.usuarios.create');
    }


    public function store(Request $request)
    {
        // Validar los datos del usuario usando el método común
        $this->validateUser($request);

        // Obtener los datos del formulario
        $datosUsuarios = $request->except('_token');

        // Insertar el nuevo usuario en la base de datos
        User::insert($datosUsuarios);

        // Redirigir con mensaje de éxito
        return redirect('administracion/usuarios')->with('Mensaje', 'Usuario agregado con éxito');
    }


    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('administracion.usuarios.edit', compact('usuario'));

        // compact-> array asociativo de variables y sus valores
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
        $this->validateUser($request, $id);

        $datosUsuarios = $request->only([
            'name', 'email', 'password', 'apellido', 'edad', 'altura', 'peso', 'genero', 'activo'
        ]);

        $datosUsuarios['activo'] = $request->has('activo');
        $usuario = User::findOrFail($id);
        $usuario->update($datosUsuarios);
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
    return view('administracion.usuarios.index', ['usuarios'=>$usuarios]); 
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

}
