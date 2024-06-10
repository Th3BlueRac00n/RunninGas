<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listar Equipos</title>
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
<h1>Listar Equipos</h1>
<div id="contenedor">
    <table id="listarNoticiasTabla">
        <thead>
        <th>
            Nombre
        </th>
        <th>
            Presidente
        </th>
        <th>
            Direccion
        </th>
        <th>
            Telefono
        </th>
        <th>
            Correo
        </th>
        <th>
            Usuarios del club
        </th>

        <th>
            Editar
        </th>
        <th>
            Eliminar
        </th>
        </thead>
        <tbody>
        @foreach($equipos as $equipo)
            <tr>
                <td>{{$equipo->nombre}}</td>
                <td>{{$equipo->presidente}}</td>
                <td> {{$equipo->direccion}}</td>
                <td>{{$equipo->telefono}}</td>
                <td>{{$equipo->correo}}</td>
                <td>
                    <ul>
                        <li>{{$equipo->presidente}}</li>
                        @foreach($equipo->usuarios as $usuario)
                            <li>{{$usuario->nombre_usuario}} </li>
                        @endforeach
                    </ul>
                </td>
                <td><a href="{{ route('editarEquipo', ['id' => $equipo->id]) }}"><img src="imagenes/editar.png" width="8%"></a></td>
                <td><form action="{{ route('eliminarEquipo', ['equipo' => $equipo->id]) }}" method="POST">
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
        {{$equipos->links()}}
    </div>

</div>
<button class="boton"><a href="/crearEquipo">Crear equipos</a></button>
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
