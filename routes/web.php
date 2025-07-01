<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatosController;
use App\Http\Controllers\ofertaLaboralController;
use App\Http\Controllers\estudioController;
use App\Http\Controllers\telefonoController;
use App\Http\Controllers\profesionController;

use App\Http\Controllers\Candidato\EstudioController as CandidatoEstudioController; //Alias
use App\Http\Controllers\Candidato\experienciasController as CandidatoExperienciasController;
use App\Http\Controllers\Candidato\ofertaLaboralController as CandidatoOfertaController;
use App\Http\Controllers\Candidato\perfilController as CandidatoPerfilController;
use App\Http\Controllers\Candidato\postulacionesController as CandidatoPostulacionesController;
use App\Http\Controllers\Candidato\profesionesController as candidatoProfesionController;

use App\Http\Controllers\Empresa\OfertaLaboralController as EmpresaOfertaController;
use App\Http\Controllers\HiringGroup\OfertaLaboralController as HiringOfertaController;

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


Route::middleware(['auth', 'role:hiringGroup'])->prefix('hiringGroup')->name('hiringGroup.')->group(function () {
    Route::get('/', function () {
        return view('hiring.dashboard');
    })->name('dashboard');

    Route::get('/postulaciones', [PostulacionController::class, 'index'])->name('postulaciones.index');
    Route::get('/ofertas', [HiringOfertaController::class, 'index'])->name('ofertas.index');
    Route::get('/reportes', [HiringOfertaController::class, 'reporteOfertasPorProfesion'])->name('reportes.index');

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

Route::middleware(['auth', 'role:empresa'])->prefix('empresa')->name('empresa.')->group(function () {
    Route::get('/', function () {
        return view('empresa.dashboard');
    })->name('dashboard');

    Route::get('/ofertas/activas', [EmpresaOfertaController::class, 'activas'])->name('ofertas.activas');
    Route::get('/ofertas/inactivas', [EmpresaOfertaController::class, 'inactivas'])->name('ofertas.inactivas');

    Route::get('/password', [EmpresaController::class, 'showPasswordForm'])->name('password');
    Route::post('/password/update', [EmpresaController::class, 'updatePassword'])->name('password.update');

    // REEMPLAZA EL CONTROLADOR GENÉRICO POR EL ESPECIALIZADO
    Route::post('/ofertas/{ofertaLaboral}/toggle-status', [EmpresaOfertaController::class, 'toggleStatus'])->name('ofertas.toggleStatus');
    Route::resource('ofertas', EmpresaOfertaController::class)->parameters(['ofertas' => 'ofertaLaboral']);
});


#############
// CANDIDATO
#############
Route::middleware(['auth', 'role:candidato', 'perfil.complete'])->prefix('candidato')->name('candidato.')->group(function () {
    Route::get('/', function () {
        return view('candidato.dashboard');
    })->name('dashboard');

    Route::get('ofertas', [CandidatoOfertaController::class, 'index'])->name('ofertas.index');
    Route::get('ofertas/{ofertaLaboral}', [CandidatoOfertaController::class, 'show'])->name('ofertas.show');
    Route::post('ofertas/{ofertaLaboral}/postular', [CandidatoPostulacionesController::class, 'show'])->name('ofertas.storePostulacion');

    Route::get('/perfil', [CandidatosController::class, 'showProfile'])->name('perfil.show');
    Route::get('/perfil/edit', [CandidatosController::class, 'editProfile'])->name('perfil.edit');
    Route::put('/perfil/update', [CandidatosController::class, 'updateProfile'])->name('perfil.update');

    Route::resource('estudios', CandidatoEstudioController::class)->parameters(['estudios' => 'estudio']);
    Route::resource('telefonos', telefonoController::class)->parameters(['telefonos' => 'telefono']);
    Route::resource('profesiones', candidatoProfesionController::class)->parameters(['profesiones' => 'profesion']);
    Route::resource('candidato_profesiones', candidato_profesionController::class)->parameters(['candidato_profesiones' => 'candidatoProfesion']);
    Route::resource('experiencias_laborales', CandidatoExperienciasController::class)->parameters(['experiencias_laborales' => 'experienciaLaboral']);
});

// RUTAS PARA COMPLETAR EL PERFIL (van separadas para más claridad)
Route::middleware(['auth', 'role:candidato'])->prefix('candidato')->name('candidato.')->group(function () {
    Route::get('/perfil/crear', [CandidatoPerfilController::class, 'create'])->name('perfil.crear');
    Route::post('/perfil/store', [CandidatoPerfilController::class, 'store'])->name('perfil.store');
});
