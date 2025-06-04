<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsActive
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->activo != 1) {
            // Permitir acceso solo a la ruta 'usuario.index'
            if ($request->route()->getName() !== 'usuario.index') {
                // Redirigir a la vista de usuario index con un mensaje de error
                return redirect()->route('usuario.index')->with('error', 'Tu cuenta está inactiva. No puedes acceder a otras secciones.');
            }
        }

        return $next($request);
    }
}