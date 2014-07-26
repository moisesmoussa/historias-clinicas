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
    <link href='<?php echo $app['basedir'].'/css/font-awesome.min.css';?>' rel='stylesheet' type='text/css'>
    <?php
        if($app['controller'] == 'perfil' || $app['controller'] == 'administrador')
            echo "<link href='$app[basedir]/css/jquery.datetimepicker.css' rel='stylesheet' type='text/css'>";
        if($app['controller'] == 'administrador')
            echo "<link href='$app[basedir]/css/administrador.css' rel='stylesheet' type='text/css'>";
    ?>
</head>

<body>
    <header class='menu'>
        <div class="contenedor">
            <section class="contenido">
                <img src="<?php echo $app['basedir'].'/img/logo.png'; ?>" width="247" height="83">
            </section>
            <div class="navcontainer">
                <a href="<?php if(isset($_SESSION['administrador']) || isset($_SESSION['super_administrador']))
                                    echo $app['basedir'].'/administrador';
                               else if(isset($_SESSION['general']))
                                    echo $app['basedir'].'/general';
                               else
                                   echo $app['basedir'].'/autenticacion';
                         ?>"><i class="fa fa-home fa-fw"></i>Inicio</a>
                <?php 
                    if ((isset($_SESSION['administrador']) || isset($_SESSION['super_administrador'])) && $app['controller'] != 'perfil') 
                        echo '<a href="'.$app['basedir'].'/administrador/usuario">
                            <i class="fa fa-users fa-fw"></i>Usuarios
                        </a>
                        <a href="'.$app['basedir'].'/administrador/pacientes">
                            <i class="fa fa-stethoscope fa-fw"></i>Pacientes
                        </a>';
                    else if (isset($_SESSION['general']) && $app['controller'] != 'perfil')
                        echo '<a id="insertar" href="'.$app['basedir'].'/general/registrar-paciente">Paciente</a>';
                ?>
            </div>
            <?php echo '<nav class="area-perfil"><a class="perfil" href="javascript:void(0);"><i class="fa fa-user fa-fw"></i>'.$_SESSION['nombre_usuario'].'
            </a>
            <nav class="items-perfil">
                <ul>
                    <li>
                        <a href="'.$app['basedir'].'/perfil'.'"><i class="fa fa-edit fa-fw"></i>Editar perfil</a>
                    </li>
                    <li>
                        <a href="'.$app['basedir'].'/perfil/cambiar-clave'.'"><i class="fa fa-lock fa-fw"></i>Cambiar contraseña</a>
                    </li>
                    <li>
                        <a href="'.$app['basedir'].'/logout'.'"><i class="fa fa-sign-out fa-fw"></i>Cerrar sesión</a>
                    </li>
                </ul>
            </nav></nav>';
            ?>
        </div>
    </header>
		<?php
			/*
             * Aquí se renderizan las vistas o un error 404.
			 */
			if(!@include_once('modulos/'.str_replace('-', '_', $app['controller'].'/'.$app['action'].'.php')))
				require_once('modulos/errores/404.php');
		?>
	<?php echo '<script src="'.$app['basedir'].'/js/jquery-2.0.0.min.js"></script>'; ?>
    <?php echo '<script src="'.$app['basedir'].'/js/validaciones.js"></script>'; ?>
	<script>basedir = '<?php echo $app['basedir']; ?>';</script>
	<?php
        if($app['controller'] == 'perfil' || $app['controller'] == 'administrador')
			echo '<script defer src="'.$app['basedir'].'/js/jquery.datetimepicker.js"></script>';
		if($app['controller'] == 'perfil')
			echo '<script async defer src="'.$app['basedir'].'/js/perfil.js"></script>';
        if($app['controller'] == 'administrador')
			echo '<script async defer src="'.$app['basedir'].'/js/administrador.js"></script>';
        if($app['controller'] == 'general')
			echo '<script async defer src="'.$app['basedir'].'/js/general.js"></script>';
	?>
</body>

</html>
