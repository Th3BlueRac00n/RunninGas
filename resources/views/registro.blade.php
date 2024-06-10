<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="/CSS/estilos.css">
    <script>
        function mostrarClubes(selectElement) {
            var clubesContainer = document.getElementById("clubesContainer");
            if (selectElement.value === "si") {
                clubesContainer.style.display = "block";
            } else {
                clubesContainer.style.display = "none";
            }
        }
    </script>
</head>
<body>
<header>
    @include('header')
</header>
<div id="contenedor">
    <div class="formularioRegistro">
        <h2>Registro de Usuario</h2>
        <form action="{{ route('crearUsuario') }}" method="post">
            @csrf
            <label for="nombre_usuario">Usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido1">Primer apellido:</label>
            <input type="text" id="apellido1" name="apellido1" required>

            <label for="apellido2">Segundo apellido:</label>
            <input type="text" id="apellido2" name="apellido2" required>

            <label for="sexo">Sexo:</label>
            <select name="sexo" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otr@">Otr@</option>
            </select><br>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required minlength="8">

            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" required pattern="[0-9]{8}[A-Za-z]" title="Debe contener 8 números seguidos de una letra">

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required>

            <label for="calle">Calle:</label>
            <input type="text" id="calle" name="calle" required>

            <label for="codigo_postal">Código Postal:</label>
            <input type="text" id="codigo_postal" name="codigo_postal" required pattern="[0-9]{5}"  title="Debe contener 5 números">

            <label for="telefono1">Teléfono principal:</label>
            <input type="text" id="telefono1" name="telefono1" required pattern="[0-9]{9}" title="Deben ser 9 numeros">

            <label for="telefonoEmergencia">Teléfono de emergencia:</label>
            <input type="text" id="telefonoEmergencia" name="telefonoEmergencia" required pattern="[0-9]{9}" title="Deben ser 9 numeros">

            <label for="equipo_atletismo">¿Perteneces a un equipo de atletismo?</label>
            <select id="equipo_atletismo" name="equipo_atletismo" onchange="mostrarClubes(this)">
                <option value="no" selected>No</option>
                <option value="si">Sí</option>
            </select>
            <div class="club-atletismo" id="clubesContainer" style="display: none;">
                <label for="id_equipo">Selecciona tu club de atletismo:</label>
                <select id="id_equipo" name="id_equipo">
                    @foreach ($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
                <br>
                <label for="codigo">Codigo del club:</label>
                <input type="text" id="codigo" name="codigo" pattern="[A-Z0-9]{5}" title="Deben ser 5 digitos y letras en mayuscula">
            </div>

            <input type="submit" value="Registrarse">
        </form>
    </div>
</div>
</body>
</html>
