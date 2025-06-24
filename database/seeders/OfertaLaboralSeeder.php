<?php

namespace Database\Seeders;

use App\Models\empresa;
use App\Models\ofertaLaboral;
use App\Models\profesion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfertaLaboralSeeder extends Seeder
{

    public function run(): void
    {
        //IDs empresas
        $empresaOferta1 = empresa::where('id', '1')->firts;
        $empresaOferta2 = empresa::where('id', '2')->firts;
        $empresaOferta3 = empresa::where('id', '3')->firts;
        $empresaOferta4 = empresa::where('id', '4')->firts;
        $empresaOferta5 = empresa::where('id', '5')->firts;

        //IDs profesiones
        $profesionOferta1 = profesion::where('id', '1')->firts;
        $profesionOferta2 = profesion::where('id', '2')->firts;
        $profesionOferta3 = profesion::where('id', '3')->firts;
        $profesionOferta4 = profesion::where('id', '4')->firts;
        $profesionOferta5 = profesion::where('id', '5')->firts;

        if ($empresaOferta1 && $profesionOferta1) {
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta1->id,
                'profesion_id' => $profesionOferta1->id,
                'cargo' => 'Analista de datos',
                'descripcion' => 'Hace cosas',
                'salario' => '20.2',
                'estado' => 'inactiva',
                'fechaCreacion' => now(),
                'ubicacion' => 'Los raudales',
            ]);
        }
        if ($empresaOferta2 && $profesionOferta2) {
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta2->id,
                'profesion_id' => $profesionOferta2->id,
                'cargo' => 'Analista de compras',
                'descripcion' => 'Hace cosas',
                'salario' => '20.2',
                'estado' => 'activa',
                'fechaCreacion' => now(),
                'ubicacion' => 'Los pueblos',
            ]);
        }
        if ($empresaOferta3 && $profesionOferta3) {
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta3->id,
                'profesion_id' => $profesionOferta3->id,
                'cargo' => 'Analista de ventas',
                'descripcion' => 'Hace cosas ',
                'salario' => '20.2',
                'estado' => 'inactiva',
                'fechaCreacion' => now(),
                'ubicacion' => 'San felix',
            ]);
        }
        if ($empresaOferta4 && $profesionOferta4) {
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta4->id,
                'profesion_id' => $profesionOferta4->id,
                'cargo' => 'Analista de datos',
                'descripcion' => 'Hace cosas de analita de datos',
                'salario' => '20.2',
                'estado' => 'activa',
                'fechaCreacion' => now(),
                'ubicacion' => 'Puerto Ordaz',
            ]);
        }
        if ($empresaOferta5 && $profesionOferta5) {
            ofertaLaboral::create([
                'empresa_id' => $empresaOferta5->id,
                'profesion_id' => $profesionOferta5->id,
                'cargo' => 'Supervisor',
                'descripcion' => 'Supervisa obviamente',
                'salario' => '0.2',
                'estado' => 'activa',
                'fechaCreacion' => now(),
                'ubicacion' => 'En su casa',
            ]);
        }
    }
}
