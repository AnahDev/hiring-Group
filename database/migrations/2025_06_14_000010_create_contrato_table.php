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
        Schema::create('contrato', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postulacion_id')->constrained('postulacion')->onDelete('cascade');
            $table->foreignId('banco_id')->constrained('banco')->onDelete('cascade');
            $table->date('fechaInicio');
            $table->date('fechaFin')->nullable();
            $table->enum('duracion', ['1 Mes', '6 Meses', '1 Año', 'indefinido'])->default('1 Mes');
            $table->decimal('salarioMensual');
            $table->string('tipoSangre');
            $table->string('tlfEmergencia');
            $table->string('contactoEmergencia');
            $table->string('cuentaBanco');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato');
    }
};
