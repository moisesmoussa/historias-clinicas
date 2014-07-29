<section class="contenedor-formulario">
    <h2 align="center">Perfil de Usuario</h2>
    <form id="actualizar-usuario" action="">
        <table class="formulario">
            <tr>
                <td>
                    <h3>
                        <b>Datos de la cuenta</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nombre_usuario">Nombre de Usuario:</label>
                    <br>
                    <input id="nombre_usuario" name="nombre_usuario" type="text" required>
                </td>
                <td>
                    <label for="fecha_ingreso">Fecha de Ingreso:</label>
                    <br>
                    <input class="calendario" id="fecha_ingreso" name="fecha_ingreso" type="text" readonly="readonly" required>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Datos Personales</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="primer_nombre">Primer Nombre:</label>
                    <br>
                    <input id="primer_nombre" name="primer_nombre" type="text" required>
                </td>
                <td>
                    <label for="segundo_nombre">Segundo Nombre:</label>
                    <br>
                    <input id="segundo_nombre" name="segundo_nombre" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="primer_apellido">Primer Apellido:</label>
                    <br>
                    <input id="primer_apellido" name="primer_apellido" type="text" required>
                </td>
                <td>
                    <label for="segundo_apellido">Segundo Apellido:</label>
                    <br>
                    <input id="segundo_apellido" name="segundo_apellido" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                    <br>
                    <input class="calendario" id="fecha_nacimiento" name="fecha_nacimiento" type="text" readonly="readonly" required>
                </td>
                <td>
                    <label for="lugar_nacimiento">Lugar Nacimiento:</label>
                    <br>
                    <input id="lugar_nacimiento" name="lugar_nacimiento" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cedula">Cédula:</label>
                    <br>
                    <input id="cedula" name="cedula" class="numeros" type="text" required>
                </td>
                <td>
                    <label for="especialidad">Especialidad:</label>
                    <br>
                    <input id="especialidad" name="especialidad" type="text" required>
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
                    <label for="estado_residencia">Estado:</label>
                    <br>
                    <select id="estado_residencia" name="estado_residencia">
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
                    <label for="ciudad_residencia">Ciudad:</label>
                    <br>
                    <select id="ciudad_residencia" name="ciudad_residencia"></select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="direccion">Dirección:</label>
                    <br>
                    <input id="direccion" name="direccion" type="text" required>
                </td>
                <td>
                    <label for="codigo_postal">Código Postal:</label>
                    <br>
                    <input id="codigo_postal" name="codigo_postal" class="numeros" type="text" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="lugar_trabajo">Lugar de Trabajo:</label>
                    <br>
                    <input id="lugar_trabajo" name="lugar_trabajo" type="text" required>
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
                    <label for="tlf_movil">Teléfono Móvil:</label>
                    <br>
                    <input id="tlf_movil" name="tlf_movil" class="tlf" type="text" required>
                </td>
                <td>
                    <label for="tlf_casa">Teléfono de Casa:</label>
                    <br>
                    <input id="tlf_casa" name="tlf_casa" class="tlf" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="correo_electronico">Correo Electrónico:</label>
                    <br>
                    <input id="correo_electronico" name="correo_electronico" type="text" required>
                </td>
                <td>
                    <label for="correo_alternativo">Correo Electrónico Alternativo:</label>
                    <br>
                    <input id="correo_alternativo" name="correo_alternativo" type="text" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="boton" href="javascript:void(0);">Guardar Cambios</a>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="status"></div>
                </td>
            </tr>
        </table>
    </form>
</section>