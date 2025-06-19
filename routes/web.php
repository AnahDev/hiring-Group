<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/probando', function () {
    return 'Hola espero que funcione';
});

Route::get('/candidatos', function () {
    return 'Aqui se va la vista de candidatos';
});

Route::get('/empresa', function () {
    return 'Aqui se va la vista de empresa';
});

Route::get('/Admin', function () {
    return 'Aqui se va la vista del administrador';
});

Route::get('/empleado', function () {
    return 'Aqui se va la vista del empleado';
});

Route::get('/hiring-group', function () {
    return 'Hola';
});




/*
GET: solicita datos, no modifica el estado del recurso.
POST: crea un nuevo recurso, puede modificar el estado del recurso.
PUT: actualiza un recurso existente, reemplaza completamente el recurso.
PATCH: actualiza parcialmente un recurso existente. **Este se va a usar mas
DELETE: elimina un recurso existente.
*/
