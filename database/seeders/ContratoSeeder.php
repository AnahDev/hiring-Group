<?php

namespace Database\Seeders;

use App\Models\banco;
use App\Models\contrato;
use App\Models\postulacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContratoSeeder extends Seeder
{
    public function run(): void
    {
        //IDs contrato
        $postContrato1 = postulacion::where('id', '1')->first();
        $postContrato2 = postulacion::where('id', '2')->first();
        $postContrato3 = postulacion::where('id', '3')->first();
        $postContrato4 = postulacion::where('id', '4')->first();
        $postContrato5 = postulacion::where('id', '5')->first();

        //IDs bancos
        $bancoContrato1 = banco::where('id', '1')->first();
        $bancoContrato2 = banco::where('id', '2')->first();
        $bancoContrato3 = banco::where('id', '3')->first();
        $bancoContrato4 = banco::where('id', '4')->first();
        $bancoContrato5 = banco::where('id', '5')->first();

        if ($postContrato1 && $bancoContrato1) {
            contrato::create([
                'postulacion_id' => $postContrato1->id,
                'banco_id' => $bancoContrato1->id,
                'fechaInicio' => now(),
                'fechaFin' => null,
                'duracion' => '1 mes',
                'salarioMensual' => '10.2',
                'tipoSangre' => 'A+',
                'tlfEmergencia' => '000-00-00',
                'contactoEmergencia' => 'Patricio estrella',
                'cuentaBanco' => '12345',
            ]);
        }


        if ($postContrato2 && $bancoContrato2) {
            contrato::create([
                'postulacion_id' => $postContrato2->id,
                'banco_id' => $bancoContrato2->id,
                'fechaInicio' => now(),
                'fechaFin' => null,
                'duracion' => '6 meses',
                'salarioMensual' => '10.2',
                'tipoSangre' => 'O+',
                'tlfEmergencia' => '000-00-00',
                'contactoEmergencia' => 'Patricio estrella',
                'cuentaBanco' => '12345',
            ]);
        }

        if ($postContrato3 && $bancoContrato3) {
            contrato::create([
                'postulacion_id' => $postContrato3->id,
                'banco_id' => $bancoContrato3->id,
                'fechaInicio' => now(),
                'fechaFin' => null,
                'duracion' => '1 Año',
                'salarioMensual' => '10.2',
                'tipoSangre' => 'A-',
                'tlfEmergencia' => '000-00-00',
                'contactoEmergencia' => 'Patricio estrella',
                'cuentaBanco' => '12345',
            ]);
        }

        if ($postContrato4 && $bancoContrato4) {
            contrato::create([
                'postulacion_id' => $postContrato4->id,
                'banco_id' => $bancoContrato4->id,
                'fechaInicio' => now(),
                'fechaFin' => null,
                'duracion' => 'indefinido',
                'salarioMensual' => '10.2',
                'tipoSangre' => 'A+',
                'tlfEmergencia' => '000-00-00',
                'contactoEmergencia' => 'Patricio estrella',
                'cuentaBanco' => '12345',
            ]);
        }

        if ($postContrato5 && $bancoContrato5) {
            contrato::create([
                'postulacion_id' => $postContrato5->id,
                'banco_id' => $bancoContrato5->id,
                'fechaInicio' => now(),
                'fechaFin' => null,
                'duracion' => '1 mes',
                'salarioMensual' => '10.2',
                'tipoSangre' => 'A+',
                'tlfEmergencia' => '000-00-00',
                'contactoEmergencia' => 'Patricio estrella',
                'cuentaBanco' => '12345',
            ]);
        }
    }
}
