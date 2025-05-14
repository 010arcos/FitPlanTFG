<?php

use App\Http\Controllers\Administracion\ComidasController;
use App\Http\Controllers\Administracion\DietasController;
use App\Http\Controllers\Administracion\UsuariosController;
use App\Models\Dieta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Ruta Publica
Route::get('/', function () {
    return view('welcome');
});


//Ruta Protegidas

// Route::get('/administracion', function () {
//     $user = Auth::user();
//     $adminRole = $user->roles->first()->name;

//     if ($adminRole == 'admin') {
//         return view('administracion');
//     } else {
//         return redirect()->route('usuario.index');
//     }
// })->middleware(['auth', 'verified'])->name('administracion');

// // Ruta Usuario
// Route::get('/usuario/index', function () {
//     $user = Auth::user();
//     $userRole = $user->roles->contains('name', 'user');

//     if ($userRole) {
//         return view('usuario.index');
//     } else {
//         return redirect()->route('administracion');
//     }
// })->middleware(['auth', 'verified'])->name('usuario.index');



Route::get('/administracion', function () {
    return view('administracion');
})->middleware(['auth', 'verified', 'admin'])->name('administracion');


Route::get('/usuario/index', function () {
    return view('usuario.index');
})->middleware(['auth', 'verified'])->name('usuario.index');


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


    // Comidas // cambiar el controlador // 
    Route::prefix('ejercicios')->name('ejercicios.')->group(function () {
        Route::get('/', [ComidasController::class, 'index'])->name('index');
        Route::get('create', [ComidasController::class, 'create'])->name('create');
        Route::post('/', [ComidasController::class, 'store'])->name('guardar');
        Route::get('search', [ComidasController::class, 'search'])->name('search');
        Route::get('report', [ComidasController::class, 'report'])->name('reportPDF');
        Route::get('{id}/edit', [ComidasController::class, 'edit'])->name('edit');
        Route::put('{id}', [ComidasController::class, 'update'])->name('update');
        Route::delete('{id}', [ComidasController::class, 'destroy'])->name('destroy');
    });



    // Dietas // // cambiar el controlador // 
    Route::prefix('rutinas')->name('rutinas.')->group(function () {
        Route::get('/', [DietasController::class, 'index'])->name('index');
        Route::get('create', [DietasController::class, 'create'])->name('create');
        Route::post('/', [DietasController::class, 'store'])->name('guardar');
        Route::get('search', [DietasController::class, 'search'])->name('search');
        Route::get('report', [DietasController::class, 'report'])->name('reportPDF');
        Route::get('{id}/edit', [DietasController::class, 'edit'])->name('edit');
        Route::put('{id}', [DietasController::class, 'update'])->name('update');
        Route::delete('{id}', [DietasController::class, 'destroy'])->name('destroy');
        Route::get('usuario/{id}/semana', [DietasController::class, 'mostrarRutinaSemanal'])->name('rutinasemana');
        Route::get('/{id}/asignar/ejercicio/', [DietasController::class, 'asignarEjercicioRutina'])->name('asignar.ejericio');
        Route::post('/{id}/guardar/ejercicios/', [DietasController::class, 'guardarEjercicioRutina'])->name('guardar.ejercicio');
        Route::delete('/usuario/{usuario_id}/eliminar/{id_rutina}', [DietasController::class, 'eliminarRutinaUsuario'])->name('eliminar.dieta.usuario');
    });


   





});



require __DIR__ . '/auth.php';
