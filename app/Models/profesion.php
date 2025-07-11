<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class profesion extends Model
{
    use HasFactory;
    protected $table = 'profesion';
    protected $fillable = [
        'descripcion',
    ];

    public function candidatoProfesiones(): HasMany
    {
        return $this->hasMany(candidato_profesion::class, 'profesion_id');
    }

    public function ofertaLaboral(): HasMany
    {
        return $this->hasMany(ofertaLaboral::class, 'profesion_id');
    }

    //REPETIDO, PERO NO SE DONDE JAJAJAJJA
    public function ofertas(): HasMany
    {
        return $this->hasMany(ofertaLaboral::class, 'profesion_id');
    }

    //Metodo de conveniencia 

    //Verifica si esta profesión tiene contratos asociados a traves de una cadena de conexiones
    public function tieneContratos(): bool
    {
        // Carga las relaciones necesarias
        // loadMissing() solo las carga si no están ya cargadas
        $this->loadMissing('ofertaLaboral.postulaciones.contrato');

        foreach ($this->ofertaLaboral as $oferta) {
            foreach ($oferta->postulaciones as $postulacion) {
                // Verificar si la colección de contratos para esta postulación no está vacía
                if ($postulacion->contrato->isNotEmpty()) {
                    return true; // Encontramos al menos un contrato
                }
            }
        }
        return false; // No se encontraron contratos en ninguna oferta/postulación
    }

    public function getAllContracts(): Collection
    {
        $allContracts = collect(); // Inicializa una colección vacía
        $this->loadMissing('ofertaLaboral.postulaciones.contrato'); // Asegura que las relaciones estén cargadas

        foreach ($this->ofertaLaboral as $oferta) {
            foreach ($oferta->postulaciones as $postulacion) {
                // Combina los contratos de cada postulación en la colección principal
                $allContracts = $allContracts->merge($postulacion->contrato);
            }
        }
        return $allContracts->unique('id'); // Elimina duplicados si un contrato pudiera aparecer dos veces (raro en este caso)
    }
}
