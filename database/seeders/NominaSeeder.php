<?php

namespace Database\Seeders;

use App\Models\empresa;
use App\Models\nomina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NominaSeeder extends Seeder
{
    public function run(): void
    {
        $empresaNomina1 = empresa::where('id', '1')->firts;
        $empresaNomina2 = empresa::where('id', '2')->firts;
        $empresaNomina3 = empresa::where('id', '3')->firts;
        $empresaNomina4 = empresa::where('id', '4')->firts;
        $empresaNomina5 = empresa::where('id', '5')->firts;

        if ($empresaNomina1) {
            nomina::create([
                'empresa_id' => $empresaNomina1->id,
                'mes' => '5',
                'año' => '2025',
                'fechaGeneracion' => now(),
            ]);
        }
        if ($empresaNomina2) {
            nomina::create([
                'empresa_id' => $empresaNomina2->id,
                'mes' => '2',
                'año' => '2025',
                'fechaGeneracion' => now(),
            ]);
        }
        if ($empresaNomina3) {
            nomina::create([
                'empresa_id' => $empresaNomina3->id,
                'mes' => '10',
                'año' => '2022',
                'fechaGeneracion' => now(),
            ]);
        }
        if ($empresaNomina4) {
            nomina::create([
                'empresa_id' => $empresaNomina4->id,
                'mes' => '6',
                'año' => '2023',
                'fechaGeneracion' => now(),
            ]);
        }
        if ($empresaNomina5) {
            nomina::create([
                'empresa_id' => $empresaNomina5->id,
                'mes' => '5',
                'año' => '2025',
                'fechaGeneracion' => now(),
            ]);
        }
    }
}
