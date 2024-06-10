<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Control</title>
    <link rel="stylesheet" href="/CSS/estilos.css">

</head>
<body>
<header>
    @include('header')
    @if(session()->has('nombre_usuario'))
        @if(session('esAdmin'))
            <p>Don {{ session('nombre_usuario') }}</p>
            <div class="container">
                <h1>Panel de Control</h1>
                <button class="boton"><a href="/verPerfil" class="btn">Ver perfil</a></button>
                <button class="boton"><a href="/listarUsuarios" class="btn">Usuarios</a></button>
                <button class="boton"><a href="/listarNoticias"  class="btn">Noticias</a></button>
                <button class="boton"><a href="/listarCarreras"  class="btn">Carreras</a></button>
               <button class="boton"><a href="/listarEquipos" class="btn">Equipos</a></button>
            </div>
        @else
                <?php header("Location: /verPerfil"); exit; ?>
        @endif
    @else
            <?php header("Location: /login"); exit; ?>
    @endif
</header>


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
