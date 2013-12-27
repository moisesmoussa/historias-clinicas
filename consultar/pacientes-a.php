<?php session_start();
    if(!isset($_SESSION['usuario']))
        header( 'Location: index.php');
    else{
        require_once('../config.php');
        $tipo = pg_query($cnn, "SELECT tipousuario FROM usuario WHERE nombreusuario = '$_SESSION[usuario]'");
        pg_close($cnn);
        $usuario = pg_fetch_assoc($tipo);
        if($usuario['tipousuario'] != 'Administrador')
            header(sprintf('Location: ../%s.php', strtolower($usuario['tipousuario'])));
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
    <link rel="stylesheet" type="text/css" href="../css/historias-clinicas.css">
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <header id="menu">
        <div class="contenedor">
            <section class="contenido">
                <img src="../img/logo.png" width="247" height="83">
            </section>
            <div class="navcontainer">
                <a href="../<?php echo(strtolower($usuario['tipousuario'])) ?>.php">Inicio</a>
                <a id="insertar" href="javascript:void(0);">Usuario</a>
                <nav id="item-menu">
                    <ul>
                        <li>
                            <a href="javascript:void(0);">Buscar</a>
                        </li>
                        <li>
                            <a href="../registrar-usuario.php">Registrar</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Eliminar</a>
                        </li>
                    </ul>
                </nav>
                <a href="pacientes-a.php">Pacientes
                    <i class="fa fa-stethoscope fa-fw"></i>
                </a>
            </div>
            <a id="perfil" href="javascript:void(0);">
                <?php echo $_SESSION[ 'usuario']; ?>
            </a>
            <nav id="modperfil">
                <ul>
                    <li>
                        <a href="../perfil.php">Modificar perfil</a>
                    </li>
                    <li>
                        <a id="usuario" href="javascript:void(0);">Cerrar sesión</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <h1 align="center">
        <b>Pacientes</b>
    </h1>
</body>
<script src="../js/jquery-2.0.0.min.js"></script>
<script src="../js/historias-clinicas.js"></script>

</html>