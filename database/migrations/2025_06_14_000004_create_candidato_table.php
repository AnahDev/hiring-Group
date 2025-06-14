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
        Schema::create('candidato', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuario')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('direccion', 255)->nullable();
            $table->timestamps();
        });
        Schema::create('experienciaLaboral', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidato_id')->constrained('candidato')->onDelete('cascade');
            $table->string('empresa');
            $table->string('cargo');
            $table->date('fechaInicio');
            $table->date('fechaFin')->nullable();
            $table->timestamps();
        });
        Schema::create('estudios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidato_id')->constrained('candidato')->onDelete('cascade');
            $table->string('nombreUni', 100);
            $table->string('carrera', 100);
            $table->date('fechaEgreso')->nullable();
            $table->timestamps();
        });
        Schema::create('telefono', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidato_id')->constrained('candidato')->onDelete('cascade');
            $table->string('numero', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidato');
        Schema::dropIfExists('experienciaLaboral');
        Schema::dropIfExists('estudios');
        Schema::dropIfExists('telefono');
    }
};
