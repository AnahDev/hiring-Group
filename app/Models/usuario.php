<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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

    //Relaciones uno a uno
    public function empresa(): HasOne
    {
        return $this->hasOne(empresa::class, 'usuario_id');
    }

    //Relacion uno a muchos

}
