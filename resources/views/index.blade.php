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
         <h3>Menu Lateral</h3>
        <div id="ww_5fa7a0c1c516c" v='1.3' loc='auto' a='{"t":"responsive","lang":"es","sl_lpl":1,"ids":[],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'>Más previsiones: <a href="https://oneweather.org/es/seville/25_days/" id="ww_5fa7a0c1c516c_u" target="_blank">Tiempo en Sevilla</a></div><script async src="https://app2.weatherwidget.org/js/?id=ww_5fa7a0c1c516c"></script>

        <div id='calendar'><strong>Loading...</strong></div>
<script>
var conf = {
    bgcolor: '#5692ce',
    newtab:  1,
    start:   1,         // 0:Domingo | 1:Lunes
    days:    "Lunes|Martes|Miercoles|Jueves|Viernes|Sabado|Domingo",
    months:  "Enero|Febrero|Marzo|Abril|Mayo|Junio|Julio|Agosto|Septiembre|Octubre|Noviembre|Diciembre",
    date:    "Ir al mes actual"
}
</script>
<script src='https://cdn.jsdelivr.net/gh/jmacuna/calendar-widget@master/create-calendar.js' type='text/javascript'></script>
<script src='https://www.tecnoblog.guru/feeds/posts/summary?max-results=1000&alt=json-in-script&orderby=published&callback=createCalendar' type='text/javascript'></script>
    </span>
    <span id="principal">
        <div class="primero">
           @if($carrera)
                <h2>{{ $carrera->titulo }}</h2>
                <td><img src="{{ asset('/storage/' . $carrera->mapa) }}" id="imagenCarreraIndex"></td>
                <a href="{{ route('carrera', ['id' => $carrera->id]) }}">
        <button id="indexInscribirse">Inscribete</button>
    </a>
            @else
                <p>No hay carreras disponibles</p>
            @endif
        </div>
        <div class="segundo">
           <span class="imagensegundo">
                <img src="imagenes/Inicio_imagen_running.jpg" alt="Corredor haciendo estiramientos de pierna miesntras se apoya en un arbol" title="Corredor haciendo estiramientos en un arbol">
           </span>
            <span class="textosegundo">
                <h1>
                   ¿Qué es el running?
                </h1>
                <p>
                    El running, también conocido como footing o correr, es una actividad física que consiste en desplazarse de manera rápida mediante la carrera a pie. Es una de las formas más simples y accesibles de ejercicio, ya que no requiere de equipamiento costoso ni de instalaciones específicas. Se puede practicar en cualquier lugar, desde parques y senderos hasta calles urbanas.
                </p>
                <h3>
                    Beneficios del running
                </h3>
                <ol>
                    <li>Mejora cardiovascular: Correr fortalece el corazón y los pulmones, mejorando la circulación sanguínea y aumentando la capacidad pulmonar.</li>
                    <li>Control de peso: Es una excelente manera de quemar calorías y mantener un peso saludable.</li>
                    <li>Fortalecimiento muscular: Ayuda a tonificar y fortalecer los músculos de las piernas, glúteos y abdomen.</li>
                    <li>Reducción del estrés: Correr libera endorfinas, neurotransmisores que reducen el estrés y mejoran el estado de ánimo.</li>
                    <li>Aumento de la resistencia: Con el tiempo, el running aumenta la resistencia física, permitiendo correr distancias más largas con menor fatiga.</li>
                </ol>
                <br>
                <h3>
                    Calzado para running
                </h3>
                <p>
                    El calzado es un elemento fundamental para cualquier corredor. Los zapatos para running están diseñados específicamente para brindar amortiguación, soporte y estabilidad durante la actividad. Al elegir un calzado para running, es importante considerar factores como el tipo de pisada, el terreno en el que se correrá y el nivel de amortiguación necesario.
                </p>
            </span>
        </div>
        <div class="tercero">
           <span class="contenidoTercero">
                @if($noticia)
              <h3>

                {{ $noticia->titulo }}
                </h3>
                   <td><img src="{{ asset('/storage/' . $noticia->imagen) }}" id="imagenNoticiaIndex"></td>
                <p>Ultima hora - {{ $noticia->fecha }}</p>
                <p>{{ $noticia->descripcion }}</p>
                <a href="{{ route('noticia', ['id' => $noticia->id]) }}">Leer más...</a>
               @else
                   <p>No hay noticias disponibles</p>
               @endif
           </span>
        </div>
    </span>
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
