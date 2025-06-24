<?php

namespace Database\Seeders;

use App\Models\contrato;
use App\Models\detalleNomina;
use App\Models\nomina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleNominaSeeder extends Seeder
{

    public function run(): void
    {
        //IDs de las nominas
        $nominaDetalle1 = nomina::where('id', '1')->firts();
        $nominaDetalle2 = nomina::where('id', '2')->firts();
        $nominaDetalle3 = nomina::where('id', '3')->firts();
        $nominaDetalle4 = nomina::where('id', '4')->firts();
        $nominaDetalle5 = nomina::where('id', '5')->firts();

        //IDs de los contratos
        $contratoDetalle1 = contrato::where('id', '1')->firts();
        $contratoDetalle2 = contrato::where('id', '2')->firts();
        $contratoDetalle3 = contrato::where('id', '3')->firts();
        $contratoDetalle4 = contrato::where('id', '4')->firts();
        $contratoDetalle5 = contrato::where('id', '5')->firts();

        if ($nominaDetalle1 && $contratoDetalle1) {
            detalleNomina::create([
                'nomina_id' => $nominaDetalle1->id,
                'contrato_id' => $contratoDetalle1->id,
                'sueldoBruto' => '200.00',
                'comisionHg' => '0.00',
                'deduccionInces' => '20.22',
                'salarioNeto' => '2.00'
            ]);
        }
        if ($nominaDetalle2 && $contratoDetalle2) {
            detalleNomina::create([
                'nomina_id' => $nominaDetalle2->id,
                'contrato_id' => $contratoDetalle2->id,
                'sueldoBruto' => '200.00',
                'comisionHg' => '0.00',
                'deduccionInces' => '20.22',
                'salarioNeto' => '2.00'
            ]);
        }
        if ($nominaDetalle3 && $contratoDetalle3) {
            detalleNomina::create([
                'nomina_id' => $nominaDetalle3->id,
                'contrato_id' => $contratoDetalle3->id,
                'sueldoBruto' => '200.00',
                'comisionHg' => '0.00',
                'deduccionInces' => '20.22',
                'salarioNeto' => '2.00'
            ]);
        }
        if ($nominaDetalle4 && $contratoDetalle4) {
            detalleNomina::create([
                'nomina_id' => $nominaDetalle4->id,
                'contrato_id' => $contratoDetalle4->id,
                'sueldoBruto' => '200.00',
                'comisionHg' => '0.00',
                'deduccionInces' => '20.22',
                'salarioNeto' => '2.00'
            ]);
        }
        if ($nominaDetalle5 && $contratoDetalle5) {
            detalleNomina::create([
                'nomina_id' => $nominaDetalle5->id,
                'contrato_id' => $contratoDetalle5->id,
                'sueldoBruto' => '200.00',
                'comisionHg' => '0.00',
                'deduccionInces' => '20.22',
                'salarioNeto' => '2.00'
            ]);
        }
    }
}
