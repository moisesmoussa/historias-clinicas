<?php session_start();
    if(isset($_SESSION['usuario'])){
        require_once('config.php');
        $tipo = pg_query($cnn, "SELECT tipousuario FROM usuario WHERE nombreusuario = '$_SESSION[usuario]'");
        pg_close($cnn);
        $usuario = pg_fetch_assoc($tipo);
        header(sprintf('Location: %s.php', strtolower($usuario['tipousuario'])));
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Historias Clínicas</title>
    <meta name="description" content="Ingresa datos de pacientes médicos, programa citas, ingresa y revisa recetas médicas, en general permite el control de un paciente en una clínica">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/historias-clinicas.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <header id='menu'>
        <div class="contenedor">
            <section class="contenido">
                <img src="img/logo.png" width="247" height="83">
            </section>
            <div class="navcontainer">
                <label>
                    <b>Historias Clínicas</b>
                </label>
            </div>
        </div>
    </header>
    <section id="inicio-sesion">
        <h3 align="center">
            <b>Inicio de Sesión</b>
        </h3>
        <form id="iniciar-sesion" action="" onsubmit="javascript:return (login(), false);">
            <label for="nombre">Nombre de usuario:</label>
            <br>
            <input id="nombre" type="text" required>
            <br>
            <label for="clave">Contraseña:</label>
            <br>
            <input id="clave" type="password" required>
            <br>
            <input type="submit" value="Iniciar sesión">
            <br>
            <div id="status"></div>
        </form>
    </section>
</body>
<script src="js/jquery-2.0.0.min.js"></script>
<script src="js/index.js"></script>

</html>