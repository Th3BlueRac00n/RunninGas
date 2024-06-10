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
<div class="formularioNoticia">
    <h1>Editar Noticia</h1>
    <form action="{{ route('actualizarNoticia', ['noticia' => $noticia->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="{{ $noticia->titulo }}" maxlength="57"  title="Demasiado largo"><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" maxlength="254"   title="Demasiado largo">{{ $noticia->descripcion }}</textarea><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="{{ $noticia->fecha }}"><br>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen">

        <button type="submit" id="actualizarNoticia">Actualizar Noticia</button>
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
