<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatosController;
use App\Http\Controllers\ofertaLaboralController;
use App\Http\Controllers\estudioController;
use App\Http\Controllers\telefonoController;
use App\Http\Controllers\profesionController;
use App\Http\Controllers\candidato_profesionController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\contactoEmpresaController;
use App\Http\Controllers\sectorEmpresaController;
use App\Http\Controllers\nominaController;
use App\Http\Controllers\detalleNominaController;
use App\Http\Controllers\experienciaLaboralController;
use App\Http\Controllers\postulacionController;
use App\Http\Controllers\usuarioController;


//Pagina principal y login
Route::get('/', function () {
    return view('welcome');
});

Route::get('/Admin', function () {
    return 'Aqui se va la vista del administrador';
});

//Rutas asociada a usuario
Route::prefix('usuario')->group(function () {
    Route::get('/', [usuarioController::class, 'index']);
    Route::get('/crear', [usuarioController::class, 'crear']);
    Route::post('/guardar', [usuarioController::class, 'guardar']);
    Route::get('/{id}', [usuarioController::class, 'buscar']);
    Route::get('/{id}/modificar', [usuarioController::class, 'modificar']);
    Route::put('/{id}/actualizar', [usuarioController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [usuarioController::class, 'eliminar']);
});


//Rutas asociada a candidatos
Route::prefix('candidatos')->group(function () {
    Route::get('/', [CandidatosController::class, 'index']);
    Route::get('/crear', [CandidatosController::class, 'crear']);
    Route::post('/guardar', [CandidatosController::class, 'guardar']);
    Route::get('/{candidato}', [CandidatosController::class, 'buscar']);
    Route::get('/{id}/modificar', [CandidatosController::class, 'modificar']);
    Route::put('/{id}/actualizar', [CandidatosController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [CandidatosController::class, 'eliminar']);

    Route::get('/experienciaLaboral', [experienciaLaboralController::class, 'index']);
    Route::get('/experienciaLaboral/crear', [experienciaLaboralController::class, 'crear']);
    Route::post('/experienciaLaboral/guardar', [experienciaLaboralController::class, 'guardar']);
    Route::get('/experienciaLaboral/{id}', [experienciaLaboralController::class, 'buscar']);
    Route::get('/experienciaLaboral/{id}/modificar', [experienciaLaboralController::class, 'modificar']);
    Route::put('/experienciaLaboral/{id}/actualizar', [experienciaLaboralController::class, 'actualizar']);
    Route::delete('/experienciaLaboral/{id}/eliminar', [experienciaLaboralController::class, 'eliminar']);

    Route::get('/telefono', [telefonoController::class, 'index']);
    Route::get('/telefono/crear', [telefonoController::class, 'crear']);
    Route::post('/telefono/guardar', [telefonoController::class, 'guardar']);
    Route::get('/telefono/{id}', [telefonoController::class, 'buscar']);
    Route::get('/telefono/{id}/modificar', [telefonoController::class, 'modificar']);
    Route::put('/telefono/{id}/actualizar', [telefonoController::class, 'actualizar']);
    Route::delete('/telefono/{id}/eliminar', [telefonoController::class, 'eliminar']);

    Route::get('/estudio', [estudioController::class, 'index']);
    Route::get('/estudio/crear', [estudioController::class, 'crear']);
    Route::post('/estudio/guardar', [estudioController::class, 'guardar']);
    Route::get('/estudio/{id}', [estudioController::class, 'buscar']);
    Route::get('/estudio/{id}/modificar', [estudioController::class, 'modificar']);
    Route::put('/estudio/{id}/actualizar', [estudioController::class, 'actualizar']);
    Route::delete('/estudio/{id}/eliminar', [estudioController::class, 'eliminar']);
});

//Rutas asociada a Profesion
Route::prefix('profesion')->group(function () {

    Route::get('/profesion', [profesionController::class, 'index']);
    Route::get('/profesion/crear', [profesionController::class, 'crear']);
    Route::post('/profesion/guardar', [profesionController::class, 'guardar']);
    Route::get('/profesion/{id}', [profesionController::class, 'buscar']);
    Route::get('/profesion/{id}/modificar', [profesionController::class, 'modificar']);
    Route::put('/profesion/{id}/actualizar', [profesionController::class, 'actualizar']);
    Route::delete('/profesion/{id}/eliminar', [profesionController::class, 'eliminar']);

    Route::get('/candidato_profesion', [candidato_profesionController::class, 'index']);
    Route::get('/candidato_profesion/crear', [candidato_profesionController::class, 'crear']);
    Route::post('/candidato_profesion/guardar', [candidato_profesionController::class, 'guardar']);
    Route::get('/candidato_profesion/{id}', [candidato_profesionController::class, 'buscar']);
    Route::get('/candidato_profesion/{id}/modificar', [candidato_profesionController::class, 'modificar']);
    Route::put('/candidato_profesion/{id}/actualizar', [candidato_profesionController::class, 'actualizar']);
    Route::delete('/candidato_profesion/{id}/eliminar', [candidato_profesionController::class, 'eliminar']);
});

//Rutas asociada a empresa
Route::prefix('empresa')->group(function () {
    Route::get('/empresa', [EmpresaController::class, 'index']);
    Route::get('/empresa/crear', [EmpresaController::class, 'crear']);
    Route::post('/empresa/guardar', [EmpresaController::class, 'guardar']);
    Route::get('/empresa/{id}', [EmpresaController::class, 'mostrar']);
    Route::get('/empresa/{id}/modificar', [EmpresaController::class, 'modificar']);
    Route::put('/empresa/{id}/actualizar', [EmpresaController::class, 'acutalizar']);
    Route::delete('/empresa/{id}/eliminar', [EmpresaController::class, 'eliminar']);

    Route::get('/contactoEmpresa', [contactoEmpresaController::class, 'index']);
    Route::get('/contactoEmpresa/crear', [contactoEmpresaController::class, 'crear']);
    Route::post('/contactoEmpresa/guardar', [contactoEmpresaController::class, 'guardar']);
    Route::get('/contactoEmpresa/{id}', [contactoEmpresaController::class, 'buscar']);
    Route::get('/contactoEmpresa/{id}/modificar', [contactoEmpresaController::class, 'modificar']);
    Route::put('/contactoEmpresa/{id}/actualizar', [contactoEmpresaController::class, 'actualizar']);
    Route::delete('/contactoEmpresa/{id}/eliminar', [contactoEmpresaController::class, 'eliminar']);

    Route::get('/sectorEmpresa', [sectorEmpresaController::class, 'index']);
    Route::get('/sectorEmpresa/crear', [sectorEmpresaController::class, 'crear']);
    Route::post('/sectorEmpresa/guardar', [sectorEmpresaController::class, 'guardar']);
    Route::get('/sectorEmpresa/{id}', [sectorEmpresaController::class, 'buscar']);
    Route::get('/sectorEmpresa/{id}/modificar', [sectorEmpresaController::class, 'modificar']);
    Route::put('/sectorEmpresa/{id}/actualizar', [sectorEmpresaController::class, 'actualizar']);
    Route::delete('/sectorEmpresa/{id}/eliminar', [sectorEmpresaController::class, 'eliminar']);
});

// Rutas asociada a oferta laboral
Route::prefix('ofertaLaboral')->group(function () {
    Route::get('/', [ofertaLaboralController::class, 'index']);
    Route::get('/crear', [ofertaLaboralController::class, 'crear']);
    Route::post('/guardar', [ofertaLaboralController::class, 'guardar']);
    Route::get('/{id}', [ofertaLaboralController::class, 'buscar']);
    Route::get('/{id}/modificar', [ofertaLaboralController::class, 'modificar']);
    Route::put('/{id}/actualizar', [ofertaLaboralController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [ofertaLaboralController::class, 'eliminar']);

    Route::get('/postulacion', [postulacionController::class, 'index']);
    Route::get('/postulacion/crear', [postulacionController::class, 'crear']);
    Route::post('/postulacion/guardar', [postulacionController::class, 'guardar']);
    Route::get('/postulacion/{id}', [postulacionController::class, 'buscar']);
    Route::get('/postulacion/{id}/modificar', [postulacionController::class, 'modificar']);
    Route::put('/postulacion/{id}/actualzar', [postulacionController::class, 'actualizar']);
    Route::delete('/postulacion/{id}/eliminar', [postulacionController::class, 'eliminar']);
});

//Rutas asociada a nomina
Route::prefix('nomina')->group(function () {
    Route::get('/', [nominaController::class, 'index']);
    Route::get('/crear', [nominaController::class, 'crear']);
    Route::post('/guardar', [nominaController::class, 'guardar']);
    Route::get('/{id}', [nominaController::class, 'buscar']);
    Route::get('/{id}/modificar', [nominaController::class, 'modificar']);
    Route::put('/{id}/actualizar', [nominaController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [nominaController::class, 'eliminar']);

    Route::get('/detalleNomina', [detalleNominaController::class, 'index']);
    Route::get('/detalleNomina/crear', [detalleNominaController::class, 'crear']);
    Route::post('/detalleNomina/guardar', [detalleNominaController::class, 'guardar']);
    Route::get('/detalleNomina/{id}', [detalleNominaController::class, 'buscar']);
    Route::get('/detalleNomina/{id}/modificar', [detalleNominaController::class, 'modificar']);
    Route::put('/detalleNomina/{id}/actualizar', [detalleNominaController::class, 'actualizar']);
    Route::delete('/detalleNomina/{id}/eliminar', [detalleNominaController::class, 'eliminar']);
});



/*
GET: solicita datos, no modifica el estado del recurso.
POST: crea un nuevo recurso, puede modificar el estado del recurso.
PUT: actualiza un recurso existente, reemplaza completamente el recurso.
PATCH: actualiza parcialmente un recurso existente. **Este se va a usar mas
DELETE: elimina un recurso existente.
*/
