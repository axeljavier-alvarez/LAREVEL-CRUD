<?php

use Illuminate\Support\Facades\Route;
// ACCEDER A ESE CONTROLADOR
use App\Http\Controllers\EmpleadoController;


Route::get('/', function () {
    return view('welcome');
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
Route::resource('empleado', EmpleadoController::class);
