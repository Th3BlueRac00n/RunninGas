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
<div id="contenedorCarreras">
    <span id="principal">
        <h1>CARRERAS</h1>
    </span>
    <div id="contenedorFiltros">
        <form action="{{ route('filtrarCarreras') }}" method="GET">
            @csrf
            <span class="filtro">
                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria">
                    <option value="">Selecciona una categoría</option>
                    <option value="asfalto">Asfalto</option>
                    <option value="canicross">Canicross</option>
                    <option value="cross">Cross</option>
                    <option value="tierra">Tierra</option>
                    <option value="obstaculos">Obstaculos</option>
                </select>
            </span>
            <span class="filtro">
                <label for="distancia">Distancia:</label>
                <input type="number" name="distancia" id="distancia" placeholder="Distancia en KM">
            </span>
            <span class="filtro">
                <label for="lugar">Lugar:</label>
                <input type="text" name="lugar" id="lugar" placeholder="Lugar de la carrera">
            </span>

            <button type="submit">Filtrar</button>
              <button type="submit" id="btnEliminarFiltro"><a href="/carreras">Eliminar </a></button>
        </form>
    </div>
    <div id="separador"></div>
</div>
<div id="contenedorMostrarCarreras">
    <div id="tablonDeCarreras">
        @foreach($carreras as $carrera)
        <div class="mostrarCarrera">
            <div class="tituloDistancia">
                <div class="titulo">

                    <a href="{{ route('carrera', ['id' => $carrera->id]) }}">{{ $carrera->titulo }}</a>
                </div>
                <div class="distancia">
                    {{ $carrera->distancia }} KM<br><br>
                    {{ $carrera->precio }} €
                </div>
            </div>
            <div class="precioCarrera">
                <div class="precio">
                    <h3>{{ $carrera->categoria}}</h3>
                    <h3>{{ $carrera->fecha}}</h3>
                </div>
            </div>
            <div class="diaMes">
                <img src="{{ asset('/storage/' . $carrera->mapa) }}" id="imagenCarrera" ">
                <p>{{ $carrera->hora }}</p>
            </div>
        </div>
        @endforeach
    </div>

</div>



</body>
</html>
