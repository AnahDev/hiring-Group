<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Empresa;


class usuario extends Model
{
    use HasFactory;
    protected $table = 'usuario';

    protected $fillable = [
        'correo',
        'clave',
        'tipo',
        'fechaRegistro',
    ];


    // Relaciones

    // uno a uno:

    public function empresa()
    {
        return $this->hasOne(Empresa::class);
    }

    // uno a muchos:





}
