<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usuario</title>
    <link rel="stylesheet" href="/CSS/estilos.css">
</head>
<body>
<header>
    @include('header')
    @if(session()->has('nombre_usuario'))
        <p>Don {{ session('nombre_usuario') }}</p>
    @else
            <?php header("Location: /login"); exit; ?>
    @endif
</header>
<div id="contenedor">
    <div class="cambioContrasena">
        <h2>Cambio de contraseña</h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="loginForm" method="POST" action="{{ route('cambiarContrasena') }}">
            @csrf
            <label for="contrasenaactual">Contraseña actual:</label>
            <input type="password" id="contrasenaactual" name="contrasenaactual" required minlength="8">

            <label for="contrasenaactualverificar">Repetir contraseña actual:</label>
            <input type="password" id="contrasenaactualverificar" name="contrasenaactualverificar" required minlength="8">

            <label for="nuevacontrasena">Nueva contraseña:</label>
            <input type="password" id="nuevacontrasena" name="nuevacontrasena" required minlength="8">

            <input type="submit" value="Guardar nueva contraseña">
        </form>
    </div>
</div>
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
