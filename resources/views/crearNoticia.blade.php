<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Noticia</title>
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
    <h1>Crear Noticia</h1>

    <form action="{{ route('agregarNoticia') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required maxlength="57"  title="Demasiado largo">

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required maxlength="254"   title="Demasiado largo"></textarea>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen">

        <button type="submit">Crear Noticia</button>
    </form>
</div>
<button><a href="/listarNoticias">Volver</a></button>
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
