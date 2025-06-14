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
        Schema::create('nomina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresa')->onDelete('cascade');
            $table->tinyInteger('mes');
            $table->smallInteger('año');
            $table->date('fechaGeneracion');
            $table->timestamps();
        });

        Schema::create('detalleNomina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomina_id')->constrained('nomina')->onDelete('cascade');
            $table->foreignId('contrato_id')->constrained('contrato')->onDelete('cascade');
            $table->decimal('sueldoBruto');
            $table->decimal('comisionHg');
            $table->decimal('deduccionInces');
            $table->decimal('deduccionIvss');
            $table->decimal('salarioNeto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomina');
        Schema::dropIfExists('detalleNomina');
    }
};
