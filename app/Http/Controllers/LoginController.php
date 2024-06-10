<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function checkLogin(Request $request)
    {
        $parametros = [
            'usuario' => $request->usuario,
            'contrasena' => $request->contrasena
        ];

        $usuario = Usuario::where('nombre_usuario', $parametros['usuario'])->first();
        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        if (Hash::check($parametros['contrasena'], $usuario->contrasena)) {
            session()->put($usuario->getAttributes());
            return redirect('/runninGas');
        } else {
            return "Error de contraseña";
        }
    }

    public function cerrarSesion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/runninGas');
    }
}
