<section class="contenedor-formulario antecedentes-perinatales">
    <form id="form-antecedentes-perinatales" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>
                        <b>Antecedentes Perinatales</b>
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nro_consultas_prenatales">Número de Consultas Prenatales:</label>
                    <br>
                    <select id="nro_consultas_prenatales" name="nro_consultas_prenatales" required>
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
                <td>
                    <label for="nombre_madre">Nombre de la Madre del Paciente:</label>
                    <br>
                    <input type="text" id="nombre_madre" name="nombre_madre" required>
                </td>
                <td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nombre_padre">Nombre del Padre del Paciente:</label>
                    <br>
                    <input type="text" id="nombre_padre" name="nombre_padre" required>
                </td>
                <td>
                    <label for="trastornos_embarazo">¿Se presentaron trastornos en el embarazo?</label>
                    <br>
                    <input type="radio" name="trastornos_embarazo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_embarazo" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="embarazo_a_termino">¿Fue un embarazo a término?</label>
                    <br>
                    <input type="radio" name="embarazo_a_termino" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="embarazo_a_termino" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="parto_unico_espontaneo">¿Fue un parto único espontáneo?</label>
                    <br>
                    <input type="radio" name="parto_unico_espontaneo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="parto_unico_espontaneo" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="parto_forceps">¿Fue un parto con fórceps?</label>
                    <br>
                    <input type="radio" name="parto_forceps" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="parto_forceps" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="complicaciones_parto">¿Se presentaron complicaciones en el parto?</label>
                    <br>
                    <input type="radio" name="complicaciones_parto" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="complicaciones_parto" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="complicaciones_puerperio">¿Se presentaron complicaciones en el puerperio?</label>
                    <br>
                    <input type="radio" name="complicaciones_puerperio" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="complicaciones_puerperio" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="trastornos_recien_nacido">¿Presentó trastornos el recién nacido?</label>
                    <br>
                    <input type="radio" name="trastornos_recien_nacido" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_recien_nacido" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="reanimacion">¿Se tuvo que aplicar reanimación al recien nacido?</label>
                    <br>
                    <input type="radio" name="reanimacion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="reanimacion" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="peso_al_nacer">Peso del recién nacido:</label>
                    <br>
                    <input type="text" id="peso_al_nacer" name="peso_al_nacer" required>
                    <span>gr</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="talla_al_nacer">Talla del recién nacido:</label>
                    <br>
                    <input type="text" id="talla_al_nacer" name="talla_al_nacer" required>
                    <span>cm</span>
                </td>
                <td>
                    <label for="perimetro_cefalico">Perímetro Cefálico del recién nacido:</label>
                    <br>
                    <input type="text" id="perimetro_cefalico" name="perimetro_cefalico" required>
                    <span>cm</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lactancia_exclusiva">Edad en la que dejó de recibir lactancia exclusiva:</label>
                    <br>
                    <select id="lactancia_exclusiva" name="lactancia_exclusiva" required>
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
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                    </select>
                    <span>Meses</span>
                </td>
                <td>
                    <label for="lactancia_mixta">Edad en la que empezó a recibir lactancia mixta:</label>
                    <br>
                    <select id="lactancia_mixta" name="lactancia_mixta" required>
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
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                    </select>
                    <span>Meses</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ablactacion">Edad en la que se produjo la ablactación:</label>
                    <br>
                    <select id="ablactacion" name="ablactacion" required>
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
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                    </select>
                    <span>Meses</span>
                </td>
                <td>
                    <label for="patologias_al_nacer">¿Presentó patologías el recién nacido?</label>
                    <br>
                    <input type="radio" name="patologias_al_nacer" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="patologias_al_nacer" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="asfixia">¿Presentó asfixia el recién nacido?</label>
                    <br>
                    <input type="radio" name="asfixia" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="asfixia" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="recien_nacido_sano">¿Fue un recien nacido sano?</label>
                    <br>
                    <input type="radio" name="recien_nacido_sano" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="recien_nacido_sano" value="FALSE" required>
                    <label>No</label>
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