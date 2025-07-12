<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Candidato\EstudioController as CandidatoEstudioController;
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
use App\Http\Controllers\Empresa\SectorController as EmpresaSectorController;
use App\Http\Controllers\Empresa\ContactoController as EmpresaContactoController;
use App\Http\Controllers\Empresa\PerfilController as EmpresaPerfilController;
use App\Http\Controllers\Empresa\passwordController;

use App\Http\Controllers\HiringGroup\OfertaLaboralController as HiringOfertaController;
use App\Http\Controllers\HiringGroup\NominaController as HiringNominaController;
use App\Http\Controllers\HiringGroup\ContratacionController as HiringContratacionController;
use App\Http\Controllers\HiringGroup\empresaController as HiringEmpresaController;
use App\Http\Controllers\HiringGroup\postulacionesController as HiringPostulacionController;
use App\Http\Controllers\HiringGroup\bancoController as HiringBancoController;
use App\Http\Controllers\HiringGroup\profesionController as HiringProfesionController;


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

    Route::get('/postulaciones', [HiringContratacionController::class, 'index'])->name('contrataciones.index');
    Route::get('/ofertas', [HiringOfertaController::class, 'index'])->name('ofertas.index');
    Route::get('/reportes', [HiringOfertaController::class, 'reporteOfertasPorProfesion'])->name('reportes.index');
    //Route::get('/contrataciones', [HiringContratacionController::class, 'index'])->name('contrataciones.index');

    // Muestra la lista de postulantes para una oferta
    Route::get('/ofertas/{ofertaLaboral}/postulantes', [HiringContratacionController::class, 'show'])->name('contrataciones.show');
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
    //Route::resource('empresas', EmpresaController::class)->parameters(['empresas' => 'empresa']);
    Route::resource('empresas', HiringEmpresaController::class);
    //CRUD para bancos
    Route::resource('bancos', HiringBancoController::class);
    Route::resource('profesiones', HiringProfesionController::class)->parameters(['profesiones' => 'profesion']);
});


#############
// EMPRESA
#############

Route::middleware(['auth', 'role:empresa'])->prefix('empresa')->name('empresa.')->group(function () {
    Route::get('/', function () {
        return view('empresa.dashboard');
    })->name('dashboard');

    //Ruta para el perfil 

    Route::get('/perfil', [EmpresaPerfilController::class, 'edit'])->name('perfil.edit');
    // Rutas para gestionar los sectores y contactos de la empresa

    Route::resource('sectores', EmpresaSectorController::class)->only(['store', 'destroy'])->parameters(['sectores' => 'sectorEmpresa']);
    Route::resource('contactos', EmpresaContactoController::class)->only(['store', 'destroy'])->parameters(['contactos' => 'contactoEmpresa']);

    Route::get('/ofertas/activas', [EmpresaOfertaController::class, 'activas'])->name('ofertas.activas');
    Route::get('/ofertas/inactivas', [EmpresaOfertaController::class, 'inactivas'])->name('ofertas.inactivas');

    Route::get('/password', [passwordController::class, 'showPasswordForm'])->name('password');
    Route::post('/password/update', [passwordController::class, 'updatePassword'])->name('password.update');

    // REEMPLAZA EL CONTROLADOR GENÉRICO POR EL ESPECIALIZADO
    Route::post('/ofertas/{ofertaLaboral}/toggle-status', [EmpresaOfertaController::class, 'toggleStatus'])->name('ofertas.toggleStatus');
    Route::resource('ofertas', EmpresaOfertaController::class)->parameters(['ofertas' => 'ofertaLaboral']);
});


#############
// CANDIDATO y CONTRATADO
#############

// Grupo 1: Rutas para la creación inicial del perfil. RUTAS PARA COMPLETAR EL PERFIL 
Route::middleware(['auth', 'role:candidato'])->prefix('candidato')->name('candidato.')->group(function () {
    Route::get('/perfil/crear', [CandidatoPerfilController::class, 'create'])->name('perfil.crear');
    Route::post('/perfil/store', [CandidatoPerfilController::class, 'store'])->name('perfil.store');
});

// GRUPO 2: Rutas Comunes para la Gestión del Perfil/Currículum
// Accesible tanto para 'candidato' como para 'contratado'.
Route::middleware(['auth', 'role:candidato,contratado', 'perfil.complete'])->prefix('mi-curriculum')->name('candidato.')->group(function () {

    // Rutas de edición de perfil (datos básicos) - Mantienen el prefijo 'candidato.' del grupo
    Route::get('/perfil/edit', [CandidatoPerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/update', [CandidatoPerfilController::class, 'update'])->name('perfil.update');

    // CRUD para secciones del currículum que son comunes
    Route::resource('telefonos', CandidatoTelefonoController::class)->except(['index', 'show'])->parameters(['telefonos' => 'telefono']);
    Route::resource('experiencias', CandidatoExperienciasController::class)->except(['show'])->parameters(['experiencias' => 'experienciaLaboral']);
    Route::resource('estudios', CandidatoEstudioController::class)->except(['index', 'show'])->parameters(['estudios' => 'estudio']);
    Route::resource('profesiones', candidato_profesionController::class)->only(['index', 'store', 'destroy'])->parameters(['profesiones' => 'profesion']);
});

// Rutas especificas del candidato 
Route::middleware(['auth', 'role:candidato', 'perfil.complete'])->prefix('candidato')->name('candidato.')->group(function () {
    Route::get('/', function () {
        $candidato = FacadesAuth::user()->candidato;
        return view('candidato.dashboard', compact('candidato'));
    })->name('dashboard');

    // Ver ofertas y postularse
    Route::get('ofertas', [CandidatoOfertaController::class, 'index'])->name('ofertas.index');
    Route::get('ofertas/{ofertaLaboral}', [CandidatoOfertaController::class, 'show'])->name('ofertas.show');
    Route::post('ofertas/{ofertaLaboral}/postular', [CandidatoPostulacionesController::class, 'store'])->name('ofertas.postular');

    // Ver mis postulaciones
    Route::get('postulaciones', [CandidatoPostulacionesController::class, 'index'])->name('postulaciones.index');
});


// Grupo 3: contratado
Route::middleware(['auth', 'role:contratado'])->prefix('contratado')->name('contratado.')->group(function () {

    Route::get('/', function () {
        return view('contratado.dashboard');
    })->name('dashboard');
    Route::get('/recibos', [ContratadoReciboController::class, 'index'])->name('recibos.index');
    Route::get('/ofertas', [ContratadoOfertaController::class, 'index'])->name('ofertas.index');

    // Ruta principal para el perfil/currículum del contratado, que ahora enlazará a las rutas comunes.
    Route::get('/curriculum', [ContratadoPerfilController::class, 'index'])->name('perfil.curriculum');
    Route::get('/perfil/edit', [CandidatoPerfilController::class, 'edit'])->name('perfil.edit');

    Route::get('constancia/solicitar', [ContratadoConstanciaController::class, 'create'])->name('constancia.create');
    Route::post('constancia/solicitar', [ContratadoConstanciaController::class, 'store'])->name('constancia.store');
});

/* 
#############
// CONTRATADO
#############
Route::middleware(['auth', 'role:contratado'])->prefix('contratado')->name('contratado.')->group(function () {

    Route::get('/', function () {
        return view('contratado.dashboard');
    })->name('dashboard');
    Route::get('/recibos', [ContratadoReciboController::class, 'index'])->name('recibos.index');
    Route::get('/ofertas', [ContratadoOfertaController::class, 'index'])->name('ofertas.index');

    // Ruta principal para el perfil/currículum del contratado, que ahora enlazará a las rutas comunes.
    Route::get('/curriculum', [ContratadoPerfilController::class, 'index'])->name('perfil.curriculum');

    // NOTA: Las rutas 'perfil.edit' y 'perfil.update' del Contratado
    // DEBERÍAN SER ELIMINADAS o REDIRIGIR a las rutas comunes del grupo 'perfil-candidato'.
    // Si ContratadoPerfilController::edit/update manejan los mismos datos, unifícalos.
    // Si solo enlazan a la vista de edición del currículum, haz que enlacen a las nuevas rutas comunes.

    Route::get('constancia/solicitar', [ContratadoConstanciaController::class, 'create'])->name('constancia.create');
    Route::post('constancia/solicitar', [ContratadoConstanciaController::class, 'store'])->name('constancia.store');
});
 */

/* // Grupo 2: Rutas principales del dashboard del candidato.
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
    //Route::get('profesiones', [candidatoProfesionesController::class, 'index'])->name('profesiones.index');
    Route::get('experiencias', [CandidatoExperienciasController::class, 'index'])->name('experiencias.index');

    // Editar perfil (datos básicos)    
    Route::get('/perfil/edit', [CandidatoPerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/update', [CandidatoPerfilController::class, 'update'])->name('perfil.update');

    // CRUD para el currículum (Experiencias, Estudios)
    Route::resource('estudios', CandidatoEstudioController::class)->except(['index', 'show']);
    Route::resource('experiencias', CandidatoExperienciasController::class)->except(['index', 'show'])->parameters(['experiencias' => 'experienciaLaboral']);
    Route::resource('telefonos', CandidatoTelefonoController::class)->except(['index', 'show']);
    Route::resource('profesiones', candidato_profesionController::class)->only(['index', 'store', 'destroy'])->parameters(['profesiones' => 'profesion']);
}); */

#############
// CONTRATADO
#############
/* Route::middleware(['auth', 'role:contratado'])->prefix('contratado')->name('contratado.')->group(function () {

    Route::get('/', function () {
        return view('contratado.dashboard');
    })->name('dashboard');
    Route::get('/recibos', [ContratadoReciboController::class, 'index'])->name('recibos.index');
    Route::get('/ofertas', [ContratadoOfertaController::class, 'index'])->name('ofertas.index');

    // Rutas para el perfil del contratado
    // Route::get('/curriculum', [ContratadoPerfilController::class, 'index'])->name('perfil.curriculum');
    
    //Route::put('/perfil/update', [ContratadoPerfilController::class, 'update'])->name('perfil.update');

    Route::get('constancia/solicitar', [ContratadoConstanciaController::class, 'create'])->name('constancia.create');
    Route::post('constancia/solicitar', [ContratadoConstanciaController::class, 'store'])->name('constancia.store');
}); */
