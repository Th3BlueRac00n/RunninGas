<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Carrera</title>
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
    <h1>Crear Carrera</h1>

    <form action="{{ route('agregarCarrera') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required maxlength="20"  title="Demasiado largo">

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="mapa">Mapa:</label>
        <input type="file" id="mapa" name="mapa">

        <label for="categoria">Categoria:</label>
        <select name="categoria" required>
            <option value="asfalto">Asfalto</option>
            <option value="canicross">Canicross</option>
            <option value="cross">Cross</option>
            <option value="obstaculos">Obstaculos</option>
            <option value="tierra">Tierra</option>
        </select><br>

        <label for="modalidad">Modalidad:</label>
        <select name="modalidad" required>
            <option value="andando">Andando</option>
            <option value="corriendo">Corriendo</option>
        </select><br>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora">

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">

        <label for="lugar">Lugar:</label>
        <input type="text" id="lugar" name="lugar" >

        <label for="distancia">Distancia:</label>
        <input type="number" id="distancia" name="distancia" maxlength="4"  title="Demasiado largo">

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" maxlength="3"  title="Demasiado largo" >

        <button type="submit">Añadir Carrera</button>
    </form>
</div>
<button><a href="/listarCarreras">Volver</a></button>
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
