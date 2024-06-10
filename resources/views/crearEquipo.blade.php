<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Equipo</title>
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
    <h1>Crear Equipo</h1>

    <form action="{{ route('agregarEquipo') }}" method="post">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="presidente">Presidente:</label>
        <input type="text" id="presidente" name="presidente" required>

        <label for="direccion">Direccion:</label>
        <input type="text" id="direccion" name="direccion" required>

        <label for="telefono">Telefono:</label>
        <input type="text" id="telefono" name="telefono" required pattern="[0-9]{9}" title="Deben ser 9 numeros">

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="codigo">Codigo:</label>
        <input type="text" id="codigo" name="codigo" required pattern="[A-Z0-9]{5}" title="Deben ser 5 digitos y letras en mayuscula">

        <button type="submit">Añadir Equipo</button>
    </form>
</div>
<button><a href="/listarEquipos">Volver</a></button>
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
