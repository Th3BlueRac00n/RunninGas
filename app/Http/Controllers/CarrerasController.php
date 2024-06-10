<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarrerasController extends Controller
{
    /*LISTAR CARRERAS*/
    public function listarCarreras(){
        $carreras = Carreras::simplePaginate(5);
        return view('/listarCarreras', compact('carreras'));
    }

    /*MOSTRAR CARRERAS*/
    public function mostrarCarreras()
    {
        $carreras = Carreras::all();
        return view('carreras', compact('carreras'));
    }

    /*MOSTRAR CARRERA INDIVIDUAL*/
    public function mostrarCarrera($id)
    {
        $carrera = Carreras::findOrFail($id);
        $comentarios = Comentario::where('id_carrera', $id)->get();
        $idUsuario = session('id_usuario');
        //Importante el compact
        return view('carrera', compact('carrera', 'comentarios', 'id'));
    }

    /*AGREGAR CARRERA*/
    public function agregarCarrera(Request $request){

        if (!session()->has('id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar una carrera.');
        }

        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => [ 'string'],
            'mapa' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'categoria' => ['required', 'in:asfalto,tierra,cross,obstaculos,canicross'],
            'modalidad' => ['required', 'in:andando,corriendo'],
            'hora' => [ 'date_format:H:i'],
            'fecha' => [ 'date'],
            'lugar' => [ 'required','string'],
            'distancia' => [ 'required','numeric'],
            'precio' => [ 'required','numeric'],
        ]);


        if ($request->hasFile('mapa')) {
            $imageName = $request->mapa->store('public/imagenes');
            $imageName = str_replace('public/', '', $imageName);
        } else {
            $imageName = '/imagenes/pingui.jpg';
        }

        $carrera = Carreras::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'mapa' => $imageName,
            'categoria' => $request->categoria,
            'modalidad' => $request->modalidad,
            'hora' =>  $request->hora,
            'fecha' => $request->fecha,
            'lugar' => $request->lugar,
            'distancia' => $request->distancia,
            'precio' => $request->precio,
                ]);
        $idUsuario = session()->get('id');

        return redirect()->route('listarCarreras')->with('success', 'Carrera creada correctamente');

    }

    public function eliminarCarrera(Carreras $carrera)
    {
        $carrera->delete();
        return redirect()->route('listarCarreras')->with('success', 'Carrera eliminada correctamente');
    }

    public function editarCarrera($id)
    {

        $carrera = Carreras::findOrFail($id);
        return view('editarCarrera', compact('carrera'));

    }

    public function actualizarCarrera(Request $request, Carreras $carrera)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => [ 'string'],
            'mapa' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'categoria' => ['required', 'in:asfalto,tierra,cross,obstaculos,canicross'],
            'modalidad' => ['required', 'in:andando,corriendo'],
            'hora' => ['nullable', 'date_format:H:i'],
            'fecha' => ['nullable', 'date'],
            'lugar' => [ 'required','string'],
            'distancia' => [ 'required','numeric'],
            'precio' => [ 'required','numeric'],
        ]);

        if ($request->hasFile('mapa')) {
            // Almacenar la nueva imagen y obtener su nombre
            $imageName = $request->mapa->store('public/imagenes');
            $imageName = str_replace('public/', '', $imageName);
             $carrera->update([
                'mapa' => $imageName,
            ]);
        }

        $carrera->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'lugar' => $request->lugar,
            'distancia' => $request->distancia,
            'precio' => $request->precio,
            'categoria' => $request->categoria,
            'modalidad' => $request->modalidad,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);
        return redirect()->route('listarCarreras')->with('success', 'Carrera actualizada correctamente');
        }

        public function detalleCarrera($id)
        {
            $carrera = Carreras::findOrFail($id);
            return view('carrera', compact('carrera'));
        }

    //FILTROS
    public function filtrarCarreras(Request $request)
    {
        // Recibe los datos del formulario de filtrado
        $categoria = $request->input('categoria');
        $distancia = $request->input('distancia');
        $lugar = $request->input('lugar');

        $query = Carreras::query();
        if ($categoria) {
            $query->where('categoria', $categoria);
        }
        if ($distancia) {
            $query->where('distancia', $distancia);
        }
        if ($lugar) {
            $query->where('lugar', 'like', '%' . $lugar . '%');
        }
        $carreras = $query->get();
        // Devuelve la vista de carreras pero con el filtro activado
        return view('carreras', compact('carreras'));
    }

}
