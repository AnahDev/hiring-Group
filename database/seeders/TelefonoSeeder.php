<?php

namespace Database\Seeders;

use App\Models\candidato;
use App\Models\telefono;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TelefonoSeeder extends Seeder
{

    public function run(): void
    {
        $telefonoCandidato1 = candidato::where('id', '1')->first();
        $telefonoCandidato2 = candidato::where('id', '2')->first();
        $telefonoCandidato3 = candidato::where('id', '3')->first();
        $telefonoCandidato4 = candidato::where('id', '4')->first();
        $telefonoCandidato5 = candidato::where('id', '5')->first();

        if ($telefonoCandidato1) {
            telefono::create([
                'candidato_id' => $telefonoCandidato1->id,
                'numero' => '111-11-11',
            ]);
        }
        if ($telefonoCandidato2) {
            telefono::create([
                'candidato_id' => $telefonoCandidato2->id,
                'numero' => '111-11-11',
            ]);
        }
        if ($telefonoCandidato3) {
            telefono::create([
                'candidato_id' => $telefonoCandidato3->id,
                'numero' => '111-11-11',
            ]);
        }
        if ($telefonoCandidato4) {
            telefono::create([
                'candidato_id' => $telefonoCandidato4->id,
                'numero' => '111-11-11',
            ]);
        }
        if ($telefonoCandidato5) {
            telefono::create([
                'candidato_id' => $telefonoCandidato5->id,
                'numero' => '111-11-11',
            ]);
        }
    }
}
