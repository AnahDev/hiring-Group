<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class reciboPago extends Model
{
    use HasFactory;

    protected $table = 'recibo_pagos';
    protected $fillable = [
        'usuario_id',
        'fecha',
        'monto',
        'descripcion',
    ];

    // Relación: Un recibo pertenece a un usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(usuario::class, 'usuario_id');
    }
}
