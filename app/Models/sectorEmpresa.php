<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class sectorEmpresa extends Model
{
    use HasFactory;
    protected $table = 'sector_empresa';
    protected $fillable = [
        'empresa_id',
        'descripcion',
    ];

    //Relacion uno a muchos
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(empresa::class, 'empresa_id');
    }
}
