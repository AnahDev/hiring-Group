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


Route::get('/', function () {
    return view('welcome'); // Aquí puedes cambiar 'welcome' por la vista que desees mostrar
});

//RUTA AL AIRE (SI NO HACE NADA ELIMINAR) :S
Route::get('/home', function () {
    return 'Aqui se va la vista del administrador';
})->middleware('auth'); // Asegura que el usuario esté autenticado para acceder a esta ruta 


##################
// LOGIN DE USUSARIOS
##################

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registrarUsuario'])->name('registrar');
Route::post('/register', [AuthController::class, 'registrar']);


##################
// HIRING GROUP
##################

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');


Route::middleware(['auth'])->prefix('hiringGroup')->name('hiringGroup.')->group(function () {
    Route::get('/', function () {
        return view('hiring.dashboard');
    })->name('dashboard');

    Route::get('/postulaciones', [PostulacionController::class, 'index'])->name('postulaciones.index');
    Route::get('/ofertas', [ofertaLaboralController::class, 'indexAll'])->name('ofertas.index');
    Route::get('/reportes', [ofertaLaboralController::class, 'reporteOfertasPorProfesion'])->name('reportes.index');

    // CRUD para Empresas
    // Esto genera rutas como: /hiringGroup/empresas, /hiringGroup/empresas/create, etc.
    Route::resource('empresas', EmpresaController::class)->parameters(['empresas' => 'empresa']);

    // Rutas anidadas para Contactos y Sectores de una Empresa
    // Genera rutas como: /hiringGroup/empresas/{empresa}/contactos
    Route::resource('empresas.contactos', contactoEmpresaController::class)
        ->scoped()->parameters(['contactos' => 'contactoEmpresa']);
    Route::resource('empresas.sectores', sectorEmpresaController::class)
        ->scoped()->parameters(['sectores' => 'sectorEmpresa']);
});





#############
// EMPRESA
#############

Route::middleware(['auth'])->prefix('empresa')->name('empresa.')->group(function () {
    Route::get('/', function () {
        return view('empresa.dashboard');
    })->name('dashboard');

    Route::get('/ofertas/activas', [ofertaLaboralController::class, 'activas'])->name('ofertas.activas');
    Route::get('/ofertas/inactivas', [ofertaLaboralController::class, 'inactivas'])->name('ofertas.inactivas');

    Route::get('/password', [EmpresaController::class, 'showPasswordForm'])->name('password');
    Route::post('/password/update', [EmpresaController::class, 'updatePassword'])->name('password.update');

    Route::post('/ofertas/{ofertaLaboral}/toggle-status', [ofertaLaboralController::class, 'toggleStatus'])->name('ofertas.toggleStatus');
    Route::resource('ofertas', ofertaLaboralController::class)->parameters(['ofertas' => 'ofertaLaboral']);
});


#############
// CANDIDATO
#############
Route::middleware(['auth'])->prefix('candidato')->name('candidato.')->group(function () {
    Route::get('/', function () {
        return view('candidato.dashboard');
    })->name('dashboard');


    //revisa bien si las rutas correctas
    Route::get('/ofertas', [ofertaLaboralController::class, 'index'])->name('ofertas.index');
    Route::get('/ofertas/{ofertaLaboral}/postular', [postulacionController::class, 'create'])->name('ofertas.postular');
    Route::post('/ofertas/{ofertaLaboral}/postular', [postulacionController::class, 'store'])->name('ofertas.storePostulacion');

    Route::get('/perfil', [CandidatosController::class, 'showProfile'])->name('perfil.show');
    Route::get('/perfil/edit', [CandidatosController::class, 'editProfile'])->name('perfil.edit');
    Route::put('/perfil/update', [CandidatosController::class, 'updateProfile'])->name('perfil.update');

    Route::resource('estudios', estudioController::class)->parameters(['estudios' => 'estudio']);
    Route::resource('telefonos', telefonoController::class)->parameters(['telefonos' => 'telefono']);
    Route::resource('profesiones', profesionController::class)->parameters(['profesiones' => 'profesion']);
    Route::resource('candidato_profesiones', candidato_profesionController::class)->parameters(['candidato_profesiones' => 'candidatoProfesion']);
    Route::resource('experiencias_laborales', experienciaLaboralController::class)->parameters(['experiencias_laborales' => 'experienciaLaboral']);
});
