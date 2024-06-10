<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'mapa',
        'categoria',
        'modalidad',
        'hora',
        'fecha',
        'lugar',
        'distancia',
        'precio',
    ];

    protected $table = 'carreras';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuarios_carreras', 'id_carrera', 'id_usuario')
            ->withTimestamps();
    }
}
