<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sectorEmpresa extends Model
{
    use HasFactory;
    protected $table = 'sector_empresa';
    protected $fillable = [
        'empresa_id',
        'descripcion',
    ];
}
