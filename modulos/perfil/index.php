<?php session_start();
    if(!isset($_SESSION['usuario']))
        header( 'Location: index.php');
    
    $usuario = NULL;

    require_once('config.php');
    
    $result = pg_query($cnn, "SELECT * FROM usuario WHERE nombreusuario = '$_SESSION[usuario]'");
    
    if(pg_num_rows($result)) {
        $usuario = array();
    }
    
    $usuario = pg_fetch_assoc($result);
    
    pg_close($cnn);
?>
<h1 align="center">
    <b>Actualiza tu perfil</b>
</h1>
<section id="registrar-usuario">
    <h2 align="center">Perfil de Usuario</h2>
    <form id="act-usuario" action="">
        <table id=n-usuario>
            <tr>
                <td>
                    <h3>
                        <b>Datos de la cuenta</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="NombreUsuario">Nombre de usuario:</label>
                    <br>
                    <input id="NombreUsuario" type="text" value="<?php echo($usuario['nombreusuario']) ?>" readonly="readonly">
                </td>
                <td>
                    <label for="Clave">Contraseña:</label>
                    <br>
                    <input id="Clave" type="password" required>
                </td>
                <td>
                    <label for="clave2">Repetir Contraseña:</label>
                    <br>
                    <input id="clave2" type="password" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="TipoUsuario">Tipo de Usuario:</label>
                    <br>
                    <select id="TipoUsuario" value="<?php echo($usuario['tipousuario']) ?>" disabled>
                        <option value="administrador">Administrador</option>
                        <option value="medico">Medico</option>
                        <option value="enfermera">Enfermera</option>
                    </select>
                </td>
                <td>
                    <label for="FechaIngreso">Fecha Ingreso:</label>
                    <br>
                    <input id="FechaIngreso" type="text" value="<?php echo($usuario['fechaingreso']) ?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Datos Personales</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="PrimerNombre">Primer Nombre:</label>
                    <br>
                    <input id="PrimerNombre" type="text"value="<?php echo($usuario['primernombre']) ?>" required>
                </td>
                <td>
                    <label for="SegundoNombre">Segundo Nombre:</label>
                    <br>
                    <input id="SegundoNombre" type="text" value="<?php echo($usuario['segundonombre']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="PrimerApellido">Primer Apellido:</label>
                    <br>
                    <input id="PrimerApellido" type="text" value="<?php echo($usuario['primerapellido']) ?>" required>
                </td>
                <td>
                    <label for="SegundoApellido">Segundo Apellido:</label>
                    <br>
                    <input id="SegundoApellido" type="text" value="<?php echo($usuario['segundoapellido']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="FechaNacimiento">Fecha Nacimiento:</label>
                    <br>
                    <input id="FechaNacimiento" type="text" value="<?php echo($usuario['fechanacimiento']) ?>" required>
                </td>
                <td>
                    <label for="LugarNacimiento">Lugar Nacimiento:</label>
                    <br>
                    <input id="LugarNacimiento" type="text" value="<?php echo($usuario['lugarnacimiento']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Nacionalidad">Nacionalidad:</label>
                    <br>
                    <select id="Nacionalidad" value="<?php echo($usuario['nacionalidad']) ?>">
                        <option value="v">V</option>
                        <option value="e">E</option>
                    </select>
                </td>
                <td>
                    <label for="Cedula">Cédula:</label>
                    <br>
                    <input id="Cedula" type="text" onkeypress="javascript:return soloNumeros(event);" value="<?php echo($usuario['cedula']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Pasaporte">Pasaporte:</label>
                    <br>
                    <input id="Pasaporte" type="text" onkeypress="javascript:return numeros(event);" value="<?php echo($usuario['pasaporte']) ?>" required>
                </td>
                <td>
                    <label for="Especialidad">Especialidad:</label>
                    <br>
                    <input id="Especialidad" type="text" value="<?php echo($usuario['especialidad']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>
                        <b>Dirección</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="EstadoResidencia">Estado:</label>
                    <br>
                    <input id="EstadoResidencia" type="text" value="<?php echo($usuario['estadoresidencia']) ?>" required>
                </td>
                <td>
                    <label for="CiudadResidencia">Ciudad:</label>
                    <br>
                    <input id="CiudadResidencia" type="text" value="<?php echo($usuario['ciudadresidencia']) ?>" required>
                </td>
                <td>
                    <label for="MunicipioResidencia">Municipio:</label>
                    <br>
                    <input id="MunicipioResidencia" type="text" value="<?php echo($usuario['municipioresidencia']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ParroquiaResidencia">Parroquia:</label>
                    <br>
                    <input id="ParroquiaResidencia" type="text" value="<?php echo($usuario['parroquiaresidencia']) ?>" required>
                </td>
                <td>
                    <label for="Urbanizacion_Sector_ZonaIndustrial">Urbanización/Sector:</label>
                    <br>
                    <input id="Urbanizacion_Sector_ZonaIndustrial" type="text" value="<?php echo($usuario['urbanizacion_sector_zonaindustrial']) ?>" required>
                </td>
                <td>
                    <label for="Avenida_Carrera_Esquina">Avenida/Carrera/Calle:</label>
                    <br>
                    <input id="Avenida_Carrera_Esquina" type="text" value="<?php echo($usuario['avenida_carrera_esquina']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Edificio_Quinta_Galpon">Edificio/Quinta/Galpón:</label>
                    <br>
                    <input id="Edificio_Quinta_Galpon" type="text" value="<?php echo($usuario['edificio_quinta_galpon']) ?>" required>
                </td>
                <td>
                    <label for="Piso_Planta_Local">Piso/Planta/Local:</label>
                    <br>
                    <input id="Piso_Planta_Local" type="text" value="<?php echo($usuario['piso_planta_local']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="CodigoPostal">Código Postal:</label>
                    <br>
                    <input id="CodigoPostal" type="text" onkeypress="javascript:return tlf(event);" value="<?php echo($usuario['codigopostal']) ?>" required>
                </td>
                <td>
                    <label for="OtraDireccion">Otra Dirección:</label>
                    <br>
                    <input id="OtraDireccion" type="text" value="<?php echo($usuario['otradireccion']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>
                        <b>Datos de Contacto</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="TlfMovil">Teléfono Móvil:</label>
                    <br>
                    <input id="TlfMovil" type="text" onkeypress="javascript:return tlf(event);" value="<?php echo($usuario['tlfmovil']) ?>" required>
                </td>
                <td>
                    <label for="TlfCasa">Teléfono de Casa:</label>
                    <br>
                    <input id="TlfCasa" type="text" onkeypress="javascript:return tlf(event);" value="<?php echo($usuario['tlfcasa']) ?>" required>
                </td>
                <td>
                    <label for="CorreoElectronico">Correo Electrónico:</label>
                    <br>
                    <input id="CorreoElectronico" type="text" value="<?php echo($usuario['correoelectronico']) ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <a class="boton" href="javascript:void(0);">Guardar cambios</a>
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