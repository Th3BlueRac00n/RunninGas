<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    use HasFactory;
    protected $table = 'noticias';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'imagen',
        'id_usuario',
    ];

    protected $dates = [
        'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
