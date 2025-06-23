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
        $sectorEmpresa2 = empresa::where('nombre', 'Empresa Generica 2')->first();
        $sectorEmpresa3 = empresa::where('nombre', 'Empresa Generica 3')->first();
        $sectorEmpresa4 = empresa::where('nombre', 'Empresa Generica 4')->first();
        $sectorEmpresa5 = empresa::where('nombre', 'Empresa Generica 5')->first();

        if ($sectorEmpresa1) {
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa1->id,
                'descripcion' => 'Ventas de bombas',
            ]);
        }
        if ($sectorEmpresa2) {
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa2->id,
                'descripcion' => 'Medicina',
            ]);
        }
        if ($sectorEmpresa3) {
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa3->id,
                'descripcion' => 'Farmacias',
            ]);
        }
        if ($sectorEmpresa4) {
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa4->id,
                'descripcion' => 'Mineria',
            ]);
        }
        if ($sectorEmpresa5) {
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa5->id,
                'descripcion' => 'Administracion',
            ]);
            sectorEmpresa::create([
                'empresa_id' => $sectorEmpresa5->id,
                'descripcion' => 'Informaticos',
            ]);
        }
    }
}
