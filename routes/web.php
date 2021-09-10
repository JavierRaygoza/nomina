<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Llama a la vista <<welcome>> que se usa como vista principal
Route::get('/', function () {return view('welcome');});
/* Conjunto de rutas que permite asignarles el tipo de petición y la función 
| que ejecutara en el controlador todo bajo el nombre de empleados, exepto
| las funciones y rutas de <<show>> y <<destroy>>, ya que la de <<show>> se trabaja
| en el FontEnd y la de <<destroy>> se trabaja mediante una actualización con borrado
| lógico*/
Route::apiResource('empleados', 'EmpleadosController', ['except' => ['show', 'destroy']]);
// Ruta que permite la actualización de estados en los registros
Route::put('empleados/estado/{id}', 'EmpleadosController@estados');
