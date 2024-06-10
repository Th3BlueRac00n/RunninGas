<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Noticia</title>
    <link rel="stylesheet" href="/CSS/estilos.css">
</head>
<body>
<header>
    @include('header')
    @if(session()->has('nombre_usuario'))
        <p>Don {{ session('nombre_usuario') }}</p>

    @else
        <p>Bienvenido</p>

    @endif

</header>
<div class="formularioEquipo">
    <h1>Editar Equipo</h1>
    <form action="{{ route('actualizarEquipo', ['equipo' => $equipo->id]) }}" method="POST" >
        @csrf
        @method('PUT')
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $equipo->nombre }}"><br>

        <label for="presidente">Presidente:</label>
        <input type="text" name="presidente" value="{{ $equipo->presidente }}"><br>

        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" value="{{ $equipo->direccion }}"><br>

        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" value="{{ $equipo->telefono }}"><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="{{ $equipo->correo }}"><br>

        <label for="codigo">Codigo:</label>
        <input type="text" name="codigo" value="{{ $equipo->codigo }}"><br>

        <button type="submit" id="actualizarEquipo">Actualizar Equipo</button>
    </form>
</div>
<footer>
    <table >
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
