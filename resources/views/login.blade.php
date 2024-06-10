<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/CSS/estilos.css">
</head>
<body>
@include('header')
<div id="contenedor">
    <div class="formularioLogin">
        <h2>Iniciar Sesión</h2>
        <form action="login" method="post" id="loginForm">
            @csrf
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" id="nombre_usuario" placeholder="nombre_usuario" name="usuario" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="contrasena" placeholder="Contraseña" name="contrasena" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
        <div class="register">
            <a href="/registro">Registrarme</a>
        </div>
    </div>
</div>
</body>
</html>
