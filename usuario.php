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
                        <a href="#">
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
        <section>
            <h2 align="center">Registro de Usuario</h2>
            <form id="nuevo-usuario" action="" onsubmit="javascript:return (agregarUsuario(), false);">
                <table id=n-usuario>
                    <tr>
                        <h3>
                            <b>Datos de la cuenta</b>
                        </h3>
                        <label for="NombreUsuario">Nombre de usuario:</label>
                        <br>
                        <input id="NombreUsuario" type="text" required>
                    </tr>
                    <tr>
                        <label for="Clave">Contraseña:</label>
                        <br>
                        <input id="Clave" type="password" required>
                    </tr>
                    <tr>
                        <label for="clave2">Repetir Contraseña:</label>
                        <br>
                        <input id="clave2" type="password" required>
                    </tr>
                    <tr>
                        <label for="PrimerNombre">Primer Nombre:</label>
                        <br>
                        <input id="PrimerNombre" type="text" required>
                    </tr>
                    <tr>
                        <label for="SegundoNombre">Segundo Nombre:</label>
                        <br>
                        <input id="SegundoNombre" type="text" required>
                    </tr>
                    <tr>
                        <label for="PrimerApellido">Primer Apellido:</label>
                        <br>
                        <input id="PrimerApellido" type="text" required>
                    </tr>
                    <tr>
                        <label for="SegundoApellido">Segundo Apellido:</label>
                        <br>
                        <input id="SegundoApellido" type="text" required>
                    </tr>
                    <tr>
                        <label for="FechaNacimiento">Fecha Nacimiento:</label>
                        <br>
                        <input id="FechaNacimiento" type="text" required>
                    </tr>
                    <tr>
                        <label for="LugarNacimiento">Lugar Nacimiento:</label>
                        <br>
                        <input id="LugarNacimiento" type="text" required>
                    </tr>
                    <tr>
                        <label for="Ficha">Ficha:</label>
                        <br>
                        <input id="Ficha" type="text" required>
                    </tr>
                    <tr>
                        <label for="Nacionalidad">Nacionalidad:</label>
                        <br>
                        <select id="Nacionalidad">
                            <option value="v">V</option>
                            <option value="e">E</option>
                        </select>
                    </tr>
                    <tr>
                        <label for="Cedula">Cédula:</label>
                        <br>
                        <input id="Cedula" type="text" onkeypress="javascript:return soloNumeros(event);" required>
                    </tr>
                    <tr>
                        <label for="TipoUsuario">Tipo de Usuario:</label>
                        <br>
                        <select id="TipoUsuario">
                            <option value="administrador">Administrador</option>
                            <option value="medico">Medico</option>
                            <option value="enfermera">Enfermera</option>
                        </select>
                    </tr>
                    <tr>
                        <label for="Pasaporte">Pasaporte:</label>
                        <br>
                        <input id="Pasaporte" type="text" onkeypress="javascript:return numeros(event);" required>
                    </tr>
                    <tr>
                        <label for="EstadoResidencia">Estado:</label>
                        <br>
                        <input id="EstadoResidencia" type="text" required>
                    </tr>
                    <tr>
                        <label for="CiudadResidencia">Ciudad:</label>
                        <br>
                        <input id="CiudadResidencia" type="text" required>
                    </tr>
                    <tr>
                        <label for="MunicipioResidencia">Municipio:</label>
                        <br>
                        <input id="MunicipioResidencia" type="text" required>
                    </tr>
                    <tr>
                        <label for="ParroquiaResidencia">Parroquia:</label>
                        <br>
                        <input id="ParroquiaResidencia" type="text" required>
                    </tr>
                    <tr>
                        <label for="Urbanizacion_Sector_ZonaIndustrial">Urbanización/Sector:</label>
                        <br>
                        <input id="Urbanizacion_Sector_ZonaIndustrial" type="text" required>
                    </tr>
                    <tr>
                        <label for="Avenida_Carrera_Esquina">Avenida/Carrera/Calle:</label>
                        <br>
                        <input id="Avenida_Carrera_Esquina" type="text" required>
                    </tr>
                    <tr>
                        <label for="Edificio_Quinta_Galpon">Edificio/Quinta/Galpón:</label>
                        <br>
                        <input id="Edificio_Quinta_Galpon" type="text" required>
                    </tr>
                    <tr>
                        <label for="Piso_Planta_Local">Piso/Planta/Local:</label>
                        <br>
                        <input id="Piso_Planta_Local" type="text" required>
                    </tr>
                    <tr>
                        <label for="CodigoPostal">Código Postal:</label>
                        <br>
                        <input id="CodigoPostal" type="text" onkeypress="javascript:return tlf(event);" required>
                    </tr>
                    <tr>
                        <label for="OtraDireccion">Otra Dirección:</label>
                        <br>
                        <input id="OtraDireccion" type="text" required>
                    </tr>
                    <tr>
                        <label for="TlfMovil">Teléfono Móvil:</label>
                        <br>
                        <input id="TlfMovil" type="text" onkeypress="javascript:return tlf(event);" required>
                    </tr>
                    <tr>
                        <label for="TlfCasa">Teléfono de Casa:</label>
                        <br>
                        <input id="TlfCasa" type="text" onkeypress="javascript:return tlf(event);" required>
                    </tr>
                    <tr>
                        <label for="CorreoElectronico">Correo Electrónico:</label>
                        <br>
                        <input id="CorreoElectronico" type="text" required>
                    </tr>
                    <tr>
                        <label for="Especialidad">Especialidad:</label>
                        <br>
                        <input id="Especialidad" type="text" required>
                    </tr>
                    <tr>
                        <label for="FechaIngreso">Fecha Ingreso:</label>
                        <br>
                        <input id="FechaIngreso" type="text" required>
                    </tr>
                    <tr>
                        <input type="submit" value="Registrar Usuario">
                    </tr>
                    <tr>
                        <div id="status"></div>
                    </tr>
                </table>
            </form>
        </section>
        <script src="js/jquery-2.0.0.min.js"></script>
        <script src="js/historias-clinicas.js"></script>
        <script src="js/usuario.js"></script>
        <script src="js/validaciones.js"></script>
    </body>
</html>