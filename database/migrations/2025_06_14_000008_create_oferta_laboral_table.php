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
        Schema::create('oferta_laboral', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresa')->onDelete('cascade');
            $table->foreignId('profesion_id')->constrained('profesion')->onDelete('cascade');
            $table->string('cargo');
            $table->text('descripcion');
            $table->decimal('salario', 10, 2)->nullable();
            $table->enum('estado', ['activa', 'inactiva'])->default('inactiva');
            $table->date('fechaCreacion')->nullable();
            $table->string('ubicacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oferta_laboral');
    }
};
