<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver usuario</title>
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
<body>
<h1>Información del Usuario</h1>
<p>Nombre: {{ $usuario->nombre_usuario }}</p>
<p>Correo: {{ $usuario->correo }}</p>
<h2>Carreras inscritas:</h2>
<ul>
    @foreach($usuario->carreras as $carrera)
        <li>{{ $carrera->titulo }} - {{ $carrera->fecha }}</li>
    @endforeach
</ul>
<footer>
    <table>
        <tr>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>

        </tr>
    </table>
</footer>
</body>
</html>
