<section class="contenedor-formulario">
    <h2 align="center"><?php echo ($app['action'] === 'registrar')? 'Registro de Paciente': 'Perfil de Paciente'; ?></h2>
    <?php if($app['action'] === 'modificar')
            echo 
    '<p>
        <span class="enlace-diagnostico" title="Agrega o Actualiza el Diagnóstico del Paciente">
            <i class="fa fa-medkit fa-fw"></i> Diagnóstico
        </span>
    </p>';
    ?>
    
    <label>* Datos Obligatorios</label>
    <form id="datos-paciente" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Datos Personales</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="nro_historia_clinica">Número de Historia Clínica: *<i class="fa fa-question-circle fa-fw ayuda" title="Solo números enteros"></i></label>
                    <br>
                    <input type="text" id="nro_historia_clinica" name="nro_historia_clinica" pattern="^[0-9]+$" autofocus required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nacionalidad">Nacionalidad: *</label>
                    <br>
                    <select id="nacionalidad" name="nacionalidad" required>
                        <option value=""></option>
                        <option value="V" selected>Venezolana</option>
                        <option value="E">Extranjera</option>
                    </select>
                </td>
                <td>
                    <label for="documento_identidad">Documento de Identidad: *</label>
                    <br>
                    <input type="text" id="documento_identidad" name="documento_identidad" placeholder="Cédula o pasaporte" required>
                </td>
                <?php if($app['action'] === 'modificar')
                          echo
                '<td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>';
                ?>
                
            </tr>
            <tr>
                <td>
                    <label for="nombres">Nombres: *</label>
                    <br>
                    <input type="text" id="nombres" name="nombres" required>
                </td>
                <td>
                    <label for="apellidos">Apellidos: *</label>
                    <br>
                    <input type="text" id="apellidos" name="apellidos" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fecha_nacimiento">Fecha Nacimiento: *</label>
                    <br>
                    <input class="calendario" id="fecha_nacimiento" name="fecha_nacimiento" type="text" readonly="readonly" required>
                </td>
                <td>
                    <label for="pais_nacimiento">País de Nacimiento: *</label>
                    <br>
                    <?php @include_once('paises.html')?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lugar_nacimiento">Lugar de Nacimiento: *</label>
                    <br>
                    <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" required>
                </td>
                <td>
                    <label for="sexo">Sexo: *</label>
                    <br>
                    <input type="radio" name="sexo" value="Masculino" required>
                    <label>Masculino</label>
                    <input type="radio" name="sexo" value="Femenino" required>
                    <label>Femenino</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="situacion_conyugal">Situación Conyugal: *</label>
                    <br>
                    <select id="situacion_conyugal" name="situacion_conyugal" required>
                        <option value=""></option>
                        <option value="Soltero">Soltero/a</option>
                        <option value="Casado">Casado/a</option>
                        <option value="Viudo">Viudo/a</option>
                        <option value="Divorciado">Divorciado/a</option>
                    </select>
                </td>
                <td>
                    <label for="analfabeta">¿Es analfabeta?</label>
                    <br>
                    <input type="radio" name="analfabeta" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="analfabeta" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="etnia">Etnia:</label>
                    <br>
                    <input type="text" id="etnia" name="etnia">
                </td>
                <td>
                    <label for="educacion">Educación: *</label>
                    <br>
                    <select id="educacion" name="educacion" required>
                        <option value=""></option>
                        <option value="Ninguna">Ninguna</option>
                        <option value="Primaria">Primaria</option>
                        <option value="Secundaria">Secundaria</option>
                        <option value="Diversificada">Diversificada</option>
                        <option value="Media">Media</option>
                        <option value="Pregrado">Universitaria (Pregrado)</option>
                        <option value="Postgrado">Universitaria (Postgrado)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="profesion">Profesión: *</label>
                    <br>
                    <input type="text" id="profesion" name="profesion" required>
                </td>
                <td>
                    <label for="ocupacion">Ocupación: *</label>
                    <br>
                    <input type="text" id="ocupacion" name="ocupacion" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="empresa">Empresa:</label>
                    <br>
                    <input type="text" id="empresa" name="empresa">
                </td>
                <td>
                    <label for="seguridad_social">¿Es cotizante del Seguro Social? *</label>
                    <br>
                    <input type="radio" name="seguridad_social" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="seguridad_social" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="peso">Peso:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Números enteros o decimales<br>- Para valores decimales usar . (punto)<br>- Mínimo 1 número entero<br>- Máximo 3 números enteros<br>- Mínimo 1 número después del punto<br>- Máximo 2 números depués del punto"></i></label>
                    <br>
                    <input type="text" class="float" id="peso" name="peso" pattern="(^[0-9]{1,3}\.[0-9]{1,2}$|^[0-9]{1,3}$)" placeholder="65.2">
                    <span>kg</span>
                </td>
                <td>
                    <label for="estatura">Estatura:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Números enteros o decimales<br>- Para valores decimales usar . (punto)<br>- Mínimo 1 número entero<br>- Máximo 3 números enteros<br>- Sólo 1 número después del punto"></i></label>
                    <br>
                    <input type="text" class="float" id="estatura" name="estatura" pattern="(^[0-9]{1,3}\.[0-9]{1}$|^[0-9]{1,3}$)" placeholder="170">
                    <span>cm</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="superficie_corporal">Superficie Corporal:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Números enteros o decimales<br>- Para valores decimales usar . (punto)<br>- Mínimo 1 número entero<br>- Máximo 2 números enteros<br>- Mínimo 1 número después del punto<br>- Máximo 3 números depués del punto"></i></label>
                    <br>
                    <input type="text" class="float" id="superficie_corporal" name="superficie_corporal" pattern="(^[0-9]{1,2}\.[0-9]{1,3}$|^[0-9]{1,2}$)" placeholder="1.80">
                    <span>m<sup>2</sup></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Dirección y Contacto</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="estado_residencia">Estado de Residencia: *</label>
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
                    <label for="ciudad_residencia">Ciudad de Residencia: *</label>
                    <br>
                    <select id="ciudad_residencia" name="ciudad_residencia" required></select>
                    <input type="text" class="otra_ciudad oculto"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="direccion">Dirección: *</label>
                    <br>
                    <input type="text" id="direccion" name="direccion" required>
                </td>
                <td>
                    <label for="codigo_postal">Código Postal:</label>
                    <br>
                    <input type="text" id="codigo_postal" name="codigo_postal">
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
                <td colspan="2">
                    <label for="correo_electronico">Correo Electrónico:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Letras mayúsculas, minúsculas, números enteros<br>&emsp;y los caracteres: ._%+- están permitidos<br>&emsp;antes del @<br>- Un solo símbolo @<br>- Letras mayúsculas, minúsculas y<br>&emsp;números enteros después del @<br>- Un punto en el dominio<br>- Mínimo 2 letras al final después<br>&emsp;del punto (Ej: .com)<br>- Máximo 4 letras al final después<br>&emsp;del punto (Ej: .com)<br>- Ejemplo válido: nombre@hotmail.com"></i></label>
                    <br>
                    <input type="text" id="correo_electronico" name="correo_electronico" placeholder="nombrecorreo@dominio" pattern="^[A-Za-z0-9._%+-]+@([A-Za-z0-9]+\.)+.[A-Za-z]{2,4}$">
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
<?php @include_once('antecedentes-perinatales.php')?>
<?php @include_once('antecedentes-sexuales.php')?>
<section class="contenedor-formulario antecedentes-modo-vida">
    <form id="form-antecedentes-modo-vida" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Antecedentes Personales de Estilo y Modo de Vida</h3>
                    <label>* Datos Obligatorios</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fuma"><strong>1 - </strong>¿Es fumador? *</label>
                    <br>
                    <input type="radio" name="fuma" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="fuma" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="fuma_desde"><strong>2 - </strong>¿Desde qué edad comenzó a fumar?<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="fuma_desde" name="fuma_desde" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
                <td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cigarrillos_diarios"><strong>3 - </strong>Cantidad promedio de cigarrillos que fuma al día: *<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num" id="cigarrillos_diarios" name="cigarrillos_diarios" pattern="^[0-9]{1,2}$" required>
                </td>
                <td>
                    <label for="alcohol"><strong>4 - </strong>¿Consume alcohol? *</label>
                    <br>
                    <input type="radio" name="alcohol" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="alcohol" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="alcohol_semanal"><strong>5 - </strong>Cantidad promedio de veces que consume alcohol a la semana: *<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num" id="alcohol_semanal" name="alcohol_semanal" pattern="^[0-9]{1,2}$" required>
                </td>
                <td>
                    <label for="drogas_ilicitas"><strong>6 - </strong>¿Consume drogas ilícitas? *</label>
                    <br>
                    <input type="radio" name="drogas_ilicitas" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="drogas_ilicitas" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="sedentarismo"><strong>7 - </strong>¿Lleva una vida sedentaria? *</label>
                    <br>
                    <input type="radio" name="sedentarismo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="sedentarismo" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="actividad_fisica"><strong>8 - </strong>¿Realiza actividad física? *</label>
                    <br>
                    <input type="radio" name="actividad_fisica" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="actividad_fisica" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="manejo_estres"><strong>9 - </strong>¿Presenta problemas para manejar el estrés? *</label>
                    <br>
                    <input type="radio" name="manejo_estres" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="manejo_estres" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="otros_estilos_vida"><strong>10 - </strong>Indique, si los hay, otros antecedentes de estilo y modo de vida:</label>
                    <br>
                    <textarea id="otros_estilos_vida" name="otros_estilos_vida"></textarea>
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
<section class="contenedor-formulario antecedentes-patologicos">
    <form id="form-antecedentes-patologicos" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Antecedentes Personales de Patologías</h3>
                    <label>* Todos los datos de este formulario son obligatorios</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tumor_benigno"><strong>1 - </strong>Tumor benigno</label>
                    <br>
                    <input type="radio" name="tumor_benigno" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="tumor_benigno" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="tumor_maligno"><strong>2 - </strong>Tumor maligno</label>
                    <br>
                    <input type="radio" name="tumor_maligno" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="tumor_maligno" value="FALSE" required>
                    <label>No</label>
                </td>
                <td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="erupcion"><strong>3 - </strong>Enfermedades eruptivas</label>
                    <br>
                    <input type="radio" name="erupcion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="erupcion" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="ets"><strong>4 - </strong>Enfermedad de transmisión sexual</label>
                    <br>
                    <input type="radio" name="ets" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="ets" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="meningitis"><strong>5 - </strong>Meningitis</label>
                    <br>
                    <input type="radio" name="meningitis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="meningitis" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="chagas"><strong>6 - </strong>Mal de chagas</label>
                    <br>
                    <input type="radio" name="chagas" value="TRUE" required>
                    <label>Si</label>
                    <input type="radio" name="chagas" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tuberculosis"><strong>7 - </strong>Tuberculosis</label>
                    <br>
                    <input type="radio" name="tuberculosis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="tuberculosis" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="dengue"><strong>8 - </strong>Dengue</label>
                    <br>
                    <input type="radio" name="dengue" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="dengue" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="chikungunya"><strong>9 - </strong>Fiebre chikungunya</label>
                    <br>
                    <input type="radio" name="chikungunya" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="chikungunya" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="leishmaniasis"><strong>10 - </strong>Leishmaniasis</label>
                    <br>
                    <input type="radio" name="leishmaniasis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="leishmaniasis" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="leptospirosis"><strong>11 - </strong>Leptospirosis</label>
                    <br>
                    <input type="radio" name="leptospirosis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="leptospirosis" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="malaria"><strong>12 - </strong>Malaria</label>
                    <br>
                    <input type="radio" name="malaria" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="malaria" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="desnutricion"><strong>13 - </strong>Desnutrición</label>
                    <br>
                    <input type="radio" name="desnutricion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="desnutricion" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="diabetes"><strong>14 - </strong>Diabetes</label>
                    <br>
                    <input type="radio" name="diabetes" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="diabetes" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="dislipidemias"><strong>15 - </strong>Dislipidemias</label>
                    <br>
                    <input type="radio" name="dislipidemias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="dislipidemias" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="obesidad"><strong>16 - </strong>Obesidad</label>
                    <br>
                    <input type="radio" name="obesidad" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="obesidad" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastorno_apetito"><strong>17 - </strong>Trastornos alimentarios</label>
                    <br>
                    <input type="radio" name="trastorno_apetito" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastorno_apetito" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="enuresis"><strong>18 - </strong>Enuresis</label>
                    <br>
                    <input type="radio" name="enuresis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="enuresis" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="chupa_dedo"><strong>19 - </strong>Chupa dedo</label>
                    <br>
                    <input type="radio" name="chupa_dedo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="chupa_dedo" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="onicofagia"><strong>20 - </strong>Onicofagia</label>
                    <br>
                    <input type="radio" name="onicofagia" value="TRUE" required>
                    <label>Si</label>
                    <input type="radio" name="onicofagia" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastorno_llanto"><strong>21 - </strong>Trastornos de llanto</label>
                    <br>
                    <input type="radio" name="trastorno_llanto" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastorno_llanto" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="hipertension_arterial"><strong>22 - </strong>Hipertensión arterial sistémica</label>
                    <br>
                    <input type="radio" name="hipertension_arterial" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="hipertension_arterial" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tromboembolismo"><strong>23 - </strong>Tromboembolismo</label>
                    <br>
                    <input type="radio" name="tromboembolismo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="tromboembolismo" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="varices"><strong>24 - </strong>Varices</label>
                    <br>
                    <input type="radio" name="varices" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="varices" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cardiopatia"><strong>25 - </strong>Cardiopatías</label>
                    <br>
                    <input type="radio" name="cardiopatia" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="cardiopatia" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="asma"><strong>26 - </strong>Asma bronquial</label>
                    <br>
                    <input type="radio" name="asma" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="asma" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="neumonia"><strong>27 - </strong>Neumonía</label>
                    <br>
                    <input type="radio" name="neumonia" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="neumonia" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="gastroenteropatias"><strong>28 - </strong>Gastroenteropatías</label>
                    <br>
                    <input type="radio" name="gastroenteropatias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="gastroenteropatias" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="hepatopatias"><strong>29 - </strong>Hepatopatías</label>
                    <br>
                    <input type="radio" name="hepatopatias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="hepatopatias" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="colagenopatias"><strong>30 - </strong>Colagenopatías</label>
                    <br>
                    <input type="radio" name="colagenopatias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="colagenopatias" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="artritis"><strong>31 - </strong>Artritis reumatoidea</label>
                    <br>
                    <input type="radio" name="artritis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="artritis" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="trastornos_miccionales"><strong>32 - </strong>Trastornos miccionales</label>
                    <br>
                    <input type="radio" name="trastornos_miccionales" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_miccionales" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="enfermedad_renal"><strong>33 - </strong>Enfermedad renal</label>
                    <br>
                    <input type="radio" name="enfermedad_renal" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="enfermedad_renal" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="alergias"><strong>34 - </strong>Alergias</label>
                    <br>
                    <input type="radio" name="alergias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="alergias" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastornos_suenio"><strong>35 - </strong>Trastornos del sueño</label>
                    <br>
                    <input type="radio" name="trastornos_suenio" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_suenio" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="accidentes"><strong>36 - </strong>Traumatismos</label>
                    <br>
                    <input type="radio" name="accidentes" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="accidentes" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="grupo_sanguineo"><strong>37 - </strong>Indique el grupo sanguíneo:</label>
                    <br>
                    <select id="grupo_sanguineo" name="grupo_sanguineo" required>
                        <option value=""></option>
                        <option value="O-">O-</option>
                        <option value="O+">O+</option>
                        <option value="A-">A-</option>
                        <option value="A+">A+</option>
                        <option value="B-">B-</option>
                        <option value="B+">B+</option>
                        <option value="AB-">AB-</option>
                        <option value="AB+">AB+</option>
                    </select>
                </td>
                <td>
                    <label for="hospitalizacion"><strong>38 - </strong>Hospitalizaciones</label>
                    <br>
                    <input type="radio" name="hospitalizacion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="hospitalizacion" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="intervencion_quirurgica"><strong>39 - </strong>Intervenciones quirúrgicas</label>
                    <br>
                    <input type="radio" name="intervencion_quirurgica" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="intervencion_quirurgica" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="otras_patologias"><strong>40 - </strong>Indique, si las hay, otras patologías que padezca o haya padecido:</label>
                    <br>
                    <textarea id="otras_patologias" name="otras_patologias"></textarea>
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
<?php @include_once('desarrollo-psicomotor.php')?>