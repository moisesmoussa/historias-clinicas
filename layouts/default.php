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
    <?php
        if($app['controller'] == 'prueba')
            echo "<link href='$app[basedir]/css/prematricula.css' rel='stylesheet' type='text/css'>";
    ?>
</head>

<body>
    <header id='menu'>
        <div class="contenedor">
            <section class="contenido">
                <img src="img/logo.png" width="247" height="83">
            </section>
            <div class="navcontainer">
                <a href="javascript:void(0);">Inicio</a>
                <?php 
                    if (isset($_SESSION['administrador']) && $app['controller'] != 'perfil') 
                        echo '<a id="insertar" href="javascript:void(0);">Usuario</a>
                        <nav id="item-menu">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">Buscar</a>
                                </li>
                                <li>
                                    <a href="'.$app['basedir'].'/administrador/registrar_usuario">Registrar</a>
                                </li>
                                <li>
                                    <a href="'.$app['basedir'].'/administrador/eliminar_usuario">Eliminar</a>
                                </li>
                            </ul>
                        </nav>
                        <a href="'.$app['basedir'].'/administrador/consultar_pacientes">Pacientes
                            <i class="fa fa-stethoscope fa-fw"></i>
                        </a>';
                    else if (isset($_SESSION['medico']) && $app['controller'] != 'perfil')
                        echo '<a id="insertar" href="javascript:void(0);">Paciente</a>
                        <nav id="item-menu">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">Buscar</a>
                                </li>
                                <li>
                                    <a href="'.$app['basedir'].'/medico/registrar_paciente">Registrar</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Eliminar</a>
                                </li>
                            </ul>
                        </nav>';
                ?>
            </div>
            <a id="perfil" href="javascript:void(0);">
                <?php if(isset($_SESSION['administrador']))
                        echo $_SESSION['administrador'];
                      else if(isset($_SESSION['medico']))
                        echo $_SESSION['medico'];
                      else if(isset($_SESSION['enfermera']))
                        echo $_SESSION['enfermera'];
                ?>
            </a>
            <nav id="modperfil">
                <ul>
                    <li>
                        <a href="<?php echo $app['basedir'].'/perfil'; ?>">Modificar perfil</a>
                    </li>
                    <li>
                        <a id="usuario" href="<?php echo $app['basedir'].'/logout'; ?>">Cerrar sesión</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
		<?php
			/*
				Aquí se renderizan las vistas o un error 404.
			*/
			if(!@include_once('modulos/'.str_replace('-', '_', $app['controller']).'/'.$app['action'].'.php'))
				require_once('modulos/errores/404.php');
		?> 
	<?php echo '<script src="'.$app['basedir'].'/js/jquery-2.0.0.min.js"></script>'; ?>
    <?php echo '<script src="'.$app['basedir'].'/js/validaciones.js"></script>'; ?>
	<script>basedir = '<?php echo $app['basedir']; ?>';</script>
	<?php
		if($app['controller'] == 'perfil')
			echo '<script async defer src="'.$app['basedir'].'/js/perfil.js"></script>';
        if($app['controller'] == 'administrador')
			echo '<script async defer src="'.$app['basedir'].'/js/administrador.js"></script>';
        if($app['controller'] == 'medico')
			echo '<script async defer src="'.$app['basedir'].'/js/medico.js"></script>';
	?>
</body>

</html>