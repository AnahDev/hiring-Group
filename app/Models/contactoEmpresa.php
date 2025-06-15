<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class contactoEmpresa extends Model
{
    use HasFactory;
    protected $table = 'contactoEmpresa';
    protected $fillable = [
        'empresa_id',
        'personaContacto',
        'tlfContacto',
    ];
}
