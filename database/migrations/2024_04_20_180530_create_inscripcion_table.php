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
        Schema::create('inscripcion', function (Blueprint $table) {
            $table->id();
            $table->enum('forma_pago', ['tarjeta de credito','transferencia bancaria', 'efectivo']);
            $table->boolean('carnetJoven')->default(FALSE);
            $table->enum('modalidad', ['individual', 'duo','trio','equipo']);
            $table->enum('categoria', ['femenino', 'masculino','mixto']);
            $table->integer('dorsal');
            $table->date('fecha_inscripcion');
            $table->enum('recogida_dorsal', ['oficina', 'carrera']);
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_carrera')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion');
    }
};
