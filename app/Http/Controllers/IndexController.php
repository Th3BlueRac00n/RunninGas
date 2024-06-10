<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Noticias;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios;

class IndexController
{
    public function index()
    {
        if (Auth::check()) {
            $mensajeUsuario = "Hola Don, " . Auth::user()->nombre_usuario;
        } else {
            $mensajeUsuario = "Bienvenido";
        }

        /*if (Carreras::where('id',1)->exists){
            $carrera = Carreras::findOrFail(1);
        }
       if (Noticias::where('id',1)->exists){
           $noticia = Noticias::find(1);
       }*/
        $fechaHoy = date('Y-m-d');
        $carrera = Carreras::where('fecha', '>=', $fechaHoy)->orderBy('fecha')->first();
        //El ultimo = el primero empezando por el final
        $noticia = Noticias::orderByDesc('id')->first();
        return view('index', compact('mensajeUsuario','carrera','noticia'));
        /*, 'carrera', 'noticia'*/
    }


}
