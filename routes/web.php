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
use App\Http\Controllers\homeController;
use App\Http\Controllers\bancoController;
use App\Http\Controllers\contratoController;
use App\Http\Controllers\AuthController;
use App\Models\empresa;
use App\Models\ofertaLaboral;
use Illuminate\Container\Attributes\Auth;

//Pagina principal y login(home)
// Route::get('/', [homeController::class, '__invoke'])->name('home');

Route::get('/', function () {
    return view('welcome'); // Aquí puedes cambiar 'welcome' por la vista que desees mostrar
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home', function () {
    return 'Aqui se va la vista del administrador';
})->middleware('auth'); // Asegura que el usuario esté autenticado para acceder a esta ruta 


Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');


// HIRING GROUP

Route::get('/hiringGroup', function () {
    return view('hiring.dashboard');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/hiringGroup/postulaciones', [PostulacionController::class, 'index'])->name('postulaciones');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/hiringGroup/ofertas', [ofertaLaboralController::class, 'indexAll'])->name('ofertas');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/hiringGroup/reportes', [ofertaLaboralController::class, 'reporteOfertasPorProfesion'])->name('reportes');
});


// Rutas Empresa
Route::get('/empresa', function () {
    return view('empresa.dashboard');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    //Route::get('/empresa/ofertas', [ofertaLaboralController::class, 'index'])->name('empresa.ofertas');
    Route::get('empresa/ofertas/activas', [ofertaLaboralController::class, 'activas'])->name('empresa.ofertas.activas');
    Route::get('empresa/ofertas/inactivas', [ofertaLaboralController::class, 'inactivas'])->name('empresa.ofertas.inactivas');

    Route::get('empresa/password', [EmpresaController::class, 'showPasswordForm'])->name('empresa.password')->middleware('auth');
    Route::post('empresa/password/update', [EmpresaController::class, 'updatePassword'])->name('empresa.password.update');

    //PILAAAAAA Los metodos resources tinene que ir al final para que no de problemas
    Route::post('/empresa/ofertas/{ofertaLaboral}/toggle-status', [ofertaLaboralController::class, 'toggleStatus'])->name('empresa.ofertas.toggleStatus');
    Route::resource('empresa/ofertas', ofertaLaboralController::class)->parameters(['ofertas' => 'ofertaLaboral'])->names('empresa.ofertas');
    //->parameters(['ofertas' => 'ofertaLaboral']) mapear {ofertas} a {ofertaLaboral} 
});

/*
Route::get('/Admin', function () {
    return 'Aqui se va la vista del administrador';
});

//Rutas asociada a usuario
// Route::prefix('usuario')->group(function () {
//     Route::get('/', [usuarioController::class, 'index']);
//     Route::get('/crear', [usuarioController::class, 'crear']);
//     Route::post('/guardar', [usuarioController::class, 'guardar']);
//     Route::get('/{id}', [usuarioController::class, 'buscar']);
//     Route::get('/{id}/modificar', [usuarioController::class, 'modificar']);
//     Route::put('/{id}/actualizar', [usuarioController::class, 'actualizar']);
//     Route::delete('/{id}/eliminar', [usuarioController::class, 'eliminar']);
// });



//Rutas asociada a candidatos
Route::prefix('candidatos')->group(function () {
    Route::get('/', [CandidatosController::class, 'index']);
    Route::get('/crear', [CandidatosController::class, 'crear']);
    Route::post('/guardar', [CandidatosController::class, 'guardar']);
    Route::get('/{candidato}', [CandidatosController::class, 'buscar']);
    Route::get('/{id}/modificar', [CandidatosController::class, 'modificar']);
    Route::put('/{id}/actualizar', [CandidatosController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [CandidatosController::class, 'eliminar']);
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
});

//Ruta para nomina
Route::prefix('nomina')->group(function () {
    Route::get('/', [nominaController::class, 'index']);
    Route::get('/crear', [nominaController::class, 'crear']);
    Route::post('/guardar', [nominaController::class, 'guardar']);
    Route::get('/{id}', [nominaController::class, 'buscar']);
    Route::get('/{id}/modificar', [nominaController::class, 'modificar']);
    Route::put('/{id}/actualizar', [nominaController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [nominaController::class, 'eliminar']);
});
// Ruta asociada a telefono
Route::prefix('telefono')->group(function () {
    Route::get('/', [telefonoController::class, 'index']);
    Route::get('/crear', [telefonoController::class, 'crear']);
    Route::post('/guardar', [telefonoController::class, 'guardar']);
    Route::get('/{id}', [telefonoController::class, 'buscar']);
    Route::get('/{id}/modificar', [telefonoController::class, 'modificar']);
    Route::put('/{id}/actualizar', [telefonoController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [telefonoController::class, 'eliminar']);
});

// Rutas asociada a estudio
Route::prefix('estudio')->group(function () {
    Route::get('/', [estudioController::class, 'index']);
    Route::get('/crear', [estudioController::class, 'crear']);
    Route::post('/guardar', [estudioController::class, 'guardar']);
    Route::get('/{id}', [estudioController::class, 'buscar']);
    Route::get('/{id}/modificar', [estudioController::class, 'modificar']);
    Route::put('/{id}/actualizar', [estudioController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [estudioController::class, 'eliminar']);
});

// Rutas asociada a profesion
Route::prefix('profesion')->group(function () {
    Route::get('/', [profesionController::class, 'index']);
    Route::get('/crear', [profesionController::class, 'crear']);
    Route::post('/guardar', [profesionController::class, 'guardar']);
    Route::get('/{id}', [profesionController::class, 'buscar']);
    Route::get('/{id}/modificar', [profesionController::class, 'modificar']);
    Route::put('/{id}/actualizar', [profesionController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [profesionController::class, 'eliminar']);
});

// Rutas asociada a candidato_profesion
Route::prefix('candidato_profesion')->group(function () {
    Route::get('/', [candidato_profesionController::class, 'index']);
    Route::get('/crear', [candidato_profesionController::class, 'crear']);
    Route::post('/guardar', [candidato_profesionController::class, 'guardar']);
    Route::get('/{id}', [candidato_profesionController::class, 'buscar']);
    Route::get('/{id}/modificar', [candidato_profesionController::class, 'modificar']);
    Route::put('/{id}/actualizar', [candidato_profesionController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [candidato_profesionController::class, 'eliminar']);
});

// Rutas asociada a empresa
Route::prefix('empresa')->group(function () {
    Route::get('/', [EmpresaController::class, 'index']);
    Route::get('/crear', [EmpresaController::class, 'crear']);
    Route::post('/guardar', [EmpresaController::class, 'guardar']);
    Route::get('/{id}', [EmpresaController::class, 'mostrar']);
    Route::get('/{id}/modificar', [EmpresaController::class, 'modificar']);
    Route::put('/{id}/actualizar', [EmpresaController::class, 'acutalizar']); // Revisa el typo: debería ser 'actualizar'
    Route::delete('/{id}/eliminar', [EmpresaController::class, 'eliminar']);
});

// Rutas asociadas a contactoEmpresa
Route::prefix('contactoEmpresa')->group(function () {
    Route::get('/', [contactoEmpresaController::class, 'index']);
    Route::get('/crear', [contactoEmpresaController::class, 'crear']);
    Route::post('/guardar', [contactoEmpresaController::class, 'guardar']);
    Route::get('/{id}', [contactoEmpresaController::class, 'buscar']);
    Route::get('/{id}/modificar', [contactoEmpresaController::class, 'modificar']);
    Route::put('/{id}/actualizar', [contactoEmpresaController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [contactoEmpresaController::class, 'eliminar']);
});

// Rutas asociadas a sectorEmpresa
Route::prefix('sectorEmpresa')->group(function () {
    Route::get('/', [sectorEmpresaController::class, 'index']);
    Route::get('/crear', [sectorEmpresaController::class, 'crear']);
    Route::post('/guardar', [sectorEmpresaController::class, 'guardar']);
    Route::get('/{id}', [sectorEmpresaController::class, 'buscar']);
    Route::get('/{id}/modificar', [sectorEmpresaController::class, 'modificar']);
    Route::put('/{id}/actualizar', [sectorEmpresaController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [sectorEmpresaController::class, 'eliminar']);
});

// Rutas asociada a postulacion
Route::prefix('postulacion')->group(function () {
    Route::get('/', [postulacionController::class, 'index']);
    Route::get('/crear', [postulacionController::class, 'crear']);
    Route::post('/guardar', [postulacionController::class, 'guardar']);
    Route::get('/{id}', [postulacionController::class, 'buscar']);
    Route::get('/{id}/modificar', [postulacionController::class, 'modificar']);
    Route::put('/{id}/actualizar', [postulacionController::class, 'actualizar']); // Revisa el typo: antes decía 'actualzar'
    Route::delete('/{id}/eliminar', [postulacionController::class, 'eliminar']);
});

// Rutas asociada a detalleNomina
Route::prefix('detalleNomina')->group(function () {
    Route::get('/', [detalleNominaController::class, 'index']);
    Route::get('/crear', [detalleNominaController::class, 'crear']);
    Route::post('/guardar', [detalleNominaController::class, 'guardar']);
    Route::get('/{id}', [detalleNominaController::class, 'buscar']);
    Route::get('/{id}/modificar', [detalleNominaController::class, 'modificar']);
    Route::put('/{id}/actualizar', [detalleNominaController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [detalleNominaController::class, 'eliminar']);
});


// Ruta banco
Route::prefix('banco')->group(function () {
    Route::get('/', [bancoController::class, 'index']);
    Route::get('/crear', [bancoController::class, 'crear']);
    Route::post('/guardar', [bancoController::class, 'guardar']);
    Route::get('/{id}', [bancoController::class, 'buscar']);
    Route::get('/{id}/modificar', [bancoController::class, 'modificar']);
    Route::put('/{id}/actualizar', [bancoController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [bancoController::class, 'eliminar']);
});

// Ruta Experiecia Laboral
Route::prefix('experienciaLaboral')->group(function () {
    Route::get('/', [experienciaLaboralController::class, 'index']);
    Route::get('/crear', [experienciaLaboralController::class, 'crear']);
    Route::post('/guardar', [experienciaLaboralController::class, 'guardar']);
    Route::get('/{id}', [experienciaLaboralController::class, 'buscar']);
    Route::get('/{id}/modificar', [experienciaLaboralController::class, 'modificar']);
    Route::put('/{id}/actualizar', [experienciaLaboralController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [experienciaLaboralController::class, 'eliminar']);
});

//rutas asociada a candidatoTelefono
Route::prefix('candidatoTelefono')->group(function () {
    Route::get('/', [telefonoController::class, 'index']);
    Route::get('/crear', [telefonoController::class, 'crear']);
    Route::post('/guardar', [telefonoController::class, 'guardar']);
    Route::get('/{id}', [telefonoController::class, 'buscar']);
    Route::get('/{id}/modificar', [telefonoController::class, 'modificar']);
    Route::put('/{id}/actualizar', [telefonoController::class, 'actualizar']);
    Route::delete('/{id}/eliminar', [telefonoController::class, 'eliminar']);
});

*/ 

/*
GET: solicita datos, no modifica el estado del recurso.
POST: crea un nuevo recurso, puede modificar el estado del recurso.
PUT: actualiza un recurso existente, reemplaza completamente el recurso.
PATCH: actualiza parcialmente un recurso existente. **Este se va a usar mas
DELETE: elimina un recurso existente.
*/
