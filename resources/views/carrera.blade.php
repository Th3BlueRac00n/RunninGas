<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carrera</title>
    <link rel="stylesheet" href="/CSS/estilos.css">
    <style>
        #micanvas-container {
            position: relative;
            width: 100%;
            height: 100%;
        }
        #micanvas {
            position: absolute;
            top: 518px;
            left: 645px;
        }
        #micanvas2-container {
            position: relative;
            width: 100%;
            height: 100%;
        }
        #micanvas2 {
            position: absolute;
            top: 518px;
            left: 700px;
        }
    </style>
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
<div id="contenedorCarrera">
    <div id="headerCarrera">
        <span id="principalCarrera">
            <h1>CARRERA</h1>
        </span>
        <span id="fechaCarrera">
            <p>Fecha {{ $carrera->fecha }}</p>
        </span>
    </div>
    <div id="separador"></div>
</div>
<div id="contenedorCarreraIndividual">

    <div id="imagenIndividual">

        <td><img src="{{ asset('/storage/' . $carrera->mapa) }}" ></td>
    </div>
    <div id="informacionIndividual">
        <h1>{{ $carrera->titulo }}</h1>
        <h1>{{ $carrera->distancia }} Km</h1>
        <h1>{{ $carrera->lugar }}</h1>
        <h1>{{ $carrera->fecha }}</h1>
        <div class="imagenYHora">

             <div>
                <p>Categoria: {{ $carrera->categoria }}</p>
                <p> La modalidad sera {{ $carrera->modalidad }}</p>
                <p>Fecha de inicio {{ $carrera->hora }}</p>
            </div>
        </div>
        <h2>{{ $carrera->precio }} €</h2>
        @if(session()->has('nombre_usuario'))
            <a href="{{ route('crearInscripcion', ['idCarrera' => $carrera->id]) }}"><button id="indexInscribirse">Inscribirse</button></a>


        @else
                    <a href="{{ route('login') }}"><button id="indexInscribirse">Inscribirse</button></a>
        @endif
    </div>
</div>
<div id="contenedorComentarios">
    <h2>Comentarios</h2>
    @if($comentarios)
        @foreach($comentarios as $comentario)
            <div class="comentario">
                <p>
                    Usuario:
                    <a href="{{ route('mostrarUsuario', ['id' => $comentario->usuario->id]) }}">
                        {{ $comentario->usuario->nombre }}
                    </a>
                </p>
                <p>{{ $comentario->texto }}</p>
                <p>Valoración: <strong>{{ $comentario->valoracion }}</strong></p>
            </div>
        @endforeach
    @else
    <p>Todavia no hay comentarios</p>
    @endif

    @if(session()->has('nombre_usuario'))
        <form action="{{ route('guardarComentario') }}" method="POST">
            @csrf
            <input type="hidden" name="id_carrera" value="{{ $carrera->id }}">
            <textarea name="texto" placeholder="Escribe tu comentario..." required></textarea>
            <select name="valoracion" required>
                <option value="">Selecciona una valoración</option>
                <option value="Horrible">Horrible</option>
                <option value="Mal">Mal</option>
                <option value="Decente">Decente</option>
                <option value="Bien">Bien</option>
                <option value="Excelente">Excelente</option>
            </select>
            <button type="submit">Enviar comentario</button>
        </form>
    @else
        <p><a href="/login">Inicia sesión para escribir un comentario.</a> </p>
    @endif
</div>
<footer>
    <table>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</footer>
</body>
</html>
