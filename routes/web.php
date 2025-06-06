<?php

use App\Http\Controllers\Administracion\ComidasController;
use App\Http\Controllers\Administracion\DietasController;
use App\Http\Controllers\Administracion\EjerciciosController;
use App\Http\Controllers\Administracion\RutinasController;
use App\Http\Controllers\Administracion\UsuariosController;
use App\Http\Controllers\Usuarios\UsuarioController;
use App\Models\Dieta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Ruta Publica
Route::get('/', function () {
    return view('welcome');
});






Route::get('/administracion', function () {
    return view('administracion');
})->middleware(['auth', 'verified', 'admin'])->name('administracion');


// Rutas Usuario (verificar esta ruta entra en conflicto con la de welcome)
// Route::get('/usuario/index', [UsuarioController::class, 'indexUsuario'])
//     ->name('usuario.index')
//     ->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified', 'check.active'])->prefix('usuario')->name('usuario.')->group(function () {
    Route::get('/index', [UsuarioController::class, 'indexUsuario'])->name('index');
    Route::get('/dieta', [UsuarioController::class, 'indexDieta'])->name('dieta');
    Route::get('/progreso', [UsuarioController::class, 'indexProgreso'])->name('progreso');
    Route::get('/rutina', [UsuarioController::class, 'indexRutina'])->name('rutina');
    Route::get('/historial-peso', [UsuarioController::class, 'indexHistorialPeso'])->name('historial.peso');
    Route::post('/progreso-store', [UsuarioController::class, 'storeProgreso'])->name('progreso.store');
});

// Route::get('/inactive', function () {
//     return view('inactive');
// })->name('inactive');

Route::middleware(['auth', 'verified', 'admin'])->prefix('administracion')->name('administracion.')->group(function () {

    // Usuarios
    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('index');
        Route::get('create', [UsuariosController::class, 'create'])->name('create');
        Route::post('/', [UsuariosController::class, 'store'])->name('guardar');
        Route::get('search', [UsuariosController::class, 'search'])->name('search');
        Route::get('report', [UsuariosController::class, 'report'])->name('reportPDF');
        Route::get('{id}/edit', [UsuariosController::class, 'edit'])->name('edit');
        Route::put('{id}', [UsuariosController::class, 'update'])->name('update');
        Route::delete('{id}', [UsuariosController::class, 'destroy'])->name('destroy');

    });

    // Dietas
    Route::prefix('dietas')->name('dietas.')->group(function () {
        Route::get('/', [DietasController::class, 'index'])->name('index');
        Route::get('create', [DietasController::class, 'create'])->name('create');
        Route::post('/', [DietasController::class, 'store'])->name('guardar');
        Route::get('search', [DietasController::class, 'search'])->name('search');
        Route::get('report', [DietasController::class, 'report'])->name('reportPDF');
        Route::get('{id}/edit', [DietasController::class, 'edit'])->name('edit');
        Route::put('{id}', [DietasController::class, 'update'])->name('update');
        Route::delete('{id}', [DietasController::class, 'destroy'])->name('destroy');
        Route::get('usuario/{id}/semana', [DietasController::class, 'mostrarDietaSemanal'])->name('dietasemana');
        Route::get('/{id}/asignar/comida/', [DietasController::class, 'asignarComidaDieta'])->name('asignar.comida');
        Route::post('/{id}/guardar/comidas/', [DietasController::class, 'guardarComidaDieta'])->name('guardar.comida');
        Route::delete('/usuario/{usuario_id}/eliminar/{dieta_id}', [DietasController::class, 'eliminarDietaUsuario'])->name('eliminar.dieta.usuario');
    });

    // Comidas
    Route::prefix('comidas')->name('comidas.')->group(function () {
        Route::get('/', [ComidasController::class, 'index'])->name('index');
        Route::get('create', [ComidasController::class, 'create'])->name('create');
        Route::post('/', [ComidasController::class, 'store'])->name('guardar');
        Route::get('search', [ComidasController::class, 'search'])->name('search');
        Route::get('report', [ComidasController::class, 'report'])->name('reportPDF');
        Route::get('{id}/edit', [ComidasController::class, 'edit'])->name('edit');
        Route::put('{id}', [ComidasController::class, 'update'])->name('update');
        Route::delete('{id}', [ComidasController::class, 'destroy'])->name('destroy');
    });


    // Ejercicios // cambiar el controlador // 
    Route::prefix('ejercicios')->name('ejercicios.')->group(function () {
        Route::get('/', [EjerciciosController::class, 'index'])->name('index');
        Route::get('create', [EjerciciosController::class, 'create'])->name('create');
        Route::post('/', [EjerciciosController::class, 'store'])->name('guardar');
        Route::get('search', [EjerciciosController::class, 'search'])->name('search');
        Route::get('report', [EjerciciosController::class, 'report'])->name('reportPDF');
        Route::get('{id}/edit', [EjerciciosController::class, 'edit'])->name('edit');
        Route::put('{id}', [EjerciciosController::class, 'update'])->name('update');
        Route::delete('{id}', [EjerciciosController::class, 'destroy'])->name('destroy');
    });



    // Rutinas // // cambiar el controlador // 
    Route::prefix('rutinas')->name('rutinas.')->group(function () {
        Route::get('/', [RutinasController::class, 'index'])->name('index');
        Route::get('create', [RutinasController::class, 'create'])->name('create');
        Route::post('/', [RutinasController::class, 'store'])->name('guardar');
        Route::get('search', [RutinasController::class, 'search'])->name('search');
        Route::get('report', [RutinasController::class, 'report'])->name('reportPDF');
        Route::get('{id}/edit', [RutinasController::class, 'edit'])->name('edit');
        Route::put('{id}', [RutinasController::class, 'update'])->name('update');
        Route::delete('{id}', [RutinasController::class, 'destroy'])->name('destroy');
        Route::get('usuario/{id}/semana', [RutinasController::class, 'mostrarRutinaSemanal'])->name('rutinasemana');
        Route::get('/{id}/asignar/ejercicio/', [RutinasController::class, 'asignarEjercicioRutina'])->name('asignar.ejercicio');
        Route::post('/{id}/guardar/ejercicios/', [RutinasController::class, 'guardarEjercicioRutina'])->name('guardar.ejercicio');


        Route::get('/usuario/{id}/asignar', [RutinasController::class, 'asignarRutinasUsuario'])
            ->name('asignar.usuario');

        Route::post('/administracion/usuarios/{id}/rutinas/guardar', [RutinasController::class, 'guardarRutinasUsuario'])
            ->name('guardar.usuario');


        Route::delete('/usuario/{usuario_id}/eliminar/{id_rutina}', [RutinasController::class, 'eliminarRutinaUsuario'])->name('eliminar.dieta.usuario');
    });








});



require __DIR__ . '/auth.php';
