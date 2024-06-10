<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Carrera</title>
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
<div class="formularioCarrera">
    <h1>Editar Carrera</h1>
    <form action="{{ route('actualizarCarrera', ['carrera' => $carrera->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="{{ $carrera->titulo }}"><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion">{{ $carrera->descripcion }}</textarea><br>

        <label for="mapa">Mapa:</label><br>
        <input type="file" id="mapa" name="mapa"><br>

        <label for="categoria">Categoría:</label><br>
        <select id="categoria" name="categoria">
            <option value="asfalto" {{ $carrera->categoria == 'asfalto' ? 'selected' : '' }}>Asfalto</option>
            <option value="tierra" {{ $carrera->categoria == 'tierra' ? 'selected' : '' }}>Tierra</option>
            <option value="cross" {{ $carrera->categoria == 'cross' ? 'selected' : '' }}>Cross</option>
            <option value="obstaculos" {{ $carrera->categoria == 'obstaculos' ? 'selected' : '' }}>Obstáculos</option>
            <option value="canicross" {{ $carrera->categoria == 'canicross' ? 'selected' : '' }}>Canicross</option>
        </select><br>

        <label for="modalidad">Modalidad:</label><br>
        <select id="modalidad" name="modalidad">
            <option value="andando" {{ $carrera->modalidad == 'andando' ? 'selected' : '' }}>Andando</option>
            <option value="corriendo" {{ $carrera->modalidad == 'corriendo' ? 'selected' : '' }}>Corriendo</option>
        </select><br>

        <label for="hora">Hora:</label><br>
        <input type="time" id="hora" name="hora" value="{{ $carrera->hora }}"><br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha" value="{{ $carrera->fecha }}"><br>

        <label for="lugar">Lugar:</label><br>
        <input type="text" id="lugar" name="lugar" value="{{ $carrera->lugar }}"><br>

        <label for="distancia">Distancia (en kilómetros):</label><br>
        <input type="number" id="distancia" name="distancia" value="{{ $carrera->distancia }}"><br>

        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" value="{{ $carrera->precio }}"><br>

        <button type="submit" id="actualizarCarrera">Actualizar Carrera</button>
    </form>
</div>
<footer>
    <!-- Aquí va tu footer -->
</footer>
</body>
</html>
