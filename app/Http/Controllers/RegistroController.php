<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Equipo;
use App\Models\Telefono;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function crearUsuario(Request $request)
    {
        $attributes = $request->validate([
            'nombre_usuario' => ['required', 'min:4', 'max:50'],
            'nombre' => ['required', 'max:41'],
            'apellido1' => ['required', 'max:50'],
            'apellido2' => ['required', 'max:50'],
            'sexo' => ['required', 'in:masculino,femenino,otr@'],
            'contrasena' => ['required', 'min:2', 'max:41'],
            'correo' => ['required', 'email', 'max:50'],
            'dni' => ['required', 'max:9'],
            'fecha_nacimiento' => ['required', 'date'],
            'ciudad' => ['required', 'max:50'],
            'codigo_postal' => ['required', 'max:5'],
            'calle' => ['required', 'max:50'],
            'id_equipo' => ['nullable', 'exists:equipos,id'],
            'telefono1' => ['required', 'max:10'],
            'telefonoEmergencia' => ['required', 'max:10'],
        ]);

        if ($request->input('equipo_atletismo') === 'si') {
            $equipo = Equipo::find($request->input('id_equipo'));
            if ($equipo && $equipo->codigo === $request->input('codigo')) {
                $attributes['id_equipo'] = $equipo->id;
            } else {
                return back()->withErrors(['codigo' => 'El código del club es incorrecto.']);
            }
        } else {
            $attributes['id_equipo'] = null;
        }

        // Encriptar la contraseña
        $attributes['contrasena'] = Hash::make($attributes['contrasena']);

        // Crear el usuario
        $usuario = Usuario::create($attributes);

        // Crear los teléfonos
        Telefono::create([
            'telefono' => $request->telefono1,
            'tipo' => 'principal',
            'id_usuario' => $usuario->id,
        ]);

        Telefono::create([
            'telefono' => $request->telefonoEmergencia,
            'tipo' => 'emergencia',
            'id_usuario' => $usuario->id,
        ]);

        // Crear dirección
        Direccion::create([
            'codigo_postal' => $request->codigo_postal,
            'calle' => $request->calle,
            'ciudad' => $request->ciudad,
            'id_usuario' => $usuario->id,
        ]);

        // Guardar el usuario en la sesión y autenticar
        session()->put($usuario->getAttributes());
        auth()->loginUsingId($usuario->id);

        return redirect('/runninGas');
    }

    public function showRegistrationForm()
    {
        $equipos = Equipo::all();
        return view('registro', compact('equipos'));
    }
}
