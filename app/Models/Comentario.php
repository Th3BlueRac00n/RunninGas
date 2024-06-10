<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';

    protected $fillable = ['texto','fecha', 'valoracion', 'id_carrera', 'id_usuario'];

    public $timestamps = false;

    public function carrera()
    {
        return $this->belongsTo(Carreras::class, 'id_carrera');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
