<?php
session_start();

if(isset($_SESSION['usuario']))
    header('Location: usuario.php');
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
    </head>
    <body>
        <header>
            <div class="contenedor">
                <section class="contenido">
                    <h1>FUNDAHOG</h1>
                </section>
            </div>
            <section class="presentacion">
                <h1>Registro de las historias clínicas</h1>
            </section>
        </header>
        <section id="inicio-sesion">
                <h2 align="center">Inicio de Sesión</h2>
                <form id="iniciar-sesion" action="" onsubmit="javascript:return (login(), false);">
                    <table>
                        <tr>
                            <td>
                                <label for="nombre">Nombre de usuario:</label>
                                <br>
                                <input id="nombre" type="text" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="clave">Contraseña:</label>
                                <br>
                                <input id="clave" type="password" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Iniciar sesión">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div id="status"></div>
                            </td>
                        </tr>
                    </table>
                </form>
        </section>
    </body>
    <script src="js/jquery-2.0.0.min.js"></script>
    <script src="js/index.js"></script>
</html>