<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listar Noticias</title>
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
<h1>Listar Noticias</h1>
<div id="contenedor">
    <table id="listarNoticiasTabla">
        <thead>
        <th>
            Id noticia
        </th>
        <th>
            Usuario
        </th>
        <th>
            Título
        </th>
        <th>
            Fecha
        </th>
        <th>
            Imagen
        </th>
        <th>
            Descripcion
        </th>

        <th>
            Editar
        </th>
        <th>
            Eliminar
        </th>
        </thead>
        <tbody>
        @foreach($noticias as $noticia)
            <tr>
                <td>{{$noticia->id}}</td>
                <td> <a href="{{ route('mostrarUsuario', ['id' => $noticia->usuario->id]) }}">{{$noticia->usuario->nombre}}</a></td>
                <td>{{$noticia->titulo}}</td>
                <td> {{$noticia->fecha}}</td>
                <td><img src="{{ asset('/storage/' . $noticia->imagen) }}" style="width: 300px; height: 250px;"></td>
                <td>{{$noticia->descripcion}}</td>

                <td><a href="{{ route('editarNoticia', ['id' => $noticia->id]) }}"><img src="imagenes/editar.png" width="8%"></a></td>
                <td><form action="{{ route('eliminarNoticia', ['noticia' => $noticia->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="eliminar"><img src="imagenes/eliminar1.png" width="8%"></button>
                    </form>
                </td>



            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$noticias->links()}}
    </div>

</div>
<button class="boton"><a href="/crearNoticia">Crear noticia</a></button>
<button class="boton"><a href="/control">Volver</a></button>
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
