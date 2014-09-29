<section class="contenedor-formulario antecedentes-perinatales">
    <form id="form-antecedentes-perinatales" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Antecedentes Perinatales</h3>
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
                    <label for="nro_consultas_prenatales"><strong>1 - </strong>Número de consultas prenatales:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 3 números enteros"></i></label>
                    <br>
                    <input class="num" id="nro_consultas_prenatales" name="nro_consultas_prenatales" pattern="^[0-9]{1,3}$" required>
                </td>
                <td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>
                <td>
                    <label for="trastornos_embarazo"><strong>2 - </strong>¿Se presentaron trastornos en el embarazo?</label>
                    <br>
                    <input type="radio" name="trastornos_embarazo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_embarazo" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="embarazo_a_termino"><strong>3 - </strong>¿Fue un embarazo a término?</label>
                    <br>
                    <input type="radio" name="embarazo_a_termino" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="embarazo_a_termino" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="parto_unico_espontaneo"><strong>4 - </strong>¿Fue un parto único espontáneo?</label>
                    <br>
                    <input type="radio" name="parto_unico_espontaneo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="parto_unico_espontaneo" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="parto_forceps"><strong>5 - </strong>¿Fue un parto con fórceps?</label>
                    <br>
                    <input type="radio" name="parto_forceps" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="parto_forceps" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="complicaciones_parto"><strong>6 - </strong>¿Se presentaron complicaciones en el parto?</label>
                    <br>
                    <input type="radio" name="complicaciones_parto" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="complicaciones_parto" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="trastornos_recien_nacido"><strong>7 - </strong>¿Presentó trastornos el recién nacido?</label>
                    <br>
                    <input type="radio" name="trastornos_recien_nacido" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="trastornos_recien_nacido" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="reanimacion"><strong>8 - </strong>¿Se tuvo que aplicar reanimación al recien nacido?</label>
                    <br>
                    <input type="radio" name="reanimacion" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="reanimacion" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="asfixia"><strong>9 - </strong>¿Presentó asfixia el recién nacido?</label>
                    <br>
                    <input type="radio" name="asfixia" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="asfixia" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="peso_al_nacer"><strong>10 - </strong>Peso del recién nacido:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Números enteros o decimales<br>- Para valores decimales usar . (punto)<br>- Mínimo 1 número entero<br>- Máximo 2 números enteros<br>- Mínimo 1 número después del punto<br>- Máximo 5 números depués del punto"></i></label>
                    <br>
                    <input type="text" class="float" id="peso_al_nacer" name="peso_al_nacer" pattern="(^[0-9]{1,2}\.[0-9]{1,5}$|^[0-9]{1,2}$)" placeholder="3.2" required>
                    <span>kg</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="talla_al_nacer"><strong>11 - </strong>Talla del recién nacido:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Números enteros o decimales<br>- Para valores decimales usar . (punto)<br>- Mínimo 1 número entero<br>- Máximo 2 números enteros<br>- Mínimo 1 número después del punto<br>- Máximo 5 números depués del punto"></i></label>
                    <br>
                    <input type="text" class="float" id="talla_al_nacer" name="talla_al_nacer" pattern="(^[0-9]{1,2}\.[0-9]{1,5}$|^[0-9]{1,2}$)" placeholder="50.4" required>
                    <span>cm</span>
                </td>
                <td>
                    <label for="perimetro_cefalico"><strong>12 - </strong>Perímetro Cefálico del recién nacido:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Números enteros o decimales<br>- Para valores decimales usar . (punto)<br>- Mínimo 1 número entero<br>- Máximo 2 números enteros<br>- Mínimo 1 número después del punto<br>- Máximo 5 números depués del punto"></i></label>
                    <br>
                    <input type="text" class="float" id="perimetro_cefalico" name="perimetro_cefalico" pattern="(^[0-9]{1,2}\.[0-9]{1,5}$|^[0-9]{1,2}$)" placeholder="34.8" required>
                    <span>cm</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lactancia"><strong>13 - </strong>Tipo de alimentación al nacer:</label>
                    <br>
                    <select id="lactancia" name="lactancia" required>
                        <option value=""></option>
                        <option value="Natural">Natural</option>
                        <option value="Artificial">Artificial</option>
                        <option value="Mixta">Mixta</option>
                    </select>
                </td>
                <td>
                    <label for="ablactacion"><strong>14 - </strong>Edad en la que se produjo la ablactación:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="ablactacion" name="ablactacion" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
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