<section class="contenedor-formulario desarrollo-psicomotor">
    <form id="form-desarrollo-psicomotor" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Desarrollo Psicomotor</h3>
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
                    <label for="levanto_cabeza"><strong>1 - </strong>Edad en la que levantó la cabeza por primera vez:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="levanto_cabeza" name="levanto_cabeza" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
                </td>
                <td>
                    <label for="se_sento"><strong>2 - </strong>Edad en la que se sentó por primera vez:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="se_sento" name="se_sento" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
                </td>
                <td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="gateo"><strong>3 - </strong>Edad en la que comenzó a gatear:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="gateo" name="gateo" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
                </td>
                <td>
                    <label for="se_paro"><strong>4 - </strong>Edad en la que se levantó por primera vez:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="se_paro" name="se_paro" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="camino"><strong>5 - </strong>Edad en la que comenzó a caminar:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="camino" name="camino" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
                </td>
                <td>
                    <label for="primeras_palabras"><strong>6 - </strong>Edad en la que pronunció sus primeras palabras:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="primeras_palabras" name="primeras_palabras" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="interaccion_social"><strong>7 - </strong>Edad en la que comenzaron sus interacciones sociales:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="interaccion_social" name="interaccion_social" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
                </td>
                <td>
                    <label for="control_esfinter_vesical"><strong>8 - </strong>Edad en la comenzó a controlar su esfinter vesical:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="control_esfinter_vesical" name="control_esfinter_vesical" pattern="^[0-9]{1,2}$" required>
                    <span>Meses</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="control_esfinter_anal"><strong>9 - </strong>Edad en la que comenzó a controlar su esfinter anal:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="control_esfinter_anal" name="control_esfinter_anal" pattern="^[0-9]{1,2}$" required>
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