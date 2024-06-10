<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pruebaEstilos.css">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .menu-mobile {
            display: none;
            flex-direction: column;
            gap: 10px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 69, 0, 0.8);
            padding: 20px;
            box-sizing: border-box;
            z-index: 9999;
        }

        .menu-mobile a {
            text-decoration: none;
            color: #fff;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #333;
            text-align: center;
        }

        .hamburger {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10000;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: #333;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            table {
                display: none;
            }
        }
    </style>
</head>
<body>
<header>
    <table>
        <tr>
            <td id="logo">
                <a href="/runninGas"> <img src="../imagenes/logo.png" width="60%"></a>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td><a href="/runninGas">Inicio</a></td>
            <td><a href="/noticias">Noticias</a></td>
            <td><a href="/carreras">Carreras</a></td>
            <td><a href="/control"><img src="../imagenes/user.png" id="usuarioPerfil"></a></td>
            <td><a href="/cerrarSesion"><img src="../imagenes/logout.png" id="logout"></a></td>
        </tr>
    </table>

    <div class="hamburger" id="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <nav class="menu-mobile" id="menu-mobile">
        <a href="/runninGas">Inicio</a>
        <a href="/noticias">Noticias</a>
        <a href="/carreras">Carreras</a>
        <a href="/control">Perfil</a>
        <a href="/cerrarSesion">Cerrar sesion</a>
    </nav>
</header>

<script>
    document.getElementById('hamburger').addEventListener('click', function () {
        const menuMobile = document.getElementById('menu-mobile');
        if (menuMobile.style.display === 'flex') {
            menuMobile.style.display = 'none';
        } else {
            menuMobile.style.display = 'flex';
        }
    });

    const mobileLinks = document.querySelectorAll('.menu-mobile a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function () {
            document.getElementById('menu-mobile').style.display = 'none';
        });
    });
</script>
</body>
</html>
