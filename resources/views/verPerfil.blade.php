<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver perfil</title>
    <link rel="stylesheet" href="/CSS/estilos.css">
</head>
<body>
<header>
    @include('header')
    @if(session()->has('nombre_usuario'))
            <?php
            $sessionId = session('id');
            $usuario = \App\Models\Usuario::find($sessionId);
            $nombreUsuario = $usuario ? $usuario->nombre_usuario : null;
            ?>
        <p>Don {{ $nombreUsuario }}</p>
    @else
            <?php header("Location: /login"); exit; ?>
    @endif
</header>
<p>Esto es ver el perfil</p>
<h1>Editar Perfil</h1>
<form action="{{ route('guardarPerfil') }}" method="post">
    @csrf
    <label>Usuario</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" value="{{ $usuario->nombre_usuario }}">
    <label>Nombre</label>
    <input type="text" id="nombre" name="nombre" value="{{ $usuario->nombre }}">
    <label>Primer apellido</label>
    <input type="text" id="apellido1" name="apellido1" value="{{ $usuario->apellido1 }}">
    <label>Segundo apellido</label>
    <input type="text" id="apellido2" name="apellido2" value="{{ $usuario->apellido2 }}">
    <label>Correo</label>
    <input type="email" id="correo" name="correo" value="{{ $usuario->correo }}">
    <label>DNI</label>
    <input type="text" id="dni" name="dni" value="{{ $usuario->dni }}" pattern="[0-9]{8}[A-Za-z]" title="Debe contener 8 números seguidos de una letra">
    <label>Fecha de Nacimiento</label>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento }}">
    <label>Ciudad</label>
    <input type="text" id="ciudad" name="ciudad" value="{{ $usuario->direccion ? $usuario->direccion->ciudad : '' }}">
    <label>Calle</label>
    <input type="text" id="calle" name="calle" value="{{ $usuario->direccion ? $usuario->direccion->calle : '' }}">
    <label>Codigo Postal</label>
    <input type="text" id="codigo_postal" name="codigo_postal" pattern="[0-9]{5}"  title="Debe contener 5 números" value="{{ $usuario->direccion ? $usuario->direccion->codigo_postal : '' }}">
    <label>Teléfono Principal</label>
    <input type="text" id="telefono_principal" name="telefono_principal" pattern="[0-9]{9}" title="Deben ser 9 numeros" value="{{ $telefonoPrincipal ? $telefonoPrincipal->telefono : '' }}">
    <label>Teléfono de Emergencia</label>
    <input type="text" id="telefono_emergencia" name="telefono_emergencia" pattern="[0-9]{9}" title="Deben ser 9 numeros" value="{{ $telefonoEmergencia ? $telefonoEmergencia->telefono : '' }}">
    <input type="submit" value="Guardar cambios">
</form>
<button><a href="/cambiarContrasena">Cambiar contraseña</a></button>
<footer>
    <table>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</footer>
</body>
</html>
