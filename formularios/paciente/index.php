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
                    <label for="nro_historia_clinica">Número de Historia Clínica: *</label>
                    <br>
                    <input type="text" id="nro_historia_clinica" name="nro_historia_clinica" autofocus required>
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
                    <label for="peso">Peso:</label>
                    <br>
                    <input type="text" id="peso" name="peso">
                </td>
                <td>
                    <label for="estatura">Estatura:</label>
                    <br>
                    <input type="text" id="estatura" name="estatura">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="superficie_corporal">Superficie Corporal:</label>
                    <br>
                    <input type="text" id="superficie_corporal" name="superficie_corporal">
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
                    <input type="text" class="numeros" id="codigo_postal" name="codigo_postal">
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
                    <b><input class="tlf" name="tlf_casa[]" type="text" placeholder="02XX" pattern="^[0-9]{4}$" required> - <input class="tlf tlf_casa" name="tlf_casa[]" type="text" placeholder="1234567" pattern="^[0-9]{7}$" required></b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="correo_electronico">Correo Electrónico:</label>
                    <br>
                    <input type="text" id="correo_electronico" name="correo_electronico" placeholder="nombrecorreo@dominio">
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
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fuma">¿Es fumador?</label>
                    <br>
                    <input type="radio" name="fuma" value="TRUE" required>
                    <label>Si</label>
                    <input type="radio" name="fuma" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="fuma_desde">¿Desde qué edad comenzó a fumar?</label>
                    <br>
                    <select id="fuma_desde" name="fuma_desde" required>
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                    </select>
                </td>
                <td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cigarrillos_diarios">Cantidad promedio de cigarrillos que fuma al día:</label>
                    <br>
                    <select id="cigarrillos_diarios" name="cigarrillos_diarios" required>
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                    </select>
                </td>
                <td>
                    <label for="alcohol">¿Consume alcohol?</label>
                    <br>
                    <input type="radio" name="alcohol" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="alcohol" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="alcohol_semanal">Cantidad promedio de veces que consume alcohol a la semana:</label>
                    <br>
                    <select id="alcohol_semanal" name="alcohol_semanal" required>
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                    </select>
                </td>
                <td>
                    <label for="drogas_ilicitas">¿Consume drogas ilícitas?</label>
                    <br>
                    <input type="radio" name="drogas_ilicitas" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="drogas_ilicitas" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="actividad_fisica">¿Realiza actividad física?</label>
                    <br>
                    <input type="radio" name="actividad_fisica" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="actividad_fisica" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="sedentarismo">¿Lleva una vida sedentaria?</label>
                    <br>
                    <input type="radio" name="sedentarismo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="sedentarismo" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="manejo_estres">¿Presenta problemas para manejar el estrés?</label>
                    <br>
                    <input type="radio" name="manejo_estres" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="manejo_estres" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="otros_estilos_vida">Indique, si los hay, otros antecedentes de estilo y modo de vida:</label>
                    <br>
                    <textarea id="otros_estilos_vida" name="otros_estilos_vida" required></textarea>
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
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tumor_benigno">¿Padeció o padece de alǵun tumor benigno?</label>
                    <br>
                    <input type="radio" name="tumor_benigno" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="tumor_benigno" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="tumor_maligno">¿Padeció o padece de algún tumor maligno?</label>
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
                    <label for="erupcion">¿Padeció o padece de alguna enfermedad eruptiva?</label>
                    <br>
                    <input type="radio" name="erupcion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="erupcion" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="ets">¿Padeció o padece de alguna enfermedad de transmisión sexual?</label>
                    <br>
                    <input type="radio" name="ets" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="ets" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="meningitis">¿Padeció o padece de meningitis?</label>
                    <br>
                    <input type="radio" name="meningitis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="meningitis" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="chagas">¿Padeció o padece de chagas?</label>
                    <br>
                    <input type="radio" name="chagas" value="TRUE" required>
                    <label>Si</label>
                    <input type="radio" name="chagas" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tuberculosis">¿Padeció o padece de tuberculosis?</label>
                    <br>
                    <input type="radio" name="tuberculosis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="tuberculosis" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="dengue">¿Padeció o padece de dengue?</label>
                    <br>
                    <input type="radio" name="dengue" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="dengue" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="hansen">¿Padeció o padece de la enfermedad de Hansen (Lepra)?</label>
                    <br>
                    <input type="radio" name="hansen" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="hansen" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="leishmaniasis">¿Padeció o padece de leishmaniasis?</label>
                    <br>
                    <input type="radio" name="leishmaniasis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="leishmaniasis" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="leptospirosis">¿Padeció o padece de leptospirosis?</label>
                    <br>
                    <input type="radio" name="leptospirosis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="leptospirosis" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="malaria">¿Padeció o padece de malaria?</label>
                    <br>
                    <input type="radio" name="malaria" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="malaria" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="desnutricion">¿Padeció o padece de desnutrición?</label>
                    <br>
                    <input type="radio" name="desnutricion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="desnutricion" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="diabetes">¿Padece de diabetes?</label>
                    <br>
                    <input type="radio" name="diabetes" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="diabetes" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="dislipidemias">¿Padeció o padece de dislipidemias?</label>
                    <br>
                    <input type="radio" name="dislipidemias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="dislipidemias" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="obesidad">¿Padeció o padece de obesidad?</label>
                    <br>
                    <input type="radio" name="obesidad" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="obesidad" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastorno_apetito">¿Padeció o padece de trastornos de apetito?</label>
                    <br>
                    <input type="radio" name="trastorno_apetito" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastorno_apetito" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="enuresis">¿Padeció o padece de enuresis?</label>
                    <br>
                    <input type="radio" name="enuresis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="enuresis" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="chupa_dedo">¿Se chupa el dedo?</label>
                    <br>
                    <input type="radio" name="chupa_dedo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="chupa_dedo" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="onicofagia">¿Padeció o padece de onicofagia (se come las uñas)?</label>
                    <br>
                    <input type="radio" name="onicofagia" value="TRUE" required>
                    <label>Si</label>
                    <input type="radio" name="onicofagia" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastorno_llanto">¿Padeció o padece de trastornos de llanto?</label>
                    <br>
                    <input type="radio" name="trastorno_llanto" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastorno_llanto" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="hipertension_arterial">¿Padece de hipertensión arterial sistémica?</label>
                    <br>
                    <input type="radio" name="hipertension_arterial" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="hipertension_arterial" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tromboembolismo">¿Padece de tromboembolismo?</label>
                    <br>
                    <input type="radio" name="tromboembolismo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="tromboembolismo" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="varices">¿Padece de varices?</label>
                    <br>
                    <input type="radio" name="varices" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="varices" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cardiopatia">¿Padece de cardiopatia?</label>
                    <br>
                    <input type="radio" name="cardiopatia" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="cardiopatia" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="asma">¿Padece de asma?</label>
                    <br>
                    <input type="radio" name="asma" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="asma" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="neumonia">¿Padece de neumonía?</label>
                    <br>
                    <input type="radio" name="neumonia" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="neumonia" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="gastroenteropatias">¿Padeció o padece de gastroenteropatias?</label>
                    <br>
                    <input type="radio" name="gastroenteropatias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="gastroenteropatias" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="hepatopatias">¿Padeció o padece de hepatopatias?</label>
                    <br>
                    <input type="radio" name="hepatopatias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="hepatopatias" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="trastornos_evacuacion">¿Padeció o padece de trastornos de evacuación?</label>
                    <br>
                    <input type="radio" name="trastornos_evacuacion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_evacuacion" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="colagenopatias">¿Padeció o padece de colagenopatías?</label>
                    <br>
                    <input type="radio" name="colagenopatias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="colagenopatias" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="artritis">¿Padeció o padece de artritis?</label>
                    <br>
                    <input type="radio" name="artritis" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="artritis" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastornos_miccionales">¿Padeció o padece de trastornos miccionales?</label>
                    <br>
                    <input type="radio" name="trastornos_miccionales" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_miccionales" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="enfermedad_renal">¿Padeció o padece de enfermedad renal?</label>
                    <br>
                    <input type="radio" name="enfermedad_renal" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="enfermedad_renal" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="alergias">¿Padece de alergias?</label>
                    <br>
                    <input type="radio" name="alergias" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="alergias" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="trastornos_suenio">¿Padeció o padece de trastornos del sueño?</label>
                    <br>
                    <input type="radio" name="trastornos_suenio" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_suenio" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="violencia_psicologica">¿Padeció o padece de violencia psicológica?</label>
                    <br>
                    <input type="radio" name="violencia_psicologica" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="violencia_psicologica" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="violencia_fisica">¿Padeció o padece de violencia física?</label>
                    <br>
                    <input type="radio" name="violencia_fisica" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="violencia_fisica" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="violencia_sexual">¿Padeció o padece de violencia sexual?</label>
                    <br>
                    <input type="radio" name="violencia_sexual" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="violencia_sexual" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="accidentes">¿Ha sufrido accidentes?</label>
                    <br>
                    <input type="radio" name="accidentes" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="accidentes" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="otras_patologias">Indique, si las hay, otras patologías que padezca o haya padecido:</label>
                    <br>
                    <textarea id="otras_patologias" name="otras_patologias" required></textarea>
                </td>
                <td>
                    <label for="grupo_sanguineo">Indique el grupo sanguíneo:</label>
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
            </tr>
            <tr>
                <td>
                    <label for="hospitalizacion">¿Ha sido hospitalizado?</label>
                    <br>
                    <input type="radio" name="hospitalizacion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="hospitalizacion" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="intervencion_quirurgica">¿Ha sido intervenido quirúrjicamente?</label>
                    <br>
                    <input type="radio" name="intervencion_quirurgica" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="intervencion_quirurgica" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="observaciones">Indique, si es necesario, detalles sobre las patologías que padece o ha padecido el paciente</label>
                    <br>
                    <textarea id="observaciones" name="observaciones" required></textarea>
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