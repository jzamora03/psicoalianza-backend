<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\PaisController;

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

Route::get('/', function () {
    return redirect()->route('empleados.index');
});


/** RESOURCE **/

Route::resource('empleados', EmpleadoController::class);
Route::resource('cargos', CargoController::class);
Route::resource('ciudades', CiudadController::class);
Route::resource('paises', PaisController::class);




