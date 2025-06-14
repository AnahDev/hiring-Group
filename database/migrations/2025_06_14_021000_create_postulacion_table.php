<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('postulacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidato_id')->constrained('candidato')->onDelete('cascade');
            $table->foreignId('oferta_laboral_id')->constrained('oferta_laboral')->onDelete('cascade');
            $table->date('fechaPostulacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulacion');
    }
};
