<?php

namespace Database\Seeders;

use App\Models\empresa;
use App\Models\sectorEmpresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorEmpresaSeeder extends Seeder
{

    public function run(): void
    {
        $sectorEmpresa1 = empresa::where('nombre', 'Empresa Generica 1')->first();

        if ($sectorEmpresa1) {
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa1->id,
                'descripcion' => 'Ventas de bombas',
            ]);

            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa1->id,
                'descripcion' => 'Medicina',
            ]);
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa1->id,
                'descripcion' => 'Farmacias',
            ]);
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa1->id,
                'descripcion' => 'Mineria',
            ]);
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa1->id,
                'descripcion' => 'Administracion',
            ]);
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa1->id,
                'descripcion' => 'Informaticos',
            ]);
        }
    }
}
