<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsuariosController extends Controller
{

    public function guardarPerfil(Request $request)
    {
        $userId = session('id');
        $usuario = Usuario::with('telefonos', 'direccion')->find($userId);

        if ($usuario) {
            // Actualizar al usuario
            $usuario->nombre_usuario = $request->input('nombre_usuario');
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido1 = $request->input('apellido1');
            $usuario->apellido2 = $request->input('apellido2');
            $usuario->correo = $request->input('correo');
            $usuario->dni = $request->input('dni');
            $usuario->fecha_nacimiento = $request->input('fecha_nacimiento');

            // Guardamos los cambios
            $usuario->save();

            //Actualizamos los datos de direccion
            $direccion = $usuario->direccion ?: new Direccion(['id_usuario' => $userId]);
            $direccion->ciudad = $request->input('ciudad');
            $direccion->calle = $request->input('calle');
            $direccion->codigo_postal = $request->input('codigo_postal');
            $direccion->save();

            // Actualizamos los telefonos del usuario
            $telefonoPrincipal = $usuario->telefonos->where('tipo', 'principal')->first() ?: new Telefono(['id_usuario' => $userId, 'tipo' => 'principal']);
            $telefonoPrincipal->telefono = $request->input('telefono_principal');
            $telefonoPrincipal->save();

            $telefonoEmergencia = $usuario->telefonos->where('tipo', 'emergencia')->first() ?: new Telefono(['id_usuario' => $userId, 'tipo' => 'emergencia']);
            $telefonoEmergencia->telefono = $request->input('telefono_emergencia');
            $telefonoEmergencia->save();

            return redirect()->route('verPerfil')->with('success', 'Perfil actualizado correctamente');
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    }

    public function listarUsuarios(){
       // $usuarios = Usuario::simplePaginate(5);
        $usuarios = Usuario::with('carreras')->simplePaginate(5);
        return view('listarUsuarios', compact('usuarios'));
    }

    public function hacerAdmin($id){
        $usuario = Usuario::find($id);
        if(!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        $usuario->esAdmin = true;
        $usuario->save();
        return redirect()->route('listarUsuarios')->with('success', 'El usuario ahora es administrador');
    }

    public function eliminarUsuario($id){
        $usuario = Usuario::find($id);
        if(!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        $usuario->delete();
        return redirect()->route('listarUsuarios')->with('success', 'El usuario ha sido eliminado correctamente');
    }

    public function editarPerfil()
    {
        $userId = session('id');
        $usuario = Usuario::find($userId);
        if ($usuario) {
            return view('editarPerfil', compact('usuario'));
        } else {
            return redirect()->route('verPerfil')->with('error', 'Usuario no encontrado');
        }
    }

    public function cambiarContrasena(Request $request)
    {
        $request->validate([
            'contrasenaactual' => 'required',
            'contrasenaactualverificar' => 'required|same:contrasenaactual',
            'nuevacontrasena' => 'required|min:8',
        ]);

        $userId = session('id');

        if (!$userId) {
            return back()->with('status', 'Usuario no autentificado.');
        }

        $user = Usuario::find($userId);
        if (!$user) {
            return back()->with('status', 'Usuario no encontrado.');
        }

        //Mirar si son correctas las contrasenas
        if (!Hash::check($request->contrasenaactual, $user->contrasena)) {
            return back()->with('status', 'La contraseña actual no es correcta.');
        }

        $user->contrasena = Hash::make($request->nuevacontrasena);
        $user->save();

        return back()->with('status', 'Contraseña cambiada con éxito.');
    }

    public function mostrarUsuario($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuario', compact('usuario'));
    }

    public function verPerfil()
    {
        $userId = session('id');
        $usuario = Usuario::with('telefonos', 'direccion')->find($userId);
        if ($usuario) {
            $telefonoPrincipal = $usuario->telefonos->where('tipo', 'principal')->first();
            $telefonoEmergencia = $usuario->telefonos->where('tipo', 'emergencia')->first();
            return view('verPerfil', compact('usuario', 'telefonoPrincipal', 'telefonoEmergencia'));
        } else {
            return redirect()->route('login')->with('error', 'Usuario no encontrado');
        }
    }


}
