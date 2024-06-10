<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id', 'esAdmin'];
    protected $table = 'usuarios';
    public $timestamps = false;

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario');
    }

    public function carreras()
    {
        return $this->belongsToMany(Carreras::class, 'usuarios_carreras', 'id_usuario', 'id_carrera');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }
    public function telefonos()
    {
        return $this->hasMany(Telefono::class, 'id_usuario');
    }

    public function direccion()
    {
        return $this->hasOne(Direccion::class, 'id_usuario');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['contrasena'] = Hash::make($value);
    }

    public function getAuthPassword()
    {
        return $this->attributes['contrasena'];
    }

    public function getAuthIdentifierName()
    {
        return 'nombre_usuario';
    }

    public function getAuthIdentifier()
    {
        return $this->nombre_usuario;
    }
}
