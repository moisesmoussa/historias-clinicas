<section class="contenedor-formulario" id="datos-paciente">
    <h2 align="center">Diagnóstico</h2>
    <table class="formulario">
        <tr>
            <td colspan="2">
                <h3>Datos del Paciente</h3>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for="nro_historia_clinica">Número de Historia Clínica:</label>
                <br>
                <input type="text" id="nro_historia_clinica" readonly="readonly">
            </td>
            <td class="oculto">
                <input type="text" class="id_paciente" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>
                <label for="apellidos">Apellidos:</label>
                <br>
                <input type="text" id="apellidos" readonly="readonly">
            </td>
            <td>
                <label for="nombres">Nombres:</label>
                <br>
                <input type="text" id="nombres" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>
                <label for="nacionalidad">Nacionalidad:</label>
                <br>
                <select id="nacionalidad" disabled="disabled">
                    <option value="V">Venezolana</option>
                    <option value="E">Extranjera</option>
                </select>
            </td>
            <td>
                <label for="documento_identidad">Documento de Identidad:</label>
                <br>
                <input type="text" id="documento_identidad" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>
                <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                <br>
                <input class="calendario" id="fecha_nacimiento" type="text" readonly="readonly">
            </td>
            <td>
                <label for="edad">Edad:</label>
                <br>
                <input type="text" id="edad" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>
                <label for="sexo">Sexo:</label>
                <br>
                <input type="text" id="sexo" readonly="readonly">
            </td>
            <td>
                <label for="lugar_nacimiento">Lugar de Nacimiento:</label>
                <br>
                <input type="text" id="lugar_nacimiento" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>
                <label for="peso">Peso:</label>
                <br>
                <input type="text" id="peso" readonly="readonly">
            </td>
            <td>
                <label for="estatura">Estatura:</label>
                <br>
                <input type="text" id="estatura" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>
                <label for="superficie_corporal">Superficie Corporal:</label>
                <br>
                <input type="text" id="superficie_corporal" readonly="readonly">
            </td>
            <td>
                <label for="direccion">Dirección:</label>
                <br>
                <input type="text" id="direccion" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>
                <label for="tlf_casa">Teléfono de Habitación:</label>
                <br>
                <input type="text" id="tlf_casa" readonly="readonly">
            </td>
            <td>
                <label for="tlf_movil">Teléfono Móvil:</label>
                <br>
                <input type="text" id="tlf_movil" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>
                <label for="ocupacion">Ocupación:</label>
                <br>
                <input type="text" id="ocupacion" readonly="readonly">
            </td>
            <td>
                <label for="empresa">Empresa:</label>
                <br>
                <input type="text" id="empresa" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" class="boton modificar" value="Modificar Datos" />
            </td>
        </tr>
    </table>
</section>
<section class="contenedor-formulario">
    <br>
    <label>* Datos Obligatorios</label>
    <form id="form-diagnostico" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Datos Generales</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fecha_solicitud">Fecha de Solicitud: *</label>
                    <br>
                    <input class="calendario" id="fecha_solicitud" name="fecha_solicitud" type="text" readonly="readonly" required>
                </td>
                <td>
                    <label for="centro_asistencial">Centro Asistencial: *</label>
                    <br>
                    <input type="text" id="centro_asistencial" name="centro_asistencial" required>
                </td>
                <td class="oculto">
                    <input type="text" class="id_paciente" name="id_paciente" readonly="readonly">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ciudad_centro_asistencial">Localidad: *</label>
                    <br>
                    <input id="ciudad_centro_asistencial" name="ciudad_centro_asistencial" type="text" required>
                </td>
                <td>
                    <label for="estado_centro_asistencial">Estado: *</label>
                    <br>
                    <select id="estado_centro_asistencial" name="estado_centro_asistencial" required>
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
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Datos Clínicos</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="primer_sintoma">Primer Síntoma: *</label>
                    <br>
                    <input type="text" id="primer_sintoma" name="primer_sintoma" required>
                </td>
                <td>
                    <label for="fecha_primer_sintoma">Fecha del Primer Síntoma: *</label>
                    <br>
                    <input type="text" class="calendario" id="fecha_primer_sintoma" name="fecha_primer_sintoma" readonly="readonly" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="diagnostico">Diagnóstico: *</label>
                    <br>
                    <input type="text" id="diagnostico" name="diagnostico" required>
                </td>
                <td>
                    <label for="fecha_diagnostico">Fecha del Diagnóstico: *</label>
                    <br>
                    <input type="text" class="calendario" id="fecha_diagnostico" name="fecha_diagnostico" readonly="readonly" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Resumen Clínico</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="anatomia_patologica">Anatomía Patológica: *</label>
                    <br>
                    <textarea id="anatomia_patologica" name="anatomia_patologica" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="inmunohistoquimica">Inmunohistoquímica: *</label>
                    <br>
                    <textarea id="inmunohistoquimica" name="inmunohistoquimica" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="marcadores_tumorales">Marcadores Tumorales: *</label>
                    <br>
                    <textarea id="marcadores_tumorales" name="marcadores_tumorales" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="escala_actividad">Escala de Actividad: *</label>
                    <br>
                    <textarea id="escala_actividad" name="escala_actividad" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Estatus Condicional *</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <select id="grado_enfermedad" name="grado_enfermedad" required>
                        <option value=""></option>
                        <option value="0">Grado 0</option>
                        <option value="1">Grado 1</option>
                        <option value="2">Grado 2</option>
                        <option value="3">Grado 3</option>
                        <option value="4">Grado 4</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Tratamiento Indicado y Esquema Inicial</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="fecha_inicio_tratamiento">Fecha de Inicio de Tratamiento: *</label>
                    <br>
                    <input type="text" class="calendario" id="fecha_inicio_tratamiento" name="fecha_inicio_tratamiento" readonly="readonly" required>
                </td>
                <td>
                    <label for="ciclos_estimados">Nº de Ciclos Estimados: *</label>
                    <br>
                    <input type="text" id="ciclos_estimados" name="ciclos_estimados" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ciclos_aplicados">Nº de Ciclos Aplicados: *</label>
                    <br>
                    <input type="text" id="ciclos_aplicados" name="ciclos_aplicados" required>
                </td>
                <td>
                    <label for="ciclos_pendientes">Nº de Ciclos Pendientes: *</label>
                    <br>
                    <input type="text" id="ciclos_pendientes" name="ciclos_pendientes" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="intervalo">Intervalo: *</label>
                    <br>
                    <input type="text" id="intervalo" name="intervalo" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label>En caso de ameritar otra línea de dosificación, el médico tratante debe llenar los siguientes datos</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Respuesta al Tratamiento:</h3>
                    <textarea id="respuesta_tratamiento" name="respuesta_tratamiento"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Tiempo de Progresión:</h3>
                    <textarea id="tiempo_progresion" name="tiempo_progresion"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label>En caso de falla del medicamento, explique los motivos y anexar los estudios que respalden la solicitud</label>
                    <br>
                    <textarea id="motivo_falla_tratamiento" name="motivo_falla_tratamiento"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Líneas de Tratamiento Sucesivas</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="linea_tratamiento_1">Línea 1:</label>
                    <br>
                    <textarea id="linea_tratamiento_1" name="linea_tratamiento_1"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="linea_tratamiento_2">Línea 2:</label>
                    <br>
                    <textarea id="linea_tratamiento_2" name="linea_tratamiento_2"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="linea_tratamiento_3">Línea 3:</label>
                    <br>
                    <textarea id="linea_tratamiento_3" name="linea_tratamiento_3"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="linea_tratamiento_4">Línea 4:</label>
                    <br>
                    <textarea id="linea_tratamiento_4" name="linea_tratamiento_4"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="otras_lineas_tratamiento">Otras:</label>
                    <br>
                    <textarea id="otras_lineas_tratamiento" name="otras_lineas_tratamiento"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Esquema:</h3>
                    <textarea id="esquema" name="esquema"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Sobrevida Global a la Fecha:</h3>
                    <textarea id="sobrevida_global" name="sobrevida_global"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Esquema Solicitado</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="dosis_esquema">Dosis:</label>
                    <br>
                    <input type="text" id="dosis_esquema" name="dosis_esquema">
                </td>
                <td>
                    <label for="duracion_esquema">Tiempo de Duración:</label>
                    <br>
                    <input type="text" id="duracion_esquema" name="duracion_esquema">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>Motivo de la Solicitud y Estudios que la Respalden:</h3>
                    <textarea id="motivo_solicitud" name="motivo_solicitud"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="boton" value="Guardar" />
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
    <br>
    <label>* Datos Obligatorios</label>
    <form id="form-medico" action="" autocomplete="on">
        <table class="formulario">
            <tr>
                <td colspan="2">
                    <h3>Datos del Médico Tratante</h3>
                </td>
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
                <td class="oculto">
                    <input type="text" class="id_paciente" name="id_paciente" readonly="readonly">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cedula">Cédula: *</label>
                    <br>
                    <input type="text" id="cedula" name="cedula" required>
                </td>
                <td>
                    <label for="nro_colegio_medicos">Nº Colegio de Médicos: *</label>
                    <br>
                    <input type="text" id="nro_colegio_medicos" name="nro_colegio_medicos" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nro_registro_mpps">Nº Registro MPPS: *</label>
                    <br>
                    <input type="text" id="nro_registro_mpps" name="nro_registro_mpps" required>
                </td>
                <td>
                    <label for="tlf_contacto">Teléfono de Contacto: *</label>
                    <br>
                    <b><input class="tlf" name="tlf_contacto[]" type="text" pattern="^[0-9]{4}$" required> - <input class="tlf" name="tlf_contacto[]" type="text" pattern="^[0-9]{3}$" required> - <input class="tlf" name="tlf_contacto[]" type="text" pattern="^[0-9]{4}$" required></b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="boton" value="Guardar" />
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