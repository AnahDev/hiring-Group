<?php

namespace Database\Seeders;

use App\Models\candidato;
use App\Models\ofertaLaboral;
use App\Models\postulacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostulacionSeeder extends Seeder
{
    public function run(): void
    {
        //IDs del candidato
        $postulacionCand1 = candidato::where('id', '1')->first();
        $postulacionCand2 = candidato::where('id', '2')->first();
        $postulacionCand3 = candidato::where('id', '3')->first();
        $postulacionCand4 = candidato::where('id', '4')->first();
        $postulacionCand5 = candidato::where('id', '5')->first();
        $postulacionCand6 = candidato::where('id', '6')->first();

        //IDs de las ofertas laborales

        $ofertasPostulacion1 = ofertaLaboral::where('id', '1')->first();
        $ofertasPostulacion2 = ofertaLaboral::where('id', '2')->first();
        $ofertasPostulacion3 = ofertaLaboral::where('id', '3')->first();
        $ofertasPostulacion4 = ofertaLaboral::where('id', '4')->first();
        $ofertasPostulacion5 = ofertaLaboral::where('id', '5')->first();
        $ofertasPostulacion6 = ofertaLaboral::where('id', '6')->first();

        if ($postulacionCand1 && $ofertasPostulacion1) {
            postulacion::create([
                'candidato_id' => $postulacionCand1->id,
                'oferta_laboral_id' => $ofertasPostulacion1->id,
                'fechaPostulacion' => now(),
            ]);
        }
        if ($postulacionCand2 && $ofertasPostulacion2) {
            postulacion::create([
                'candidato_id' => $postulacionCand2->id,
                'oferta_laboral_id' => $ofertasPostulacion2->id,
                'fechaPostulacion' => now(),
            ]);
        }
        if ($postulacionCand3 && $ofertasPostulacion3) {
            postulacion::create([
                'candidato_id' => $postulacionCand3->id,
                'oferta_laboral_id' => $ofertasPostulacion3->id,
                'fechaPostulacion' => now(),
            ]);
        }
        if ($postulacionCand4 && $ofertasPostulacion4) {
            postulacion::create([
                'candidato_id' => $postulacionCand4->id,
                'oferta_laboral_id' => $ofertasPostulacion4->id,
                'fechaPostulacion' => now(),
            ]);
        }
        if ($postulacionCand5 && $ofertasPostulacion5) {
            postulacion::create([
                'candidato_id' => $postulacionCand5->id,
                'oferta_laboral_id' => $ofertasPostulacion5->id,
                'fechaPostulacion' => now(),
            ]);
        }
        if ($postulacionCand6 && $ofertasPostulacion6) {
            postulacion::create([
                'candidato_id' => $postulacionCand6->id,
                'oferta_laboral_id' => $ofertasPostulacion6->id,
                'fechaPostulacion' => now(),
            ]);
        }
    }
}
