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
    <div id="contenedorNoticia">
        <div class="noticia">
            <h2>{{ $noticia->titulo }}</h2>
            <img src="{{ asset('/storage/' . $noticia->imagen) }}" id="imagenNoticia" >
            <p>{{ $noticia->descripcion }}</p>
            <p>Diez bomberos españoles batieron el pasado fin de semana en Zaragoza un récord mundial Guinness de distancia vertical recorrida en metros de desnivel positivo al subir por relevos los 389 escalones de la Torre del Agua, el 'rascacielos' de la ciudad con sus 76 metros de altura en el reciento de la Expo 2008, durante 24 horas de forma ininterrumpida.</p>
            <p>Los héroes del récord llegaron de destacamentos de bomberos de toda España: Javier Huerta y David Robles, del Ayuntamiento de Zaragoza; Abel Casas y Ángel García, de Tauste, en la provincia; Daniel García, Carlos Tejada, Juan Carlos Giménez y José Antonio Gómez, del consistorio de Madrid; Jesús Sánchez, de Baza (Granada); y Narciso Sánchez, de Toledo.</p>
            <p>La nueva plusmarca, aún pendiente de validar, se mide en metros. Y la cifra es de 24.568 metros, lo que equivale a subir 361 veces los 68 metros útiles de subida al edificio a través de sus 23 plantas. Cada bombero que completaba el relevo disponía de unos 55 segundos para bajar a la planta cero en ascensor y esperar su turno para volver a subir.</p>
            <p>Articulo creado por: <strong> <a href="{{ route('mostrarUsuario', ['id' => $noticia->usuario->id]) }}">{{ $noticia->usuario->nombre }}</a></strong></p>
        <p>Publicado en: {{ $noticia->fecha }}</p>
        </div>
    </div>
</div>
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
