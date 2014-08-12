<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historias Clínicas - FUNDAHOG</title>
    <meta name="robots" content="noodp, noydir" />
    <meta name="description" content="Ingreso de pacientes y manejo de sus historias clinicas." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">
    <link href="<?php echo $app['basedir'].'/css/default.css'; ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo $app['basedir'].'/css/font-awesome.min.css';?>" rel="stylesheet" type="text/css">
    <link href="<?php echo $app['basedir'].'/css/tooltipster.css';?>" rel="stylesheet" type="text/css">
    <?php
        if($app['controller'] === 'usuarios' || $app['controller'] === 'pacientes')
            echo '<link href="'.$app['basedir'].'/css/jquery.datetimepicker.css" rel="stylesheet" type="text/css">';
        if($app['controller'] === 'usuarios')
            echo '<link href="'.$app['basedir'].'/css/usuarios.css" rel="stylesheet" type="text/css">';
        if($app['controller'] === 'pacientes')
            echo '<link href="'.$app['basedir'].'/css/pacientes.css" rel="stylesheet" type="text/css">';
    ?>
    
</head>

<body>
    <header class="menu">
        <div class="contenedor">
            <section class="contenido">
                <img src="<?php echo $app['basedir'].'/img/logo.png'; ?>" width="247" height="83">
            </section>
            <div class="navcontainer">
                <a href="<?php echo $app['basedir'].'/pages';?>"><i class="fa fa-home fa-fw"></i>Inicio</a>
                <?php 
                    if ((isset($_SESSION['administrador']) || isset($_SESSION['super_administrador']))) 
                        echo '<a href="'.$app['basedir'].'/usuarios"><i class="fa fa-users fa-fw"></i>Usuarios</a>';
                    echo '<a href="'.$app['basedir'].'/pacientes"><i class="fa fa-stethoscope fa-fw"></i>Pacientes</a>';
                ?>
                
            </div>
            <?php
        echo '<nav class="area-perfil"><a class="perfil" href="javascript:void(0);" title="Nombre de usuario"><i class="fa fa-user fa-fw"></i>'.$_SESSION['nombre_usuario'].'</a>
                <nav class="items-perfil">
                    <ul>
                        <li>
                            <a href="'.$app['basedir'].'/usuarios/perfil"><i class="fa fa-edit fa-fw"></i>Editar perfil</a>
                        </li>
                        <li>
                            <a href="'.$app['basedir'].'/usuarios/cambiar-clave"><i class="fa fa-lock fa-fw"></i>Cambiar contraseña</a>
                        </li>
                        <li>
                            <a href="'.$app['basedir'].'/usuarios/logout"><i class="fa fa-sign-out fa-fw"></i>Cerrar sesión</a>
                        </li>
                    </ul>
                </nav>
            </nav>';
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
    
    <script src="<?php echo $app['basedir'].'/js/jquery-2.0.0.min.js'; ?>"></script>
    <script src="<?php echo $app['basedir'].'/js/jquery.tooltipster.min.js'; ?>"></script>
    <script src="<?php echo $app['basedir'].'/js/default.js'; ?>"></script>
    <script src="<?php echo $app['basedir'].'/js/validaciones.js'; ?>"></script>
    <script>basedir = '<?php echo $app['basedir']; ?>';</script>
	<?php
        if($app['controller'] === 'usuarios' || $app['controller'] === 'pacientes')
			echo '<script async defer src="'.$app['basedir'].'/js/jquery.datetimepicker.js"></script>';
        if($app['controller'] === 'usuarios')
			echo '<script async defer src="'.$app['basedir'].'/js/usuarios.js"></script>';
        if($app['controller'] === 'pacientes')
			echo '<script async defer src="'.$app['basedir'].'/js/pacientes.js"></script>';
	?>
    
</body>

</html>