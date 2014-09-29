<section class="contenedor-formulario antecedentes-sexuales">
    <form id="form-antecedentes-sexuales-f" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Antecedentes Personales Sexuales y Reproductivos</h3>
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
                    <label for="pubarquia"><strong>1 - </strong>Edad en la que se presentó la Pubarquia:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="pubarquia" name="pubarquia" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
                <td>
                    <label for="telarquia"><strong>2 - </strong>Edad en la que se presentó la Telarquia:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="telarquia" name="telarquia" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
                <td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="menarquia"><strong>3 - </strong>Edad en la que se presentó la Menarquia:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="menarquia" name="menarquia" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
                <td>
                    <label for="ciclo_menstrual"><strong>4 - </strong>Edad en la que se estableció un ciclo menstrual:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="ciclo_menstrual" name="ciclo_menstrual" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="numero_gestas"><strong>5 - </strong>Cantidad de gestas que ha tenido:<i class="fa fa-question-circle fa-fw ayuda" title="Sólo 1 número entero"></i></label>
                    <br>
                    <input class="num" id="numero_gestas" name="numero_gestas" pattern="^[0-9]{1}$" required>
                </td>
                <td>
                    <label for="numero_partos"><strong>6 - </strong>Cantidad de partos que ha tenido:<i class="fa fa-question-circle fa-fw ayuda" title="Sólo 1 número entero"></i></label>
                    <br>
                    <input class="num" id="numero_partos" name="numero_partos" pattern="^[0-9]{1}$" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="numero_cesareas"><strong>7 - </strong>Cantidad de cesáreas que ha tenido:<i class="fa fa-question-circle fa-fw ayuda" title="Sólo 1 número entero"></i></label>
                    <br>
                    <input class="num" id="numero_cesareas" name="numero_cesareas" pattern="^[0-9]{1}$" required>
                </td>
                <td>
                    <label for="numero_abortos"><strong>8 - </strong>Cantidad de abortos que ha tenido:<i class="fa fa-question-circle fa-fw ayuda" title="Sólo 1 número entero"></i></label>
                    <br>
                    <input class="num" id="numero_abortos" name="numero_abortos" pattern="^[0-9]{1}$" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="legrado_uterino"><strong>9 - </strong>¿Se ha realizado un legrado uterino?</label>
                    <br>
                    <input type="radio" name="legrado_uterino" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="legrado_uterino" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="menopausia"><strong>10 - </strong>¿Presentó o presenta menopausia?</label>
                    <br>
                    <input type="radio" name="menopausia" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="menopausia" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="primera_relacion_sexual"><strong>11 - </strong>Edad en la que se tuvo la primera relación sexual:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="primera_relacion_sexual" name="primera_relacion_sexual" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
                <td>
                    <label for="frecuencia_relaciones_sexuales_mes"><strong>12 - </strong>Cantidad promedio de relaciones sexuales al mes:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 3 números enteros"></i></label>
                    <br>
                    <input class="num" id="frecuencia_relaciones_sexuales_mes" name="frecuencia_relaciones_sexuales_mes" pattern="^[0-9]{1,3}$" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="num_parejas_ultimo_anio"><strong>13 - </strong>Cantidad de parejas sexuales en el último año:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 3 números enteros"></i></label>
                    <br>
                    <input class="num" id="num_parejas_ultimo_anio" name="num_parejas_ultimo_anio" pattern="^[0-9]{1,3}$" required>
                </td>
                <td>
                    <label for="relacion_sexual_satisfactoria"><strong>14 - </strong>¿Relaciones sexuales satisfactorias?</label>
                    <br>
                    <input type="radio" name="relacion_sexual_satisfactoria" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="relacion_sexual_satisfactoria" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="anticonceptivo"><strong>15 - </strong>¿Ha utilizado algún método anticonceptivo?</label>
                    <br>
                    <input type="radio" name="anticonceptivo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="anticonceptivo" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="aco_oral"><strong>16 - </strong>¿Ha utilizado métodos anticonceptivos orales?</label>
                    <br>
                    <input type="radio" name="aco_oral" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="aco_oral" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="diu"><strong>17 - </strong>¿Ha utilizado métodos anticonceptivos intrauterinos?</label>
                    <br>
                    <input type="radio" name="diu" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="diu" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="otro_anticonceptivo"><strong>18 - </strong>¿Ha utilizado algún otro método anticonceptivo?</label>
                    <br>
                    <input type="radio" name="otro_anticonceptivo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="otro_anticonceptivo" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="otros_antecedentes_sexuales"><strong>19 - </strong>Indique, si existen, otros antecedentes sexuales:</label>
                    <br>
                    <textarea id="otros_antecedentes_sexuales" name="otros_antecedentes_sexuales" required></textarea>
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
    <form id="form-antecedentes-sexuales-m" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Antecedentes Personales Sexuales y Reproductivos</h3>
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
                    <label for="pubarquia"><strong>1 - </strong>Edad en la que se presentó la pubarquia:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="pubarquia" name="pubarquia" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
                <td>
                    <label for="inicio_crecimiento_testicular"><strong>2 - </strong>Edad en la que se inició el crecimiento testicular:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="inicio_crecimiento_testicular" name="inicio_crecimiento_testicular" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
                <td class="oculto">
                    <input class="id_paciente" name="id_paciente" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="andropausia"><strong>3 - </strong>¿Presentó o presenta andropausia?</label>
                    <br>
                    <input type="radio" name="andropausia" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="andropausia" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="primera_relacion_sexual"><strong>4 - </strong>Edad en la que se tuvo la primera relación sexual:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 2 números enteros"></i></label>
                    <br>
                    <input class="num unit" id="primera_relacion_sexual" name="primera_relacion_sexual" pattern="^[0-9]{1,2}$" required>
                    <span>Años</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="frecuencia_relaciones_sexuales_mes"><strong>5 - </strong>Cantidad promedio de relaciones sexuales al mes:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 3 números enteros"></i></label>
                    <br>
                    <input class="num" id="frecuencia_relaciones_sexuales_mes" name="frecuencia_relaciones_sexuales_mes" pattern="^[0-9]{1,3}$" required>
                </td>
                <td>
                    <label for="num_parejas_ultimo_anio"><strong>6 - </strong>Cantidad de parejas sexuales en el último año:<i class="fa fa-question-circle fa-fw ayuda" title="<strong>Puede estar formado por:</strong><br>- Mínimo 1 número entero<br>- Máximo 3 números enteros"></i></label>
                    <br>
                    <input class="num" id="num_parejas_ultimo_anio" name="num_parejas_ultimo_anio" pattern="^[0-9]{1,3}$" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="relacion_sexual_satisfactoria"><strong>7 - </strong>¿Relaciones sexuales satisfactorias?</label>
                    <br>
                    <input type="radio" name="relacion_sexual_satisfactoria" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="relacion_sexual_satisfactoria" value="FALSE" required>
                    <label>No</label>
                </td>
                <td>
                    <label for="anticonceptivo"><strong>8 - </strong>¿Ha utilizado algún método anticonceptivo?</label>
                    <br>
                    <input type="radio" name="anticonceptivo" value="TRUE" required>
                    <label>Sí</label>
                    <input type="radio" name="anticonceptivo" value="FALSE" required>
                    <label>No</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="otros_antecedentes_sexuales"><strong>9 - </strong>Indique, si existen, otros antecedentes sexuales:</label>
                    <br>
                    <textarea id="otros_antecedentes_sexuales" name="otros_antecedentes_sexuales" required></textarea>
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