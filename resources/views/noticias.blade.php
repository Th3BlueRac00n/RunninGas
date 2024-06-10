<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="/CSS/estilos.css">
</head>
<body>
<header>
    @include('header')
    @if(session()->has('nombre_usuario'))
            <?php
            $sessionId = session('id');
            $usuario = \App\Models\Usuario::find($sessionId);
            $nombreUsuario = $usuario ? $usuario->nombre_usuario : null;
            ?>

        @if(session('esAdmin'))
            <p>Bienvenido Don {{ $nombreUsuario }}</p>
        @else
            <p>Hola otra vez {{ $nombreUsuario }}</p>
        @endif
    @else
        <p>Bienvenido</p>
    @endif
</header>
<div id="contenedor">
    <span id="menulateral">
        @foreach($noticias as $noticia)
            <h3><a href="{{ route('noticia', ['id' => $noticia->id]) }}">{{ $noticia->titulo }}</a></h3>
        @endforeach
    </span>
    <span id="principal">
        <h1>NOTICIAS</h1>
        <div class="fila">
            @foreach($noticias as $index => $noticia)
                @if($index % 3 == 0)
                    </div><div class="fila">
                @endif
                <div class="noticias">
                    <h2><a href="{{ route('noticia', ['id' => $noticia->id]) }}">{{ $noticia->titulo }}</a></h2>
                    <img src="{{ asset('/storage/' . $noticia->imagen) }}">
                    <p>{{ $noticia->fecha }}</p>
                    <p>{{ $noticia->descripcion }}<br><a href="{{ route('noticia', ['id' => $noticia->id]) }}"><strong>Leer mas...</strong></a></p>
                </div>
            @endforeach
        </div>
    </span>
</div>
<!– Empieza el FOOTER –>
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
