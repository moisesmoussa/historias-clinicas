<section id="registrar-usuario">
    <h2 align="center">Registrar Usuarios</h2>
    <form id="nuevo-usuario" action="">
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
                    <input id="NombreUsuario" type="text" required>
                </td>
            </tr>
            <tr>
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
                    <select id="TipoUsuario">
                        <option value="administrador">Administrador</option>
                        <option value="medico">Medico</option>
                        <option value="enfermera">Enfermera</option>
                    </select>
                </td>
                <td>
                    <label for="FechaIngreso">Fecha Ingreso:</label>
                    <br>
                    <input class="calendario" id="FechaIngreso" type="text" readonly="readonly" required>
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
                    <input id="PrimerNombre" type="text" required>
                </td>
                <td>
                    <label for="SegundoNombre">Segundo Nombre:</label>
                    <br>
                    <input id="SegundoNombre" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="PrimerApellido">Primer Apellido:</label>
                    <br>
                    <input id="PrimerApellido" type="text" required>
                </td>
                <td>
                    <label for="SegundoApellido">Segundo Apellido:</label>
                    <br>
                    <input id="SegundoApellido" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="FechaNacimiento">Fecha Nacimiento:</label>
                    <br>
                    <input class="calendario" id="FechaNacimiento" type="text" readonly="readonly" required>
                </td>
                <td>
                    <label for="LugarNacimiento">Lugar Nacimiento:</label>
                    <br>
                    <input id="LugarNacimiento" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Cedula">Cédula:</label>
                    <br>
                    <input id="Cedula" class="numeros" type="text" required>
                </td>
                <td>
                    <label for="Especialidad">Especialidad:</label>
                    <br>
                    <input id="Especialidad" type="text" required>
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
                    <select id="EstadoResidencia">
                        <option value="vacio"></option>
                        <option value="Amazonas">Amazonas</option>
                        <option value="Anzoátegui">Anzoátegui</option>
                        <option value="Apure">Apure</option>
                        <option value="Aragua">Aragua</option>
                        <option value="Barinas">Barinas</option>
                        <option value="Bolívar">Bolívar</option>
                        <option value="Carabobo">Carabobo</option>
                        <option value="Cojedes">Cojedes</option>
                        <option value="DeltaAmacuro">Delta Amacuro</option>
                        <option value="DistritoCapital">Distrito Capital</option>
                        <option value="Falcón">Falcón</option>
                        <option value="Guárico">Guárico</option>
                        <option value="Lara">Lara</option>
                        <option value="Mérida">Mérida</option>
                        <option value="Miranda">Miranda</option>
                        <option value="Monagas">Monagas</option>
                        <option value="NuevaEsparta">Nueva Esparta</option>
                        <option value="Portuguesa">Portuguesa</option>
                        <option value="Sucre">Sucre</option>
                        <option value="Táchira">Táchira</option>
                        <option value="Trujillo">Trujillo</option>
                        <option value="Vargas">Vargas</option>
                        <option value="Yaracuy">Yaracuy</option>
                        <option value="Zulia">Zulia</option>
                    </select>
                </td>
                <td>
                    <label for="CiudadResidencia">Ciudad:</label>
                    <br>
                    <select id="CiudadResidencia"></select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Urbanizacion_Sector_ZonaIndustrial">Urbanización/Sector:</label>
                    <br>
                    <input id="Urbanizacion_Sector_ZonaIndustrial" type="text" required>
                </td>
                <td>
                    <label for="Avenida_Carrera_Esquina">Avenida/Carrera/Calle:</label>
                    <br>
                    <input id="Avenida_Carrera_Esquina" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="Edificio_Quinta_Galpon">Edificio/Quinta/Galpón:</label>
                    <br>
                    <input id="Edificio_Quinta_Galpon" type="text" required>
                </td>
                <td>
                    <label for="CodigoPostal">Código Postal:</label>
                    <br>
                    <input id="CodigoPostal" class="numeros" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="LugarTrabajo">Lugar de trabajo:</label>
                    <br>
                    <input id="LugarTrabajo" type="text" required>
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
                    <input id="TlfMovil" class="tlf" type="text" required>
                </td>
                <td>
                    <label for="TlfCasa">Teléfono de Casa:</label>
                    <br>
                    <input id="TlfCasa" class="tlf" type="text" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="CorreoElectronico">Correo Electrónico:</label>
                    <br>
                    <input id="CorreoElectronico" type="text" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="boton" href="javascript:void(0);">Registrar Usuario</a>
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