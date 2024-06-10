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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_usuario')->unique();
            $table->string('nombre');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->enum('sexo', ['Masculino', 'Femenino','Otr@']);
            $table->string('contrasena');
            $table->boolean('esAdmin')->default(false);
            $table->string('correo');
            $table->string('dni');
            $table->date('fecha_nacimiento');
            $table->unsignedBigInteger('id_equipo')->nullable();
            $table->timestamps();
        });


        Schema::create('telefonos', function (Blueprint $table) {
            $table->id();
            $table->string('telefono');
            $table->enum('tipo', ['principal', 'emergencia']);
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_postal');
            $table->string('calle');
            $table->string('ciudad');
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
        Schema::dropIfExists('telefonos');
        Schema::dropIfExists('usuarios');
    }
};
