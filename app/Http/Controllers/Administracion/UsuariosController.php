<?php

namespace App\Http\Controllers\Administracion;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class UsuariosController 
{
    /**
     * Display a listing of the resource.
     */
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

        $request->validate([
            "name" => "required|regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/", // Permite letras, números y espacios.
            
        ], 
        [
            "required" => "El :attribute es requerido",
            "name.regex" => "El campo name debe contener solo letras, números y espacios.",
           
        ]);
        
        $datosUsuarios = $request->except('_token');
        User::insert($datosUsuarios);
        return redirect('administracion/usuarios')->with('Mensaje', 'Usuario agregado con exito'); //me redirecion al index y le envio una array asociaticvo
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
        // Validación de los campos del formulario
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]+$/', // Permite letras, números y espacios.
            'apellido' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'altura' => 'nullable|numeric|min:0',
            'peso' => 'nullable|numeric|min:0',
            'genero' => 'nullable|string',
            'activo' => 'nullable|boolean',
        ], 
        [
            'required' => 'El :attribute es requerido',
            'name.regex' => 'El campo name debe contener solo letras, números y espacios.',
            'edad.integer' => 'La edad debe ser un número entero.',
            'altura.numeric' => 'La altura debe ser un número.',
            'peso.numeric' => 'El peso debe ser un número.',
        ]);
    
        // Obtener los datos del formulario
        $datosUsuarios = $request->only([
            'name', 'apellido', 'edad', 'altura', 'peso', 'genero', 'activo'
        ]);
    
        // Asegúrate de que el campo "activo" se convierte en un booleano si se ha marcado
        $datosUsuarios['activo'] = $request->has('activo');
    
        // Actualizar el usuario en la base de datos
        $usuario = User::findOrFail($id);
        $usuario->update($datosUsuarios);
    
        // Redirigir con un mensaje de éxito
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

}
