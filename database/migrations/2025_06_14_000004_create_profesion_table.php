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
        Schema::create('profesion', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->unique();
            $table->timestamps();
        });
        Schema::create('candidato_Profesion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidato_id')->constrained('candidato')->onDelete('cascade');
            $table->foreignId('profesion_id')->constrained('profesion')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesion');
        Schema::dropIfExists('candidato_Profesion');
    }
};
