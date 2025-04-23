<?php


use App\Http\Controllers\Administracion\UsuariosController;
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

Route::middleware(['auth', 'verified'])->group(function () {

    // Grupo de rutas con el prefijo "administracion"
    Route::prefix('administracion')->name('administracion.')->group(function() {
        Route::get('usuarios/search', [UsuariosController::class, 'search'])->name('usuarios.search');
        Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
        Route::get('usuarios/report', [UsuariosController::class, 'report'])->name('usuarios.reportPDF');
        Route::get('usuarios/{id}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
        Route::put('usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
        Route::get('usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
        Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
        Route::post('usuarios', [UsuariosController::class, 'store'])->name('usuarios.guardar');
        
    });




});



require __DIR__.'/auth.php';
