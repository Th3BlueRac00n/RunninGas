<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('equipos')->insert([
            [
                'nombre' => 'Zaragoza Atletismo',
                'presidente' => 'Juan Pérez',
                'direccion' => ' Av. de la Velocidad, 123',
                'telefono' => '555-123-456',
                'correo' => ' info@velocidadextrema.com',
                'codigo' => 'VE001',
            ],
            [
                'nombre' => 'Club Deportivo Correcaminos',
                'presidente' => ' María Rodríguez',
                'direccion' => 'Calle de los Corredores, 456',
                'telefono' => '555-987-654',
                'correo' => ' contacto@correcaminoscd.com',
                'codigo' => 'CC002',
            ],
            [
                'nombre' => 'Equipo Olímpico Maratón Plus',
                'presidente' => 'Carlos Gutiérrez',
                'direccion' => ' Paseo de la Resistencia, 789',
                'telefono' => '555-456-789',
                'correo' => ' maratonplus@email.com',
                'codigo' => 'MP003',
            ],
            [
                'nombre' => 'Asociación Deportiva Corredores Unidos',
                'presidente' => ' Antonio López',
                'direccion' => ' Calle de los Corredores Unidos, 890',
                'telefono' => '555-321-654',
                'correo' => 'contacto@corredoresunidos.com',
                'codigo' => 'CU005',
            ],
        ]);
    }
}
