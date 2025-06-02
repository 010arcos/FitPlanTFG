<?php

declare(strict_types=1);

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\HistorialPeso;
use App\Models\User;
use Illuminate\Http\Request;
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


        $datosGraficos = $user->obtenerDatosGraficos();
        $historialPesos = $user->historialPesos()
            ->orderBy('fecha_registro', 'desc')
            ->get();




        if ($user->hasRole('admin')) {
            return redirect()->route('administracion');
        } else {
            return view('usuario.index', compact('datosGraficos', 'user'));
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
        $user = User::findOrFail($usuario->id);

        if ($user->hasRole('admin')) {
            return redirect()->route('administracion');
        }

        // Cargar TODOS los datos aquí
        $datosGraficos = $user->obtenerDatosGraficos();
        $historialPesos = $user->historialPesos()
            ->orderBy('fecha_registro', 'desc')
            ->get();

        return view('usuario.progreso', compact('datosGraficos', 'historialPesos'));
    }






    public function storeProgreso(Request $request)
    {
        $validated = $this->validarDatosProgreso($request);
        $usuario = Auth::user();


        if ($this->verificarRegistroExistente($usuario->id, $validated['fecha_registro'])) {
            return redirect()->back()
                ->withErrors(['fecha_registro' => 'Ya existe un registro para esta fecha.'])
                ->withInput();
        }

        // Crear el nuevo registro
        $historial = $this->crearRegistroHistorial($usuario, $validated);

        // Actualizar el peso del usuario si es el registro más reciente
        $this->actualizarPesoUsuarioSiEsReciente($usuario, $historial, $validated);

        return redirect()->route('usuario.progreso', ['section' => 'medidas'])
            ->with('success', 'Registro guardado correctamente');
    }

    /**
     * Validar los datos del formulario de progreso
     */
    private function validarDatosProgreso(Request $request): array
    {
        return $request->validate([
            'peso' => 'required',
            'altura' => 'nullable',
            'fecha_registro' => 'required',
            'notas' => 'nullable'
        ]);
    }

    /**
     * Verificar si ya existe un registro para la fecha
     */
    private function verificarRegistroExistente(int $idUsuario, string $fecha): bool
    {
        return HistorialPeso::where('id_usuario', $idUsuario)
            ->where('fecha_registro', $fecha)
            ->exists();
    }

    /**
     * Crear el registro en el historial
     */
    private function crearRegistroHistorial(User $usuario, array $validated): HistorialPeso
    {
        return HistorialPeso::create([
            'id_usuario' => $usuario->id,
            'peso' => $validated['peso'],
            'altura' => $validated['altura'] ?? $usuario->altura,
            'fecha_registro' => $validated['fecha_registro'],
            'notas' => $validated['notas']
        ]);
    }

    /**
     * Actualizar el peso del usuario si es el registro más reciente
     */
    private function actualizarPesoUsuarioSiEsReciente(User $usuario, HistorialPeso $historial, array $validated): void
    {
        $ultimoRegistro = $usuario->historialPesos()
            ->orderBy('fecha_registro', 'desc')
            ->first();

        if ($ultimoRegistro && $ultimoRegistro->id_historial === $historial->id_historial) {
            $usuario->update([
                'peso' => $validated['peso'],
                'altura' => $validated['altura'] ?? $usuario->altura
            ]);
        }
    }
}
