<?php session_start(); if(!isset($_SESSION[ 'usuario'])) header( 'Location: index.php'); ?>
<!DOCTYPE html>
<html lang="es">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Historias Clínicas</title>
        <meta name="description" content="Ingresa datos de pacientes médicos, programa citas, ingresa y revisa recetas médicas, en general permite el control de un paciente en una clínica">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/historias-clinicas.css">
    </head>
    
    <body>
        <header>
            <div class="contenedor">
                <section class="contenido">
                    <h1>FUNDAHOG</h1>
                    <div id="navcontainer">
                        <a href="usuario.php">
                            <p>Inicio</p>
                        </a>
                        <a href="registrar-usuario.php">
                            <p>Registrar Usuario</p>
                        </a>
                        <a href="javascript:void(0);">
                            <p id="usuario">
                                <?php echo $_SESSION[ 'usuario']; ?>(Cerrar sesión)</p>
                        </a>
                    </div>
                </section>
            </div>
        </header>
        <h1 align="center">
            <b>Bienvenido a tu perfil</b>
        </h1>
    </body>
    <script src="js/jquery-2.0.0.min.js"></script>
    <script src="js/historias-clinicas.js"></script>

</html>
