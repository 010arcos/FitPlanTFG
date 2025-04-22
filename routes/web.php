<?php


use App\Http\Controllers\Adminastracion\UsuariosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//ruta que entrar cualquier persona 
Route::get('/', function () {
    return view('welcome');
});


//Ruta que donde entrara solo el admin 
Route::get('/dashboard', function () {
    $user = Auth::user(); 
    $admin= $user->roles->first()->name;
    if($admin == 'admin'){
        return view('dashboard');
    } else{
        Auth::logout();
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {

   
    Route::get('administracion/search', [UsuariosController::class, 'search']);
    Route::resource('administracion', UsuariosController::class);
    Route::get('administracion/search', [UsuariosController::class, 'search'])->name('usuarios.search');
    Route::get('administracion/report', [UsuariosController::class, 'report'])->name('usuarios.reportPDF');
    Route::resource('usuarios', UsuariosController::class);
});







require __DIR__.'/auth.php';
