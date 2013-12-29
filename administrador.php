<?php session_start();
    if(!isset($_SESSION['usuario']))
        header( 'Location: index.php');
    else{
        require_once('config.php');
        $tipo = pg_query($cnn, "SELECT tipousuario FROM usuario WHERE nombreusuario = '$_SESSION[usuario]'");
        pg_close($cnn);
        $usuario = pg_fetch_assoc($tipo);
        if($usuario['tipousuario'] != 'Administrador')
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
    <header id="menu">
    <div class="contenedor">
        <section class="contenido">
            <img src="img/logo.png" width="247" height="83">
        </section>
        <div class="navcontainer">
            <a href="<?php echo(strtolower($usuario['tipousuario'])) ?>.php">Inicio</a>
            <a id="insertar" href="javascript:void(0);">Usuario</a>
            <nav id="item-menu">
                <ul>
                    <li>
                        <a href="javascript:void(0);">Buscar</a>
                    </li>
                    <li>
                        <a href="registrar-usuario.php">Registrar</a>
                    </li>
                    <li>
                        <a href="eliminar-usuario.php">Eliminar</a>
                    </li>
                </ul>
            </nav>
            <a href="consultar/pacientes-a.php">Pacientes
                <i class="fa fa-stethoscope fa-fw"></i>
            </a>
        </div>
        <a id="perfil" href="javascript:void(0);">
            <?php echo $_SESSION[ 'usuario']; ?>
        </a>
        <nav id="modperfil">
            <ul>
                <li>
                    <a href="perfil.php">Modificar perfil</a>
                </li>
                <li>
                    <a id="usuario" href="javascript:void(0);">Cerrar sesión</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
    <div class="area-frontal">
        <h1 align="center">
            <b>Bienvenido a tu perfil</b>
        </h1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>

        <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.</p>

        <p>Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.</p>

        <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut</p>
    </div>
</body>
<script src="js/jquery-2.0.0.min.js"></script>
<script src="js/historias-clinicas.js"></script>

</html>
