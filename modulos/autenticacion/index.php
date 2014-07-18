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
    <link href='<?php echo $app['basedir'].'/css/font-awesome.min.css'?>' rel='stylesheet' type='text/css'>
</head>

<body>
    <header id='menu'>
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
    <section class="inicio-sesion">
        <h3 align="center">
            <b>Inicio de Sesión</b>
        </h3>
        <form id="login" action="">
            <label for="nombre">Nombre de usuario:</label>
            <br>
            <input id="nombre" name="nombre" type="text" required>
            <br>
            <label for="clave">Contraseña:</label>
            <br>
            <input id="clave" name="clave" type="password" required>
            <br>
            <a class="boton" href="javascript:void(0);">Iniciar sesión</a>
            <br>
            <div id="status"></div>
        </form>
    </section>
	<script>basedir = '<?php echo $app['basedir']; ?>';</script>
    <?php echo '<script src="'.$app['basedir'].'/js/jquery-2.0.0.min.js"></script>'; 
          echo '<script async defer src="'.$app['basedir'].'/js/autenticacion.js"></script>'; ?>
</body>

</html>