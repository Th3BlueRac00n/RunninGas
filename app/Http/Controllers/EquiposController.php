<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    //

    public function listarEquipos(){
            $equipos = Equipo::simplePaginate(5);
            return view('listarEquipos', compact('equipos'));
    }

    public function agregarEquipo(Request $request)
    {
        if (!session()->has('id')) {
            // Si el usuario no está autenticado, redirigir al formulario de inicio de sesión
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar una noticia.');
        }

        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'presidente' => ['required', 'string'],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string'],
            'correo' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'max:10'],
        ]);

// Crear la noticia con el ID del usuario autenticado
        Equipo::create([
            'nombre' => $request->nombre,
            'presidente' => $request->presidente,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'codigo'    => $request->codigo,
        ]);
        return redirect()->route('listarEquipos')->with('success', 'Equipo creado correctamente');
    }

    public function editarEquipo($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('editarEquipo', compact('equipo'));
    }

    public function actualizarEquipo(Request $request, Equipo $equipo)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'presidente' => ['required', 'string'],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string'],
            'correo' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'max:10'],
        ]);

        $equipo->update([
            'nombre' => $request->nombre,
            'presidente' => $request->presidente,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'codigo'    => $request->codigo,
        ]);
        return redirect()->route('listarEquipos')->with('success', 'Equipo actualizado correctamente');
    }

    public function eliminarEquipo(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('listarEquipos')->with('success', 'Equipo eliminado correctamente');
    }


}
