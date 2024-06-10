<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carrera</title>
    <link rel="stylesheet" href="/CSS/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <p>Don {{ $nombreUsuario }}</p>
    @else
            <?php header("Location: /login"); exit; ?>
    @endif
</header>
<div id="contenedorInscripcion">
    <h1>Inscribirse</h1>
    <label>Nombre de Usuario</label>
    <input type="text" id="nombre_usuario" readonly name="nombre_usuario" value="{{ session('nombre_usuario') }}">
    <label>Nombre</label>
    <input type="text" id="nombre" readonly name="nombre" value="{{ session('nombre') }}">
    <label>Primer apellido</label>
    <input type="text" id="apellido1" readonly name="apellido1" value="{{ session('apellido1') }}">
    <label>Segundo apellido</label>
    <input type="text" id="apellido2" readonly name="apellido2" value="{{ session('apellido2') }}">
    <label>Sexo</label>
    <input type="text" id="sexo" readonly name="sexo" value="{{ session('sexo') }}">
    <label>Correo electronico</label>
    <input type="email" id="correo" readonly name="correo" value="{{ session('correo') }}">
    <label>DNI</label>
    <input type="text" readonly id="dni" name="dni" value="{{ session('dni') }}">
    <label>Fecha de Nacimiento</label>
    <input type="date" id="fecha_nacimiento" readonly name="fecha_nacimiento" value="{{ session('fecha_nacimiento') }}">
    <label>Ciudad</label>
    <input type="text" id="ciudad" name="ciudad" readonly value="{{ $direccion ? $direccion->ciudad : '' }}">
    <label>Calle</label>
    <input type="text" id="ciudad" name="ciudad" readonly value="{{ $direccion ? $direccion->calle : '' }}">
    <label>Codigo Postal</label>
    <input type="text" id="codigo_postal" name="codigo_postal" readonly value="{{ $direccion ? $direccion->codigo_postal : '' }}">

    @if($usuario->equipo)
        <label>Equipo atletismo</label>
        <input type="text" id="equipo" readonly name="equipo" value=" {{ $usuario->equipo->nombre }}">
    @else
        <input type="text" id="equipo" readonly name="equipo" value="No pertenece a ningún equipo">
    @endif

    <form action="{{ route('añadirInscripcion', ['idCarrera' => $idCarrera]) }}" method="post">
        @csrf
        <label for="forma_pago">Forma de pago:</label>
        <select name="forma_pago" required>
            <option value="tarjeta de credito">Tarjeta de credito</option>
            <option value="transferencia bancaria">Transferencia bancaria</option>
            <option value="efectivo">Efectivo</option>
        </select><br>

        <div class="form-group">
            <label for="carnetJoven">¿Tienes carnet joven?</label>
            <div class="opcion-si">
                <input type="radio" id="si" name="carnetJoven" value="1">
                <label for="si">Sí</label>
            </div>
            <div class="opcion-no">
                <input type="radio" id="no" name="carnetJoven" value="0">
                <label for="no">No</label>
            </div>
        </div>
        <label for="modalidad">Modalidad:</label>
        <select name="modalidad" required>
            <option value="individual">Individual</option>
            <option value="duo">Duo</option>
            <option value="trio">Trio</option>
            <option value="equipo">Equipo</option>
        </select><br>
        <input type="hidden" name="idCarrera" value="{{ $idCarrera }}">

        <label for="categoria">Categoria:</label>
        <select name="categoria" required>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
            <option value="mixto">Mixto</option>
        </select><br>

        <label for="dorsal">Dorsal:</label>
        <input type="text" id="dorsal" name="dorsal" readonly><br>

        <label for="recogida_dorsal">Recogida Dorsal:</label>
        <select name="recogida_dorsal" required>
            <option value="oficina">Oficina</option>
            <option value="carrera">Carrera</option>
        </select><br>
        <button type="submit">Inscripcion</button>
    </form>
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
<script>
    $(document).ready(function() {
        var idCarrera = {{ $idCarrera }};
        $.ajax({
            url: '/ultimo-dorsal/' + idCarrera,
            method: 'GET',
            success: function(data) {
                var ultimoDorsal = data.ultimoDorsal || 0;
                var nuevoDorsal = ultimoDorsal + 1;
                var dorsalFormateado = ('0000' + nuevoDorsal).slice(-5);
                $('#dorsal').val(dorsalFormateado);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
</body>
</html>
