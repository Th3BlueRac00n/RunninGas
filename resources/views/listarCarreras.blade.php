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
<h1>Listar Carreras</h1>
<div id="contenedor">
    <table id="listarCarrerasTabla">
        <thead>
        <th>
            Imagen
        </th>
        <th>
            Título
        </th>
        <th>
            Fecha y hora
        </th>
        <th>
            Lugar
        </th>
        <th>
            Modalidad
        </th>
        <th>
            Distancia
        </th>
        <th>
            Editar
        </th>
        <th>
            Eliminar
        </th>
        </thead>
        <tbody>
    @foreach($carreras as $carrera)
        <tr>
            <td><img src="{{ asset('/storage/' . $carrera->mapa) }}" id="imagenListarCarreras" ></td>
            <td>{{$carrera->titulo}}</td>
            <td>{{$carrera->fecha}} , {{$carrera->hora}}</td>
            <td>{{$carrera->lugar}}</td>
            <td>{{$carrera->modalidad}}</td>
            <td>{{$carrera->distancia}} KM</td>
            <td><a href="{{ route('editarCarrera', ['id' => $carrera->id]) }}"><img src="imagenes/editar.png" width="8%"></a></td>
            <td>
                <form action="{{ route('eliminarCarrera', ['carrera' => $carrera->id]) }}" method="POST">
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
        {{$carreras->links()}}
    </div>
</div>
<button class="boton"><a href="/crearCarrera">Crear carrera</a></button>
<button class="boton"><a href="/control">Volver</a></button>
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
