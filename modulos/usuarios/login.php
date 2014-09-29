<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historias Clínicas - FUNDAHOG</title>
    <meta name="robots" content="noodp, noydir" />
    <meta name="description" content="Ingreso de pacientes y manejo de sus historias clinicas." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href='<?php echo $app['basedir'].'/css/default.css'; ?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo $app['basedir'].'/css/usuarios.css'; ?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo $app['basedir'].'/css/font-awesome.min.css'?>' rel='stylesheet' type='text/css'>
</head>

<body>
    <header class="menu">
        <div class="contenedor">
            <section class="contenido">
                <img src="<?php echo $app['basedir'].'/img/logo.png'; ?>" width="247" height="83">
            </section>
            <div class="navcontainer">
                <label>
                    <b>Historias Clínicas</b>
                </label>
            </div>
        </div>
    </header>
    <section class="contenedor-form-login">
        <h3 align="center">
            <b>Inicio de Sesión</b>
        </h3>
        <form id="form-login" action="" autocomplete="on">
            <table class="formulario">
                <tr>
                    <td>
                        <label for="nombre">Usuario:</label>
                        <br>
                        <input id="nombre" name="nombre" type="text" pattern="^[a-zA-Z0-9_-]{4,16}$" autofocus required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="clave">Contraseña:</label>
                        <br>
                        <input id="clave" name="clave" type="password" pattern="^[a-zA-Z0-9\*\+\/\:\.\,\$\%\&\#\{\}_-]{6,18}$" autocomplete="off" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="boton" value="Iniciar Sesión"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="status"></div>
                    </td>
                </tr>
            </table>
        </form>
    </section>
	<script>basedir = '<?php echo $app['basedir']; ?>';</script>
    <?php echo '<script src="'.$app['basedir'].'/js/jquery-2.0.0.min.js"></script>'; 
          echo '<script async defer src="'.$app['basedir'].'/js/login.js"></script>';
    ?>
</body>

</html>