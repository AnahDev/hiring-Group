<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class contactoEmpresa extends Model
{
    use HasFactory;
    protected $table = 'contactoEmpresa';
    protected $fillable = [
        'empresa_id',
        'personaContacto',
        'tlfContacto',
    ];

    // Relacion uno a muchos
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(empresa::class, 'empresa_id');
    }
}
