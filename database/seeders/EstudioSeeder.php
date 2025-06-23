<?php

namespace Database\Seeders;

use App\Models\candidato;
use App\Models\estudio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstudioSeeder extends Seeder
{

    public function run(): void
    {
        $estudioCandidato1 = candidato::where('id', '1')->first();
        $estudioCandidato2 = candidato::where('id', '2')->first();
        $estudioCandidato3 = candidato::where('id', '3')->first();
        $estudioCandidato4 = candidato::where('id', '4')->first();
        $estudioCandidato5 = candidato::where('id', '5')->first();

        if ($estudioCandidato1) {
            estudio::create([
                'candidato_id' => $estudioCandidato1->id,
                'nombreUni' => 'UNEG',
                'carrera' => 'Ing Informatica',
                'fechaEgreso' => now(),
            ]);
            estudio::create([
                'candidato_id' => $estudioCandidato1->id,
                'nombreUni' => 'UNER',
                'carrera' => 'Ing Industrial',
                'fechaEgreso' => now(),
            ]);
        }
        if ($estudioCandidato2) {
            estudio::create([
                'candidato_id' => $estudioCandidato2->id,
                'nombreUni' => 'UNCAB',
                'carrera' => 'Ing Informatica',
                'fechaEgreso' => now(),
            ]);
        }
        if ($estudioCandidato3) {
            estudio::create([
                'candidato_id' => $estudioCandidato3->id,
                'nombreUni' => 'UNEG',
                'carrera' => 'Ing Informatica',
                'fechaEgreso' => now(),
            ]);
            estudio::create([
                'candidato_id' => $estudioCandidato3->id,
                'nombreUni' => 'UNER',
                'carrera' => 'Ing Industrial',
                'fechaEgreso' => now(),
            ]);
            estudio::create([
                'candidato_id' => $estudioCandidato3->id,
                'nombreUni' => 'UNER',
                'carrera' => 'Ing Electronica',
                'fechaEgreso' => now(),
            ]);
        }
        if ($estudioCandidato4) {
            estudio::create([
                'candidato_id' => $estudioCandidato4->id,
                'nombreUni' => 'UNEG',
                'carrera' => 'Ing Informatica',
                'fechaEgreso' => now(),
            ]);
        }
        if ($estudioCandidato5) {
            estudio::create([
                'candidato_id' => $estudioCandidato5->id,
                'nombreUni' => 'UNEG',
                'carrera' => 'Ing Informatica',
                'fechaEgreso' => now(),
            ]);
        }
    }
}
