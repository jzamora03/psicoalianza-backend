<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CargoController;

use App\Http\Controllers\CiudadController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::apiResource('empleados', EmpleadoController::class);
// Route::apiResource('cargos', CargoController::class);

// Route::resource('empleados', EmpleadoController::class);
// Route::resource('cargos', CargoController::class);
//Route::resource('ciudades', CiudadController::class);

Route::get('/ciudades/{pais_id}', [CiudadController::class, 'ciudadesPorPais']);

