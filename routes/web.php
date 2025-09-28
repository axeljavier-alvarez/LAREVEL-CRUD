<?php

use Illuminate\Support\Facades\Route;
// ACCEDER A ESE CONTROLADOR
use App\Http\Controllers\EmpleadoController;


Route::get('/', function () {
    return view('auth.login');
});


// INDEX Y LLAMAMOS DIRECTAMENTE AL VIEW
/* Route::get('/empleado', function () {
    return view('empleado.index');
}); */
// LLAMANDO AL CONTROLADOR DONDE ESTA LA FUNCION
/* Route::get('/empleado/create', [

    EmpleadoController :: class, 'create'
]);*/

// PUEDO ACCEDER A TODO CON ESTO
// Route::resource('empleado', EmpleadoController::class);
// Auth::routes();

Route::resource('empleado', EmpleadoController::class)->middleware('auth');
// temporal comentada ya que no la necesito anymore
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// desaparecer register y reset password
Auth::routes(['register'=>false, 'reset'=>false]);
Route::get('/home',  [EmpleadoController::class, 'index'])->name('home');
// MIDDLEWARE user
Route::group(['middleware'=>'auth'], function(){
        Route::get('/',  [EmpleadoController::class, 'index'])->name('home');

});
