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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->text('texto');
            $table->enum('valoracion', ['Horrible', 'Mal', 'Decente', 'Bien', 'Excelente']);
            $table->unsignedBigInteger('id_carrera');
            $table->unsignedBigInteger('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
