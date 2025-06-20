<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Usuario;


class empresa extends Model
{
    use HasFactory;
    protected $table = 'empresa';
    protected $fillable = [
        'usuario_id',
        'nombre',
        'correo',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    //muchos a uno
}
