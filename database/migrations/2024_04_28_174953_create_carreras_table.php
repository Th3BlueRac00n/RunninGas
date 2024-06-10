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
        Schema::create('carreras', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50);
            $table->string('descripcion', 255)->nullable();
            $table->string('mapa')->nullable();
            $table->enum('categoria', ['asfalto', 'tierra', 'cross', 'obstaculos', 'canicross']);
            $table->enum('modalidad', ['andando', 'corriendo']);
            $table->time('hora');
            $table->date('fecha');
            $table->string('lugar', 255);
            $table->tinyInteger('distancia');
            $table->tinyInteger('precio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras');
    }
};
