<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    public function guardar(Request $request)
    {
        $request->validate([
            'texto' => 'required',
            'fecha' => [ 'date'],
            'valoracion' => 'required|in:Horrible,Mal,Decente,Bien,Excelente',
            'id_carrera' => 'required|exists:carreras,id',
        ]);

        Comentario::create([
            'texto' => $request->texto,
            'fecha' => $request->fecha,
            'valoracion' => $request->valoracion,
            'id_carrera' => $request->id_carrera,
            'id_usuario' => session()->get('id'),
        ]);
        return back();
    }
}
