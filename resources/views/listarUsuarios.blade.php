<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listar Usuarios</title>
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
<h1>Listar Usuarios</h1>
<div id="contenedor">

    <table id="listarUsuariosTabla">
<thead>
<th>
    Usuario
</th>
<th>
    Nombre
</th>
<th>
    Apellidos
</th>
<th>
    Equipo
</th>
<th>
    DNI
</th>
<th>
    Correo
</th>
<th>
    Ciudad
</th>
<th>
    Carreras
</th>
<th>
    Admin
</th>
<th>
    Eliminar
</th>
</thead>
        <tbody>
        @foreach($usuarios as $usuario)
                <tr>
        <td>{{$usuario->nombre_usuario}}</td>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{$usuario->apellido1}} {{$usuario->apellido2}}</td>
                    <td>{{ $usuario->equipo ? $usuario->equipo->nombre : 'No' }}</td>
                    <td>{{$usuario->dni}}</td>
                    <td>{{$usuario->correo}}</td>
                    <td>{{ $usuario->direccion ? $usuario->direccion->ciudad : 'No especificada' }}</td>
                    <td>
                        @if($usuario->carreras->isEmpty())
                            No inscrito en ninguna carrera
                        @else
                            <ul>
                                @foreach($usuario->carreras as $carrera)
                                    <li>{{ $carrera->titulo }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td><a href="{{ route('hacerAdmin', ['usuario' => $usuario->id]) }}"><img src="imagenes/admin.png" width="8%"></a></td>
                    <td><a href="{{ route('eliminarUsuario', ['usuario' => $usuario->id]) }}"><img src="imagenes/eliminar1.png" width="8%"></a></td>

                </tr>
        @endforeach
    </tbody>
    </table>
    <div>
        {{$usuarios->links()}}
    </div>
</div>
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
