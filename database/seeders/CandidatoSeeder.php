<?php

namespace Database\Seeders;

use App\Models\candidato;
use App\Models\usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidatoSeeder extends Seeder
{

    public function run(): void
    {
        $usCandidato1 = usuario::where('correo', 'Candidato1@demo.com')->first();
        $usCandidato2 = usuario::where('correo', 'Candidato2@demo.com')->first();
        $usCandidato3 = usuario::where('correo', 'Candidato3@demo.com')->first();
        $usCandidato4 = usuario::where('correo', 'Candidato4@demo.com')->first();
        $usCandidato5 = usuario::where('correo', 'Candidato5@demo.com')->first();

        if ($usCandidato1) {
            candidato::create([
                'usuario_id' => $usCandidato1->id,
                'nombre' => 'Candidato 1',
                'apellido' => 'Generico',
                'direccion' => 'Puerto Ordaz',
            ]);
        }

        if ($usCandidato2) {
            candidato::create([
                'usuario_id' => $usCandidato2->id,
                'nombre' => 'Candidato 2',
                'apellido' => 'Generico',
                'direccion' => 'San felix',
            ]);
        }
        if ($usCandidato3) {
            candidato::create([
                'usuario_id' => $usCandidato2->id,
                'nombre' => 'Candidato 2',
                'apellido' => 'Generico',
                'direccion' => 'Caracas',
            ]);
        }
        if ($usCandidato3) {
            candidato::create([
                'usuario_id' => $usCandidato3->id,
                'nombre' => 'Candidato 3',
                'apellido' => 'Generico',
                'direccion' => 'Puerto Cabello',
            ]);
        }
        if ($usCandidato4) {
            candidato::create([
                'usuario_id' => $usCandidato4->id,
                'nombre' => 'Candidato 4',
                'apellido' => 'Generico',
                'direccion' => 'Puerto Ordaz',
            ]);
        }

        if ($usCandidato5) {
            candidato::create([
                'usuario_id' => $usCandidato5->id,
                'nombre' => 'Candidato 5',
                'apellido' => 'Generico',
                'direccion' => 'San Felix',
            ]);
        }
    }
}
