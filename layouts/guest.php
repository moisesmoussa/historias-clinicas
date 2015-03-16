<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historias Clínicas - IVSS</title>
    <meta name="robots" content="noodp, noydir" />
    <meta name="description" content="Ingreso de pacientes y manejo de sus historias clinicas." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo $app['basedir'].'/img/ivss.ico'; ?>" rel="icon" type="image/ico"/>
    <link href='<?php echo $app['basedir'].'/css/default.css'; ?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo $app['basedir'].'/css/font-awesome.min.css'?>' rel='stylesheet' type='text/css'>
    <link href="<?php echo $app['basedir'].'/css/tooltipster.css';?>" rel="stylesheet" type="text/css">
    <link href='<?php echo $app['basedir'].'/css/usuarios.css'; ?>' rel='stylesheet' type='text/css'>
</head>

<body>
    <header class="menu">
        <div class="contenedor">
            <section class="contenido">
                <img src="<?php echo $app['basedir'].'/img/logo.png'; ?>" width="83" height="83">
            </section>
            <div class="navcontainer">
                <label>
                    <b>Historias Clínicas</b>
                </label>
            </div>
        </div>
    </header>
    <?php
        /*
         * Aquí se renderizan las vistas de usuarios sin sesión iniciada (invitados) o un error 404.
         */
        if($app['action'] === 'password-reset') {
            require_once('json/usuario/check_forgot_password_token.php');
        } else if(!@include_once('modulos/'.str_replace('-', '_', $app['controller'].'/'.$app['action'].'.php')))
            require_once('modulos/errores/404.php');
    ?>
	<script>basedir = '<?php echo $app['basedir']; ?>';</script>
    <?php
        echo '<script src="'.$app['basedir'].'/js/jquery-2.1.1.min.js"></script>';
        echo '<script src="'.$app['basedir'].'/js/jquery.tooltipster.min.js"></script>';
    ?>
</body>

</html>