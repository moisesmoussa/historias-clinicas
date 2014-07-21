<h2 align="center">Registro de Paciente</h2>
<section class="contenedor-formulario">
    <form id="datos-paciente" action="">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>
                        <b>Datos Personales</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nacionalidad">Nacionalidad:</label>
                    <br>
                    <select id="nacionalidad" name="nacionalidad">
                        <option value="V" selected>Venezolana</option>
                        <option value="E">Extranjera</option>
                    </select>
                </td>
                <td>
                    <label for="documento_identidad">Documento de Identidad:</label>
                    <br>
                    <input type="text" id="documento_identidad" name="documento_identidad">
                    <br>
                    <span class="descripcion">Cédula o pasaporte</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="primer_apellido">Primer Apellido:</label>
                    <br>
                    <input type="text" id="primer_apellido" name="primer_apellido">
                </td>
                <td>
                    <label for="segundo_apellido">Segundo Apellido:</label>
                    <br>
                    <input type="text" id="segundo_apellido" name="segundo_apellido">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="primer_nombre">Primer Nombre:</label>
                    <br>
                    <input type="text" id="primer_nombre" name="primer_nombre">
                </td>
                <td>
                    <label for="segundo_nombre">Segundo Nombre:</label>
                    <br>
                    <input type="text" id="segundo_nombre" name="segundo_nombre">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="etnia">Etnia:</label>
                    <br>
                    <input type="text" id="etnia" name="etnia">
                </td>
                <td>
                    <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                    <br>
                    <input class="calendario" id="fecha_nacimiento" name="fecha_nacimiento" type="text" readonly="readonly" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="sexo">Sexo:</label>
                    <br>
                    <input type="radio" name="sexo" value="Masculino">Masculino
                    <input type="radio" name="sexo" value="Femenino">Femenino
                </td>
                <td>
                    <label for="pais_nacimiento">País de Nacimiento:</label>
                    <br>
                    <select id="pais_nacimiento" name="pais_nacimiento">
                        <?php @include_once( 'formulario-pacientes/paises.html')?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="situacion_conyugal">Situación Conyugal:</label>
                    <br>
                    <select id="situacion_conyugal" name="situacion_conyugal">
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
                    <label for="educacion">Educación:</label>
                    <br>
                    <select id="educacion" name="educacion">
                        <option value=""></option>
                        <option value="Primaria">Primaria</option>
                        <option value="Secundaria">Secundaria</option>
                        <option value="Diversificada">Diversificada</option>
                        <option value="Media">Media</option>
                        <option value="Pregrado">Universitaria (Pregrado)</option>
                        <option value="Postgrado">Universitaria (Postgrado)</option>
                    </select>
                </td>
                <td>
                    <label for="profesion">Profesión:</label>
                    <br>
                    <input type="text" id="profesion" name="profesion">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ocupacion">Ocupación:</label>
                    <br>
                    <input type="text" id="ocupacion" name="ocupacion">
                </td>
                <td>
                    <label for="seguridad_social">¿Es cotizante del Seguro Social?</label>
                    <br>
                    <input type="radio" name="seguridad_social" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="seguridad_social" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>
                        <b>Dirección y Contacto</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="estado_residencia">Estado de Residencia:</label>
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
                    <label for="ciudad_residencia">Ciudad de Residencia:</label>
                    <br>
                    <select id="ciudad_residencia" name="ciudad_residencia"></select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="direccion">Dirección:</label>
                    <br>
                    <input type="text" id="direccion" name="direccion">
                </td>
                <td>
                    <label for="codigo_postal">Código Postal:</label>
                    <br>
                    <input type="text" class="numeros" id="codigo_postal" name="codigo_postal">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tlf_movil">Teléfono Móvil:</label>
                    <br>
                    <input type="text" class="numeros" id="tlf_movil" name="tlf_movil">
                </td>
                <td>
                    <label for="tlf_domicilio">Teléfono de Domicilio:</label>
                    <br>
                    <input type="text" class="numeros" id="tlf_domicilio" name="tlf_domicilio">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="correo_electronico">Dirección de Correo Electrónico:</label>
                    <br>
                    <input type="text" id="correo_electronico" name="correo_electronico">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="boton" href="javascript:void(0);">Enviar</a>
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
<?php @include_once( 'formulario-pacientes/antecedentes-perinatales.html')?>
<?php @include_once( 'formulario-pacientes/antecedentes-sexuales.html')?>
<section class="contenedor-formulario">
    <form id="antecedentes-modo-vida" action="">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>
                        <b>Antecedentes Personales de Estilo y Modo de Vida</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fuma">¿Es fumador?</label>
                    <br>
                    <input type="radio" name="fuma" value="TRUE">
                    <label>Si</label>
                    <input type="radio" name="fuma" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="fuma_desde">¿Desde qué edad comenzó a fumar?</label>
                    <br>
                    <select id="fuma_desde" name="fuma_desde">
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
            </tr>
            <tr>
                <td>
                    <label for="cigarrillos_diarios">Cantidad promedio de cigarrillos que fuma al día:</label>
                    <br>
                    <select id="cigarrillos_diarios" name="cigarrillos_diarios">
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
                    <input type="radio" name="alcohol" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="alcohol" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="alcohol_semanal">Cantidad promedio de veces que consume alcohol a la semana:</label>
                    <br>
                    <select id="alcohol_semanal" name="alcohol_semanal">
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
                    <input type="radio" name="drogas_ilicitas" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="drogas_ilicitas" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="actividad_fisica">¿Realiza actividad física?</label>
                    <br>
                    <input type="radio" name="actividad_fisica" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="actividad_fisica" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="sedentarismo">¿Lleva una vida sedentaria?</label>
                    <br>
                    <input type="radio" name="sedentarismo" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="sedentarismo" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="manejo_estres">¿Presenta problemas para manejar el estrés?</label>
                    <br>
                    <input type="radio" name="manejo_estres" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="manejo_estres" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="otros_estilos_vida">Indique, si los hay, otros antecedentes de estilo y modo de vida:</label>
                    <br>
                    <textarea id="otros_estilos_vida" name="otros_estilos_vida"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="boton" href="javascript:void(0);">Enviar</a>
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
<section class="contenedor-formulario">
    <form id="antecendentes-patologicos" action="">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>
                        <b>Antecedentes Personales de Patologías</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tumor_benigno">¿Padeció o padece de alǵun tumor benigno?</label>
                    <br>
                    <input type="radio" name="tumor_benigno" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="tumor_benigno" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="tumor_maligno">¿Padeció o padece de algún tumor maligno?</label>
                    <br>
                    <input type="radio" name="tumor_maligno" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="tumor_maligno" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="erupcion">¿Padeció o padece de alguna enfermedad eruptiva?</label>
                    <br>
                    <input type="radio" name="erupcion" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="erupcion" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="ets">¿Padeció o padece de alguna enfermedad de transmisión sexual?</label>
                    <br>
                    <input type="radio" name="ets" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="ets" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="meningitis">¿Padeció o padece de meningitis?</label>
                    <br>
                    <input type="radio" name="meningitis" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="meningitis" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="chagas">¿Padeció o padece de chagas?</label>
                    <br>
                    <input type="radio" name="chagas" value="TRUE">
                    <label>Si</label>
                    <input type="radio" name="chagas" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tuberculosis">¿Padeció o padece de tuberculosis?</label>
                    <br>
                    <input type="radio" name="tuberculosis" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="tuberculosis" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="dengue">¿Padeció o padece de dengue?</label>
                    <br>
                    <input type="radio" name="dengue" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="dengue" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="hansen">¿Padeció o padece de la enfermedad de Hansen (Lepra)?</label>
                    <br>
                    <input type="radio" name="hansen" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="hansen" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="leishmaniasis">¿Padeció o padece de leishmaniasis?</label>
                    <br>
                    <input type="radio" name="leishmaniasis" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="leishmaniasis" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="leptospirosis">¿Padeció o padece de leptospirosis?</label>
                    <br>
                    <input type="radio" name="leptospirosis" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="leptospirosis" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="malaria">¿Padeció o padece de malaria?</label>
                    <br>
                    <input type="radio" name="malaria" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="malaria" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="desnutricion">¿Padeció o padece de desnutrición?</label>
                    <br>
                    <input type="radio" name="desnutricion" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="desnutricion" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="diabetes">¿Padece de diabetes?</label>
                    <br>
                    <input type="radio" name="diabetes" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="diabetes" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="dislipidemias">¿Padeció o padece de dislipidemias?</label>
                    <br>
                    <input type="radio" name="dislipidemias" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="dislipidemias" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="obesidad">¿Padeció o padece de obesidad?</label>
                    <br>
                    <input type="radio" name="obesidad" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="obesidad" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastorno_apetito">¿Padeció o padece de trastornos de apetito?</label>
                    <br>
                    <input type="radio" name="trastorno_apetito" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="trastorno_apetito" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="enuresis">¿Padeció o padece de enuresis?</label>
                    <br>
                    <input type="radio" name="enuresis" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="enuresis" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="chupa_dedo">¿Se chupa el dedo?</label>
                    <br>
                    <input type="radio" name="chupa_dedo" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="chupa_dedo" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="onicofagia">¿Padeció o padece de onicofagia (se come las uñas)?</label>
                    <br>
                    <input type="radio" name="onicofagia" value="TRUE">
                    <label>Si</label>
                    <input type="radio" name="onicofagia" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastorno_llanto">¿Padeció o padece de trastornos de llanto?</label>
                    <br>
                    <input type="radio" name="trastorno_llanto" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="trastorno_llanto" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="hipertension_arterial">¿Padece de hipertensión arterial sistémica?</label>
                    <br>
                    <input type="radio" name="hipertension_arterial" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="hipertension_arterial" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tromboembolismo">¿Padece de tromboembolismo?</label>
                    <br>
                    <input type="radio" name="tromboembolismo" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="tromboembolismo" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="varices">¿Padece de varices?</label>
                    <br>
                    <input type="radio" name="varices" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="varices" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cardiopatia">¿Padece de cardiopatia?</label>
                    <br>
                    <input type="radio" name="cardiopatia" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="cardiopatia" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="asma">¿Padece de asma?</label>
                    <br>
                    <input type="radio" name="asma" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="asma" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="neumonia">¿Padece de neumonía?</label>
                    <br>
                    <input type="radio" name="neumonia" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="neumonia" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="gastroenteropatias">¿Padeció o padece de gastroenteropatias?</label>
                    <br>
                    <input type="radio" name="gastroenteropatias" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="gastroenteropatias" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="hepatopatias">¿Padeció o padece de hepatopatias?</label>
                    <br>
                    <input type="radio" name="hepatopatias" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="hepatopatias" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="trastornos_evacuacion">¿Padeció o padece de trastornos de evacuación?</label>
                    <br>
                    <input type="radio" name="trastornos_evacuacion" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="trastornos_evacuacion" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="colagenopatias">¿Padeció o padece de colagenopatías?</label>
                    <br>
                    <input type="radio" name="colagenopatias" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="colagenopatias" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="artritis">¿Padeció o padece de artritis?</label>
                    <br>
                    <input type="radio" name="artritis" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="artritis" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastornos_miccionales">¿Padeció o padece de trastornos miccionales?</label>
                    <br>
                    <input type="radio" name="trastornos_miccionales" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="trastornos_miccionales" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="enfermedad_renal">¿Padeció o padece de enfermedad renal?</label>
                    <br>
                    <input type="radio" name="enfermedad_renal" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="enfermedad_renal" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="alergias">¿Padece de alergias?</label>
                    <br>
                    <input type="radio" name="alergias" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="alergias" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="trastornos_suenio">¿Padeció o padece de trastornos del sueño?</label>
                    <br>
                    <input type="radio" name="trastornos_suenio" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="trastornos_suenio" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="violencia_psicologica">¿Padeció o padece de violencia psicológica?</label>
                    <br>
                    <input type="radio" name="violencia_psicologica" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="violencia_psicologica" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="violencia_fisica">¿Padeció o padece de violencia física?</label>
                    <br>
                    <input type="radio" name="violencia_fisica" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="violencia_fisica" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="violencia_sexual">¿Padeció o padece de violencia sexual?</label>
                    <br>
                    <input type="radio" name="violencia_sexual" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="violencia_sexual" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="accidentes">¿Ha sufrido accidentes?</label>
                    <br>
                    <input type="radio" name="accidentes" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="accidentes" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="otras_patologias">Indique, si las hay, otras patologías que padezca o haya padecido:</label>
                    <br>
                    <textarea id="otras_patologias" name="otras_patologias"></textarea>
                </td>
                <td>
                    <label for="grupo_sanguineo">Indique el grupo sanguíneo:</label>
                    <br>
                    <select id="grupo_sanguineo" name="grupo_sanguineo">
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
                    <input type="radio" name="hospitalizacion" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="hospitalizacion" value="FALSE">
                    <label>No</label>
                </td>
                <td>
                    <label for="intervencion_quirurgica">¿Ha sido intervenido quirúrjicamente?</label>
                    <br>
                    <input type="radio" name="intervencion_quirurgica" value="TRUE">
                    <label>Sí</label>
                    <input type="radio" name="intervencion_quirurgica" value="FALSE">
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="observaciones">Indique, si es necesario, detalles sobre las patologías que padece o ha padecido el paciente</label>
                    <br>
                    <textarea id="observaciones" name="observaciones"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="boton" href="javascript:void(0);">Enviar</a>
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
<?php @include_once( 'formulario-pacientes/desarrollo-psicomotor.html')?>
</form>
</section>