<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    //muchos a uno

    //Relaciones uno a uno
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(usuario::class, 'usuario_id');
    }

    //Relaciones uno a muchos
    public function sectorEmpresa(): HasMany
    {
        return $this->hasMany(sectorEmpresa::class, 'empresa_id');
    }

    public function contactoEmpresa(): HasMany
    {
        return $this->hasMany(contactoEmpresa::class, 'empresa_id');
    }

    public function nomina(): HasMany
    {
        return $this->hasMany(nomina::class, 'empresa_id');
    }

    public function ofertaLaboral(): HasMany
    {
        return $this->hasMany(ofertaLaboral::class, 'empresa_id');
    }
}
