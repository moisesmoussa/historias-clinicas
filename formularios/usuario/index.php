<section class="contenedor-formulario">
    <h2 align="center"><?php echo ($app['action'] === 'registrar')? 'Registro de Usuario': 'Perfil de Usuario'; ?></h2>
    <br>
    <label>* Datos Obligatorios</label>
    <form id="<?php echo ($app['action'] === 'registrar')? 'nuevo-usuario': 'actualizar-usuario'; ?>" action="" autocomplete="on">
        <table class="formulario">
            <?php if($app['action'] === 'perfil' || isset($_SESSION['super_administrador']))
                        echo
            '<tr>
                <td colspan="2">
                    <h3>Datos de la cuenta</h3>
                </td>
            </tr>';
            ?>
            
            <tr>
                <?php if($app['action'] === 'perfil')
                        echo
                '<td>
                    <label for="nombre_usuario">Usuario: *<i class="fa fa-question-circle fa-fw ayuda" title="<b>Puede estar formado por:</b><br>Mínimo 4 caracteres<br>Máximo 16 caracteres<br>Letras mayúsculas y minúsculas<br>Números<br>Caracteres: _ -"></i></label>
                    <br>
                    <input id="nombre_usuario" name="nombre_usuario" type="text" pattern="^[a-zA-Z0-9_-]{4,16}$" autofocus required>
                </td>';
                      else if(isset($_SESSION['super_administrador']))
                          echo
                '<td>
                    <label for="tipo_usuario">Tipo de Usuario: *</label>
                    <br>
                    <select id="tipo_usuario" name="tipo_usuario" required>
                        <option value=""></option>
                        <option value="Administrador">Administrador</option>
                        <option value="General">General</option>
                    </select>
                </td>';
                      if($app['action'] === 'modificar')
                          echo
                '
                <td class="oculto">
                    <input id="id_usuario" name="id_usuario" type="text">
                </td>';
                ?>

            </tr>
            <tr>
                <td colspan="2">
                    <h3>Datos Personales</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nombres">Nombres: *</label>
                    <br>
                    <input id="nombres" name="nombres" type="text" required>
                </td>
                <td>
                    <label for="apellidos">Apellidos: *</label>
                    <br>
                    <input id="apellidos" name="apellidos" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fecha_nacimiento">Fecha Nacimiento: *</label>
                    <br>
                    <input class="calendario" id="fecha_nacimiento" name="fecha_nacimiento" type="text" readonly="readonly" required>
                </td>
                <td>
                    <label for="lugar_nacimiento">Lugar Nacimiento: *</label>
                    <br>
                    <input id="lugar_nacimiento" name="lugar_nacimiento" type="text" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cedula">Cédula: *<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 numero entero<br>- Máximo 9 números enteros"></i></label>
                    <br>
                    <input id="cedula" name="cedula" type="text" pattern="^[0-9]{1,9}$" required>
                </td>
                <td>
                    <label for="especialidad">Especialidad:</label>
                    <br>
                    <input id="especialidad" name="especialidad" type="text">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Dirección</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="estado_residencia">Estado: *</label>
                    <br>
                    <select id="estado_residencia" name="estado_residencia" required>
                        <option value=""></option>
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
                    <label for="ciudad_residencia">Ciudad: *</label>
                    <br>
                    <select id="ciudad_residencia" name="ciudad_residencia" required></select>
                    <input type="text" class="otra_ciudad oculto"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="direccion">Dirección: *</label>
                    <br>
                    <input id="direccion" name="direccion" type="text" required>
                </td>
                <td>
                    <label for="codigo_postal">Código Postal:</label>
                    <br>
                    <input id="codigo_postal" name="codigo_postal" type="text">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="lugar_trabajo">Lugar de Trabajo: *</label>
                    <br>
                    <input id="lugar_trabajo" name="lugar_trabajo" type="text" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Datos de Contacto</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tlf_movil">Teléfono Móvil: *</label>
                    <br>
                    <b><input class="tlf" name="tlf_movil[]" type="text" placeholder="04XX" pattern="^[0-9]{4}$" required> - <input class="tlf" name="tlf_movil[]" type="text" placeholder="123" pattern="^[0-9]{3}$" required> - <input class="tlf" name="tlf_movil[]" type="text" placeholder="4567" pattern="^[0-9]{4}$" required></b>
                </td>
                <td>
                    <label for="tlf_casa">Teléfono de Habitación: *</label>
                    <br>
                    <b><input class="tlf" name="tlf_casa[]" type="text" placeholder="02XX" pattern="^[0-9]{4}$" required> - <input class="tlf_casa" name="tlf_casa[]" type="text" placeholder="1234567" pattern="^[0-9]{7}$" required></b>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="correo_electronico">Correo Electrónico: *<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Letras mayúsculas, minúsculas, números enteros<br>&emsp;y los caracteres: ._%+- están permitidos<br>&emsp;antes del @<br>- Un solo símbolo @<br>- Letras mayúsculas, minúsculas y<br>&emsp;números enteros después del @<br>- Un punto en el dominio<br>- Mínimo 2 letras al final después<br>&emsp;del punto (Ej: .com)<br>- Máximo 4 letras al final después<br>&emsp;del punto (Ej: .com)<br>- Ejemplo válido: nombre@hotmail.com"></i></label>
                    <br>
                    <input id="correo_electronico" name="correo_electronico" type="text" placeholder="nombrecorreo@dominio" pattern="^[A-Za-z0-9._%+-]+@([A-Za-z0-9]+\.)+.[A-Za-z]{2,4}$" required>
                </td>
                <td>
                    <label for="correo_alternativo">Correo Electrónico Alternativo:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Letras mayúsculas, minúsculas, números enteros<br>&emsp;y los caracteres: ._%+- están permitidos<br>&emsp;antes del @<br>- Un solo símbolo @<br>- Letras mayúsculas, minúsculas y<br>&emsp;números enteros después del @<br>- Un punto en el dominio<br>- Mínimo 2 letras al final después<br>&emsp;del punto (Ej: .com)<br>- Máximo 4 letras al final después<br>&emsp;del punto (Ej: .com)<br>- Ejemplo válido: nombre@hotmail.com"></i></label>
                    <br>
                    <input id="correo_alternativo" name="correo_alternativo" type="text" placeholder="nombrecorreo@dominio" pattern="^[A-Za-z0-9._%+-]+@([A-Za-z0-9]+\.)+.[A-Za-z]{2,4}$">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="boton" value="<?php echo ($app['action'] === 'registrar')? 'Registrar': 'Guardar Cambios'; ?>"/>
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