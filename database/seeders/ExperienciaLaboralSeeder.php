<?php

namespace Database\Seeders;

use App\Models\candidato;
use App\Models\experienciaLaboral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienciaLaboralSeeder extends Seeder
{

    public function run(): void
    {
        $expLaboralCand1 = candidato::where('id', '1')->first();
        $expLaboralCand2 = candidato::where('id', '2')->first();
        $expLaboralCand3 = candidato::where('id', '3')->first();
        $expLaboralCand4 = candidato::where('id', '4')->first();
        $expLaboralCand5 = candidato::where('id', '5')->first();

        if ($expLaboralCand1) {
            experienciaLaboral::create([
                'candidato_id' => $expLaboralCand1->id,
                'empresa' => 'Empresa previa 1',
                'cargo' => 'Recursos humanos',
                'fechaInicio' => "2025/01/1",
                'fechaFin' => "2025/01/2"
            ]);
        }

        if ($expLaboralCand2) {
            experienciaLaboral::create([
                'candidato_id' => $expLaboralCand2->id,
                'empresa' => 'Empresa previa 2',
                'cargo' => 'Programador back',
                'fechaInicio' => "2025/02/1",
                'fechaFin' => "2025/04/2"
            ]);
        }
        if ($expLaboralCand3) {
            experienciaLaboral::create([
                'candidato_id' => $expLaboralCand3->id,
                'empresa' => 'Empresa previa 3',
                'cargo' => 'Desarrollador front',
                'fechaInicio' => "2025/01/1",
                'fechaFin' => "2025/01/15"
            ]);
        }
        if ($expLaboralCand1) {
            experienciaLaboral::create([
                'candidato_id' => $expLaboralCand4->id,
                'empresa' => 'Empresa previa 4',
                'cargo' => 'Recursos humanos',
                'fechaInicio' => "2025/01/1",
                'fechaFin' => "2025/12/1"
            ]);
        }
        if ($expLaboralCand1) {
            experienciaLaboral::create([
                'candidato_id' => $expLaboralCand5->id,
                'empresa' => 'Empresa previa 5',
                'cargo' => 'Recursos humanos',
                'fechaInicio' => "2025/01/1",
                'fechaFin' => "2025/01/25"
            ]);
        }
    }
}
