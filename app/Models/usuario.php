<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';


    protected $fillable = [
        'correo',
        'password',
        'tipo',
        'fechaRegistro',
    ];

    // Indica a Laravel que el campo de contraseña es 'clave'
    // public function getAuthPassword()
    // {
    //     return $this->clave;
    // }


    // Relaciones uno a uno
    public function empresa(): HasOne
    {
        return $this->hasOne(empresa::class, 'usuario_id');
    }

    public function candidato(): HasOne
    {
        return $this->hasOne(candidato::class, 'usuario_id');
    }
}
