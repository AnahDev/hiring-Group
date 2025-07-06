<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Candidato\EstudioController as CandidatoEstudioController; //Alias
use App\Http\Controllers\Candidato\experienciasController as CandidatoExperienciasController;
use App\Http\Controllers\Candidato\ofertaLaboralController as CandidatoOfertaController;
use App\Http\Controllers\Candidato\perfilController as CandidatoPerfilController;
use App\Http\Controllers\Candidato\postulacionesController as CandidatoPostulacionesController;
use App\Http\Controllers\Candidato\profesionesController as candidatoProfesionesController;
use App\Http\Controllers\Candidato\telefonoController as CandidatoTelefonoController;
use App\Http\Controllers\Candidato\candidato_profesionController;

use App\Http\Controllers\Contratado\ReciboPagoController as ContratadoReciboController;
use App\Http\Controllers\Contratado\ofertaLaboralController as ContratadoOfertaController;
use App\Http\Controllers\Contratado\ConstanciaController as ContratadoConstanciaController;
use App\Http\Controllers\Contratado\perfilController as ContratadoPerfilController;

use App\Http\Controllers\Empresa\OfertaLaboralController as EmpresaOfertaController;

use App\Http\Controllers\HiringGroup\OfertaLaboralController as HiringOfertaController;
use App\Http\Controllers\HiringGroup\NominaController as HiringNominaController;
use App\Http\Controllers\HiringGroup\ContratacionController as HiringContratacionController;
use App\Http\Controllers\HiringGroup\empresaController as HiringEmpresaController;
use App\Http\Controllers\HiringGroup\postulacionesController as HiringPostulacionController;

use App\Http\Controllers\Empresa\passwordController;
use App\Http\Controllers\contactoEmpresaController;
use App\Http\Controllers\sectorEmpresaController;
use App\Http\Controllers\postulacionController;
use App\Http\Controllers\AuthController;


use Illuminate\Support\Facades\Auth as FacadesAuth;

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
        return view('hiringGroup.dashboard');
    })->name('dashboard');

    Route::get('/postulaciones', [HiringPostulacionController::class, 'index'])->name('postulaciones.index');
    Route::get('/ofertas', [HiringOfertaController::class, 'index'])->name('ofertas.index');
    Route::get('/reportes', [HiringOfertaController::class, 'reporteOfertasPorProfesion'])->name('reportes.index');
    Route::get('/contrataciones', [HiringContratacionController::class, 'index'])->name('contrataciones.index');

    // Muestra la lista de postulantes para una oferta
    Route::get('/ofertas/{ofertaLaboral}/postulantes', [HiringContratacionController::class, 'show'])->name('postulaciones.show');
    // Muestra el formulario para contratar a un candidato específico
    Route::get('/postulaciones/{postulacion}/contratar', [HiringContratacionController::class, 'create'])->name('contratacion.create');
    // Almacena el nuevo contrato en la BD
    Route::post('/postulaciones/{postulacion}/contratar', [HiringContratacionController::class, 'store'])->name('contratacion.store');

    // Muestra el formulario para preparar la nómina (seleccionar empresa, mes, año)
    Route::get('/nomina/preparar', [HiringNominaController::class, 'showPreparacionForm'])->name('nomina.preparar');
    // Genera y muestra el reporte de la nómina
    Route::post('/nomina/preparar', [HiringNominaController::class, 'generarReporte'])->name('nomina.reporte');

    // Ejecuta la corrida de nómina
    Route::post('/nomina/ejecutar', [HiringNominaController::class, 'ejecutarCorrida'])->name('nomina.ejecutar');
    // 1. Muestra el formulario para seleccionar la empresa, mes y año para la nómina.
    Route::get('/nomina/preparar', [HiringNominaController::class, 'showPreparacionForm'])->name('nomina.preparar');
    // 2. Genera y muestra el reporte de vista previa de la nómina.
    //    Este formulario de preparación POSTeará aquí.
    Route::post('/nomina/reporte', [HiringNominaController::class, 'generarReporte'])->name('nomina.reporte');

    // 3. Ejecuta la corrida de nómina (se envía desde el formulario de la vista de reporte).
    Route::post('/nomina/ejecutar', [HiringNominaController::class, 'ejecutarCorrida'])->name('nomina.ejecutar');

    //4 Historial de nominas
    Route::get('/nomina/historial', [HiringNominaController::class, 'historial'])->name('nomina.historial');
    Route::get('/nomina/historial/{nomina}', [HiringNominaController::class, 'showHistorial'])->name('nomina.historial.show');


    // CRUD para Empresas
    // Esto genera rutas como: /hiringGroup/empresas, /hiringGroup/empresas/create, etc.
    //Route::resource('empresas', EmpresaController::class)->parameters(['empresas' => 'empresa']);
    Route::resource('empresas', HiringEmpresaController::class);

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

    Route::get('/password', [passwordController::class, 'showPasswordForm'])->name('password');
    Route::post('/password/update', [passwordController::class, 'updatePassword'])->name('password.update');

    // REEMPLAZA EL CONTROLADOR GENÉRICO POR EL ESPECIALIZADO
    Route::post('/ofertas/{ofertaLaboral}/toggle-status', [EmpresaOfertaController::class, 'toggleStatus'])->name('ofertas.toggleStatus');
    Route::resource('ofertas', EmpresaOfertaController::class)->parameters(['ofertas' => 'ofertaLaboral']);
});


#############
// CANDIDATO
#############

// Grupo 1: Rutas para la creación inicial del perfil. RUTAS PARA COMPLETAR EL PERFIL 
Route::middleware(['auth', 'role:candidato'])->prefix('candidato')->name('candidato.')->group(function () {
    Route::get('/perfil/crear', [CandidatoPerfilController::class, 'create'])->name('perfil.crear');
    Route::post('/perfil/store', [CandidatoPerfilController::class, 'store'])->name('perfil.store');
});
// Grupo 2: Rutas principales del dashboard del candidato.
// Requiere que el perfil esté completo gracias al middleware 'profile.complete'.
Route::middleware(['auth', 'role:candidato', 'perfil.complete'])->prefix('candidato')->name('candidato.')->group(function () {
    Route::get('/', function () {
        $candidato = FacadesAuth::user()->candidato;
        return view('candidato.dashboard', compact('candidato'));
    })->name('dashboard');

    // Ver ofertas y postularse
    Route::get('ofertas', [CandidatoOfertaController::class, 'index'])->name('ofertas.index');
    Route::get('ofertas/{ofertaLaboral}', [CandidatoOfertaController::class, 'show'])->name('ofertas.show');
    Route::post('ofertas/{ofertaLaboral}/postular', [CandidatoPostulacionesController::class, 'store'])->name('ofertas.postular');

    // Ver mis postulaciones, mis profesiones y mis experiencias previas
    Route::get('postulaciones', [CandidatoPostulacionesController::class, 'index'])->name('postulaciones.index');
    Route::get('profesiones', [candidatoProfesionesController::class, 'index'])->name('profesiones.index');
    Route::get('experiencias', [CandidatoExperienciasController::class, 'index'])->name('experiencias.index');

    // Editar perfil (datos básicos)    
    Route::get('/perfil/edit', [CandidatoPerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/update', [CandidatoPerfilController::class, 'update'])->name('perfil.update');

    // CRUD para el currículum (Experiencias, Estudios)
    Route::resource('estudios', CandidatoEstudioController::class)->except(['index', 'show']);
    Route::resource('experiencias', CandidatoExperienciasController::class)->except(['index', 'show']);
    Route::resource('telefonos', CandidatoTelefonoController::class)->except(['index', 'show']);
    Route::resource('candidato_profesiones', candidato_profesionController::class)->except(['index', 'show']);
});

#############
// CONTRATADO
#############
Route::middleware(['auth', 'role:contratado'])->prefix('contratado')->name('contratado.')->group(function () {

    Route::get('/', function () {
        return view('contratado.dashboard');
    })->name('dashboard');
    Route::get('/recibos', [ContratadoReciboController::class, 'index'])->name('recibos.index');
    Route::get('/ofertas', [ContratadoOfertaController::class, 'index'])->name('ofertas.index');

    // Rutas para el perfil del contratado
    Route::get('/curriculum', [ContratadoPerfilController::class, 'index'])->name('perfil.curriculum');
    Route::get('/perfil/edit', [ContratadoPerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/update', [ContratadoPerfilController::class, 'update'])->name('perfil.update');

    Route::get('constancia/solicitar', [ContratadoConstanciaController::class, 'create'])->name('constancia.create');
    Route::post('constancia/solicitar', [ContratadoConstanciaController::class, 'store'])->name('constancia.store');
});
