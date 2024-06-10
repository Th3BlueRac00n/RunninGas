<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;
    protected $table = 'inscripcion';

    protected $fillable = [
        'forma_pago',
        'carnetJoven',
        'modalidad',
        'categoria',
        'dorsal',
        'fecha_inscripcion',
        'recogida_dorsal',
        'id_usuario',
        'id_carrera',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carreras::class);
    }
}
