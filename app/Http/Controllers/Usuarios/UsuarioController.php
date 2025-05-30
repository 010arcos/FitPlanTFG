<?php

declare(strict_types=1);

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class UsuarioController extends Controller
{


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

        if ($user->hasRole('admin')) {
            return redirect()->route('administracion');
        } else {
            return view('usuario.index', compact('dietas', 'rutinas', 'dietasOrganizadas', 'user'));
        }


    }


    public function indexRutina()
    {
        $usuario = Auth::user();
        $idUsuario = $usuario->id;
        $user = User::findOrFail($idUsuario);

        $rutinas = $user->rutinas()->with('ejercicios')->get();

        if ($user->hasRole('admin')) {
            return redirect()->route('administracion');
        } else {
            return view('usuario.rutina', compact('rutinas'));
        }

    }


    public function indexDieta()
    {
        $usuario = Auth::user();
        $idUsuario = $usuario->id;
        $user = User::findOrFail($idUsuario);

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

        if ($user->hasRole('admin')) {
            return redirect()->route('administracion');
        } else {
            return view('usuario.dieta', compact('dietas', 'dietasOrganizadas'));
        }

    }


    public function indexProgreso()
    {
        $usuario = Auth::user();
        $idUsuario = $usuario->id;
        $user = User::findOrFail($idUsuario);
        if ($user->hasRole('admin')) {
            return redirect()->route('administracion');
        } else {
            return view('usuario.progreso');
        }
    }

}
