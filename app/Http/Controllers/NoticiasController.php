<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use Illuminate\Http\Request;

class NoticiasController
{
    public function listarNoticias()
    {
        $noticias = Noticias::simplePaginate(5);
        return view('listarNoticias', compact('noticias'));
    }

    public function mostrarNoticias()
    {
        //Importante el compact
        $noticias = Noticias::all();
        return view('noticias', compact('noticias'));
    }

    public function verNoticia($id)
    {
        $noticia = Noticias::findOrFail($id);
        return view('noticia', compact('noticia'));
    }

    public function agregarNoticia(Request $request)
    {
        if (!session()->has('id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar una noticia.');
        }

        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'fecha' => ['required', 'date'],
            'imagen' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ]);
        if ($request->hasFile('imagen')) {
            $imageName = $request->imagen->store('public/imagenes');
            $imageName = str_replace('public/', '', $imageName);
        } else {
            $imageName = '/imagenes/pingui.jpg';
        }
        Noticias::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'imagen' => $imageName,
            'id_usuario' => session()->get('id'),
        ]);
        return redirect()->route('listarNoticias')->with('success', 'Noticia creada correctamente');
    }

    public function eliminarNoticia(Noticias $noticia)
    {
        $noticia->delete();
        return redirect()->route('listarNoticias')->with('success', 'Noticia eliminada correctamente');
    }

    public function editarNoticia($id)
    {
        $noticia = Noticias::findOrFail($id);
        return view('editarNoticia', compact('noticia'));
    }
    public function actualizarNoticia(Request $request, Noticias $noticia)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:57'],
            'descripcion' => ['required', 'string'],
            'fecha' => ['nullable', 'date'],
            'imagen' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ]);

        if ($request->hasFile('imagen')) {
            // Almacenar la nueva imagen y obtener su nombre
            $imageName = $request->imagen->store('public/imagenes');
            $imageName = str_replace('public/', '', $imageName);
            $noticia->update([
                'imagen' => $imageName,
            ]);
        }

        $noticia->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);
        return redirect()->route('listarNoticias')->with('success', 'Noticia actualizada correctamente');
    }

}
