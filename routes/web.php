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


//Ruta Admin
Route::get('/administracion', function () {
    $user = Auth::user(); 
    $admin= $user->roles->first()->name;
    if($admin == 'admin'){
        return view('administracion');
    } else{
        Auth::logout();
        return view('welcome');
    }
})->middleware(['auth', 'verified'])->name('administracion');


// Route::middleware(['auth', 'verified'])->group(function () {

   
//     Route::get('administracion/search', [UsuariosController::class, 'search']);
//     Route::resource('administracion', UsuariosController::class);
//     Route::get('administracion/search', [UsuariosController::class, 'search'])->name('administracion.usuarios.search');
//     Route::get('administracion/report', [UsuariosController::class, 'report'])->name('administracion.usuarios.reportPDF');
//     Route::resource('administracion/usuarios', UsuariosController::class);
// });

Route::middleware(['auth', 'verified'])->prefix('administracion')->name('administracion.')->group(function () {

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

    


    // Y así sucesivamente para cada módulo...
});



require __DIR__.'/auth.php';
