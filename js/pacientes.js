/* Habilita los formularios restantes para un paciente de acuerdo al cumplimiento o no de ciertas condiciones según la información brindada por este formulario
 * Parámetros:
 * - "id_paciente" es el id del paciente y se utiliza para cargarlo en inputs ocultos de los demas formularios del paciente
 *   para que se pueda acceder al id posteriormente
 */
function successAgregarDatosPaciente(idPaciente) {
    var fecha = new Date();

    $('.id_paciente').each(function () {
        $(this).val(idPaciente);
    });

    $('.antecedentes-modo-vida').show();
    $('.antecedentes-patologicos').show();
    $('.antecedentes-sexuales').show();

    //Verifica el sexo indicado de un paciente para activar el formulario de antecedentes sexuales de acuerdo a la opción seleccionada
    if ($('input:radio[name=sexo]:checked').val() === 'Masculino')
        $('#form-antecedentes-sexuales-f').hide();
    else
        $('#form-antecedentes-sexuales-m').hide();

    //Verifica la edad del paciente a registrar para activar los formularios "desarrollo psicomotor" y "antecedentes perinatales"
    if (edad < 10)
        $('.desarrollo-psicomotor').show();

    if (edad < 19)
        $('.antecedentes-perinatales').show();
}

/* Se encarga de insertar en la base de datos los datos del paciente provenientes del formulario que se ha indicado
 * Parámetros:
 * - "archivoPhp" indica el archivo .php en la carpeta "json" al cual se le envían los datos del formulario para ser insertados en la base de datos
 * - "formulario" es el nombre del formulario cuyos datos se quieren guardar en la base de datos
 */
function ajaxAgregarPaciente(archivoPhp, formulario) {
    $.ajax({
        async: false,
        type: 'POST',
        url: basedir + '/json/paciente/insertar/' + archivoPhp,
        data: $('#' + formulario).serialize(), // Adjuntar los campos del formulario a enviar.
        beforeSend: function () {
            $('#' + formulario + ' .status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando datos').show();
        },
        error: function () {
            $('#' + formulario + ' .status').html('Error guardando la información').show();
        },
        success: function (data) {
            try {
                $('#' + formulario + ' .status').hide();
                var r = JSON.parse(data);

                if (r.flag === 1) {
                    $('#' + formulario + ' .boton').prop('data-enable', 'false');
                    $('#' + formulario + ' .boton').css('background-color', '#ECECEC');
                    $('#' + formulario + ' .boton').css('cursor', 'default');
                    $('#' + formulario + ' :input').prop('disabled', true);

                    if (formulario === 'datos-paciente')
                        successAgregarDatosPaciente(r.id);
                }
                alert(r.msg);

            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

/* Aplica la acción correspondiente de acuerdo al formulario de datos del paciente que se ha indicado
 * Parámetros:
 * - "formulario" indica el nombre del formulario cuyos datos se quiere almacenar en la base de datos
 */
function agregarPaciente(formulario) {
    switch (formulario) {
    case 'datos-paciente':
        ajaxAgregarPaciente('datos_paciente.php', formulario);
        break;
    case 'form-antecedentes-perinatales':
        ajaxAgregarPaciente('antecedentes_perinatales.php', formulario);
        break;
    case 'form-antecedentes-sexuales-f':
        ajaxAgregarPaciente('antecedentes_sexuales.php', formulario);
        break;
    case 'form-antecedentes-sexuales-m':
        ajaxAgregarPaciente('antecedentes_sexuales.php', formulario);
        break;
    case 'form-antecedentes-modo-vida':
        ajaxAgregarPaciente('antecedentes_modo_vida.php', formulario);
        break;
    case 'form-antecedentes-patologicos':
        ajaxAgregarPaciente('antecedentes_patologicos.php', formulario);
        break;
    case 'form-desarrollo-psicomotor':
        ajaxAgregarPaciente('desarrollo_psicomotor.php', formulario);
        break;
    }
}

/* Trae algunos datos importantes de todos los pacientes o de los pacientes que consiga según una búsqueda indicada en la base de datos y los
 * muestra al usuario que los solicitó en una tabla
 * Parámetros:
 * - "busqueda" (opcional) contiene la información para filtrar la búsqueda de pacientes
 *   + Valor por defecto: ''
 */
function cargarPacientes(busqueda) {
    var archivo;

    if (typeof (busqueda) === 'undefined') {
        archivo = 'cargar_todos.php';
        busqueda = '';
    } else {
        archivo = 'buscar.php';
    }
    $.ajax({
        async: false,
        type: 'POST',
        url: basedir + '/json/paciente/' + archivo,
        data: {
            busqueda: busqueda
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (pacientes) {
            try {
                var datos = JSON.parse(pacientes);
                var html = '<tr><th class="icono-tabla"></th><th>Número de Historia Clínica</th><th>Documento de Identidad</th><th>Nombres</th><th>Apellidos</th><th>Móvil</th><th>Email</th></tr>';

                if (datos.flag === 1) {
                    for (var i in datos.paciente) {
                        html += '<tr><td class="icono-tabla" data-id="' + datos.paciente[i].id + '"><i class="fa fa-trash-o fa-2x icon borrar" title="Eliminar paciente"></i><i class="fa fa-edit fa-2x icon editar" title="Modificar paciente"></i><i class="fa fa-medkit fa-2x icon diagnostico" title="Agregar y/o modificar diagnóstico del paciente"></i></td><td>' + datos.paciente[i].nro_historia_clinica + '</td><td>' + datos.paciente[i].documento_identidad + '</td><td>' + datos.paciente[i].nombres + '</td><td>' + datos.paciente[i].apellidos + '</td><td>' + datos.paciente[i].tlf_movil + '</td><td>' + datos.paciente[i].correo_electronico + '</td></tr>';
                    }
                    $('.pacientes').html(html);

                } else {
                    alert(datos.msg);
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

/* Convierte una fecha en formato string a un objeto tipo "date" de javascript
 * Parámetros:
 * - "fecha" es una fecha que se encuentra en string ordenada en formato "Y-M-D"
 * - "delimitador" es el caracter con el que se separan los datos de la fecha
 */
function fechaObjeto(fecha, delimitador) {
    fecha = fecha.split(delimitador);

    return new Date(fecha[2] + '-' + fecha[1] + '-' + fecha[0])
}

/* Calcula la edad de acuerdo a la fecha de nacimiento y la fecha en el momento de ejecutar el proceso
 * Parámetros:
 * - "fechaNacimiento" es la fecha de nacimiento de la persona a la cual se le quiere calcular la edad
 */
function calcularEdad(fechaNacimiento) {
    var fechaActual = new Date();
    var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

    if (fechaNacimiento.getMonth() > fechaActual.getMonth() || (fechaNacimiento.getMonth() === fechaActual.getMonth() && (fechaNacimiento.getDate() + 1) > fechaActual.getDate()))
        edad--;

    return edad;
}

/* Verifica la edad del paciente a modificar para activar los formularios "desarrollo psicomotor" y "antecedentes perinatales"
 * Parámetros:
 * - "fechaNacimiento" es la fecha de nacimiento del paciente
 */
function verificarEdad(fechaNacimiento) {
    var edad = calcularEdad(fechaNacimiento);

    if (edad > 9)
        $('.desarrollo-psicomotor').hide();
    else
        $('.desarrollo-psicomotor').show();

    if (edad > 18)
        $('.antecedentes-perinatales').hide();
    else
        $('.antecedentes-perinatales').show();
}

/* Carga todos los datos del paciente indicado enviados por el servidor para que un usuario los pueda visualizar en la interfaz gráfica del sistema
 * Parámetros:
 * - "datos" es toda la información del paciente indicado enviada por el servidor
 */
function successMostrarPaciente(datos) {
    if (datos.flag === 1) {
        var form;
        verificarEdad(fechaObjeto(datos.paciente.fecha_nacimiento, '-'));
        datos.paciente.fecha_nacimiento = datos.paciente.fecha_nacimiento.replace(/-/g, '/');
        $('input:radio[name=sexo][value=' + datos.paciente.sexo + ']').prop('checked', true);

        //Carga los números telefónicos del paciente en sus correspondientes campos separados
        $('input[name="tlf_movil[]"]').each(function () {
            $(this).val(datos.paciente.tlf_movil[$(this).index()]);
        });
        $('input[name="tlf_casa[]"]').each(function () {
            $(this).val(datos.paciente.tlf_casa[$(this).index()]);
        });
        datos.paciente.tlf_movil = null;
        datos.paciente.tlf_casa = null;

        //Carga la ciudad registrada como dirección del paciente, ya sea que esté o no en la lista de ciudades por estado
        $.ajax({
            async: false,
            url: basedir + '/ciudades/' + datos.usuario.estado_residencia + '.html',
            dataType: 'text',
            success: function (datosCiudades) {
                var ciudades = datosCiudades;
                var ciudadSeleccionada = '"' + datos.usuario.ciudad_residencia + '"';
                $('#ciudad_residencia').html(ciudades);

                if (ciudades.match(ciudadSeleccionada)) {
                    $('#ciudad_residencia').val(datos.usuario.ciudad_residencia);
                } else {
                    $('#ciudad_residencia').after('<br>');
                    $('#ciudad_residencia').removeAttr('name');
                    $('.otra_ciudad').val(datos.usuario.ciudad_residencia);
                    $('.otra_ciudad').attr('name', 'ciudad_residencia').prop('required', true).show();
                    datos.usuario.ciudad_residencia = '-OTRA-';
                }
            }
        });

        //Verifica el sexo indicado de un paciente para activar el formulario de antecedentes sexuales de acuerdo a la opción seleccionada
        if (datos.paciente.sexo === 'Masculino') {
            form = '#form-antecedentes-sexuales-m ';
            $('#form-antecedentes-sexuales-f').hide();
        } else {
            form = '#form-antecedentes-sexuales-f ';
            $('#form-antecedentes-sexuales-m').hide();
        }

        //Carga los datos restantes del paciente indicado enviados por el servidor a excepción de los datos del formulario "antecedentes sexuales"
        for (var i in datos.paciente) {
            if (datos.paciente[i] === 'f' && $('input:radio[name=' + i + ']').is('input:radio'))
                $('input:radio[name=' + i + '][value=FALSE]').prop('checked', true);
            else if (datos.paciente[i] === 't' && $('input:radio[name=' + i + ']').is('input:radio'))
                $('input:radio[name=' + i + '][value=TRUE]').prop('checked', true);
            else
                $('#' + i).val(datos.paciente[i]);
        }

        //Carga los datos del formulario "antecedentes sexuales" del paciente indicado
        for (var i in datos.antecedentes_sexuales) {
            if (datos.antecedentes_sexuales[i] === 'f' && $(form + 'input:radio[name=' + i + ']').is('input:radio'))
                $(form + 'input:radio[name=' + i + '][value=FALSE]').prop('checked', true);
            else if (datos.antecedentes_sexuales[i] === 't' && $(form + 'input:radio[name=' + i + ']').is('input:radio'))
                $(form + 'input:radio[name=' + i + '][value=TRUE]').prop('checked', true);
            else
                $(form + '#' + i).val(datos.antecedentes_sexuales[i]);
        }
    } else {
        alert(datos.msg);

        if (datos.flag === 2)
            window.location.replace(basedir + '/pacientes');
    }
}

/* Carga la información de un paciente y la muestra en un formulario para que se puedan modificar
 * Parámetros:
 * - "patientId" indica el id del paciente
 */
function mostrarPaciente(patientId) {
    $.ajax({
        async: false,
        url: basedir + '/json/paciente/cargar.php',
        type: 'POST',
        data: {
            paciente: patientId
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (paciente) {
            try {
                var datos = JSON.parse(paciente);
                successMostrarPaciente(datos);

                $('.id_paciente').each(function () {
                    $(this).val(patientId);
                });
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

/* Actualiza en la base de datos los datos del paciente provenientes del formulario que se ha indicado
 * Parámetros:
 * - "archivoPhp" indica el archivo .php en la carpeta "json" al cual se le envían los datos del formulario para ser actualizados en la base de datos
 * - "formulario" es el nombre del formulario cuyos datos se quieren actualizar en la base de datos
 */
function ajaxActualizarPaciente(archivoPhp, formulario) {
    $.ajax({
        async: false,
        type: 'POST',
        url: basedir + '/json/paciente/actualizar/' + archivoPhp,
        data: $('#' + formulario).serialize(),
        beforeSend: function () {
            $('#' + formulario + ' .status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando datos').show();
        },
        error: function () {
            $('#' + formulario + ' .status').html('Error cargando la información').show();
        },
        success: function (data) {
            try {
                $('#' + formulario + ' .status').hide();
                var r = JSON.parse(data);

                if (r.flag === 1 && formulario === 'datos-paciente')
                    verificarEdad(fechaObjeto($('#' + formulario + ' #fecha_nacimiento').val(), '/'));

                alert(r.msg);

            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

/* Aplica la acción correspondiente de acuerdo al formulario de datos del paciente que se ha indicado para actualizar
 * Parámetros:
 * - "formulario" indica el nombre del formulario cuyos datos se quieren actualizar en la base de datos
 */
function actualizarPaciente(formulario) {
    switch (formulario) {
    case 'datos-paciente':
        ajaxActualizarPaciente('datos_paciente.php', formulario);
        break;
    case 'form-antecedentes-perinatales':
        ajaxActualizarPaciente('antecedentes_perinatales.php', formulario);
        break;
    case 'form-antecedentes-sexuales-f':
        ajaxActualizarPaciente('antecedentes_sexuales.php', formulario);
        break;
    case 'form-antecedentes-sexuales-m':
        ajaxActualizarPaciente('antecedentes_sexuales.php', formulario);
        break;
    case 'form-antecedentes-modo-vida':
        ajaxActualizarPaciente('antecedentes_modo_vida.php', formulario);
        break;
    case 'form-antecedentes-patologicos':
        ajaxActualizarPaciente('antecedentes_patologicos.php', formulario);
        break;
    case 'form-desarrollo-psicomotor':
        ajaxActualizarPaciente('desarrollo_psicomotor.php', formulario);
        break;
    }
}

/* Elimina uno o varios pacientes, seleccionados por el usuario, de la base de datos
 * Parámetros:
 * - "patientId" es un arreglo que indica el id de los pacientes a eliminar (Puede tener un solo elemento)
 * Valor de retorno:
 *   true o false de acuerdo a lo devuelto por el servidor
 */
function eliminarPacientes(patientId) {
    var result;

    $.ajax({
        async: false,
        url: basedir + '/json/paciente/eliminar.php',
        type: 'POST',
        data: {
            paciente: patientId
        },
        error: function () {
            alert('Error enviando la información');
        },
        success: function (resultado) {
            try {
                var r = JSON.parse(resultado);
                alert(r.msg);

                result = (r.flag === 1) ? true : false;

            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
    return result;
}

/* Carga los datos de un médico en el diagnóstico de un paciente según la búsqueda indicada por el usuario
 * Parámetros:
 * - "busqueda" (opcional) contiene la información para filtrar la búsqueda de pacientes
 *   + Valor por defecto: ''
 */
function cargarMedico(busqueda) {
    $.ajax({
        async: false,
        url: basedir + '/json/paciente/buscar_medico.php',
        type: 'POST',
        data: {
            busqueda: busqueda
        },
        beforeSend: function () {
            $('#form-medico .status').html('<i class="fa fa-spinner fa-spin fa-fw"></i> Buscando datos').show();
        },
        error: function () {
            alert('Error buscando los datos del médico según la búsqueda indicada');
        },
        success: function (medico) {
            try {
                $('#form-medico .status').hide();
                alert(medico);
                var datos = JSON.parse(medico);

                if (datos.flag === 1) {

                    //Carga los números telefónicos del médico tratante en sus correspondientes campos separados
                    $('input[name="tlf_contacto[]"]').each(function () {
                        $(this).val(datos.medico.tlf_contacto[$(this).index()]);
                    });
                    datos.medico.tlf_contacto = null;

                    //Carga los datos restantes del médico indicado enviados por el servidor
                    for (var i in datos.medico)
                        $('#' + i).val(datos.medico[i]);

                } else {
                    alert(datos.msg);
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

/* Agrega las filas faltantes a la tabla de tratamiento para cargar los datos recibidos del servidor si la cantidad de filas indicada está entre 2 y 8
 * que actualmente es el límite de filas permitidas
 * Parámetros:
 * - "len" es la longitud de filas que se necesitan en la tabla de tratamiento
 */
function agregarFilasTratamiento(len) {
    if (len > 1 && len < 9) {
        var cont = 0;
        var html = '<tr><td><input type="text" name="producto_farmacologico[]" required></td><td><input type="text" name="presentacion[]" required></td><td><input type="text" name="concentracion[]" required></td><td><input type="text" name="dias_aplicacion[]" required></td></tr>';

        while (cont < len - 1) {
            cont++;
            $('.tratamiento').append(html);
        }
    }
}

/* Carga todos los datos de diagnóstico del paciente indicado enviados por el servidor para que un usuario los pueda visualizar en la interfaz gráfica del sistema
 * Parámetros:
 * - "datos" es toda la información del paciente indicado enviada por el servidor
 */
function successMostrarDiagnostico(datos) {
    if (datos.flag === 1) {
        datos.paciente.edad = calcularEdad(fechaObjeto(datos.paciente.fecha_nacimiento, '-'));
        datos.paciente.fecha_nacimiento = datos.paciente.fecha_nacimiento.replace(/-/g, '/');

        //Modifica el formato con "-" por "/" de las fechas provenientes de la base de datos para el formulario de datos del diagnóstico del paciente
        if (typeof (datos.paciente.fecha_solicitud) != 'undefined') {
            datos.paciente.fecha_solicitud = datos.paciente.fecha_solicitud.replace(/-/g, '/');
            datos.paciente.fecha_primer_sintoma = datos.paciente.fecha_primer_sintoma.replace(/-/g, '/');
            datos.paciente.fecha_diagnostico = datos.paciente.fecha_diagnostico.replace(/-/g, '/');
            datos.paciente.fecha_inicio_tratamiento = datos.paciente.fecha_inicio_tratamiento.replace(/-/g, '/');
        }

        //Carga los productos farmacológicos asignados al paciente en la tabla de tratamiento
        if (typeof (datos.paciente.producto_farmacologico) != 'undefined') {
            var cont = 0;
            agregarFilasTratamiento(datos.paciente.producto_farmacologico.length);

            $('input[name="producto_farmacologico[]"]').each(function () {
                $(this).val(datos.paciente.producto_farmacologico[cont++]);
            });
            datos.paciente.producto_farmacologico = null;
        }

        //Carga la presentación de los medicamentos asignados al paciente en la tabla de tratamiento
        if (typeof (datos.paciente.presentacion) != 'undefined') {
            var cont = 0;

            $('input[name="presentacion[]"]').each(function () {
                $(this).val(datos.paciente.presentacion[cont++]);
            });
            datos.paciente.presentacion = null;
        }

        //Carga la concentración de los medicamentos asignados al paciente en la tabla de tratamiento
        if (typeof (datos.paciente.concentracion) != 'undefined') {
            var cont = 0;

            $('input[name="concentracion[]"]').each(function () {
                $(this).val(datos.paciente.concentracion[cont++]);
            });
            datos.paciente.concentracion = null;
        }

        //Carga los dias para aplicación de los medicamentos asignados al paciente en la tabla de tratamiento
        if (typeof (datos.paciente.dias_aplicacion) != 'undefined') {
            var cont = 0;

            $('input[name="dias_aplicacion[]"]').each(function () {
                $(this).val(datos.paciente.dias_aplicacion[cont++]);
            });
            datos.paciente.dias_aplicacion = null;
        }

        //Carga el número de contacto del médico tratante en sus correspondientes campos separados
        if (typeof (datos.paciente.tlf_contacto) != 'undefined') {
            $('input[name="tlf_contacto[]"]').each(function () {
                $(this).val(datos.paciente.tlf_contacto[$(this).index()]);
            });
            datos.paciente.tlf_contacto = null;
        }

        //Carga los datos restantes del paciente indicado enviados por el servidor
        for (var i in datos.paciente)
            $('#' + i).val(datos.paciente[i]);

    } else {
        alert(datos.msg);

        if (datos.flag === 0 || datos.flag === 2)
            window.location.replace(basedir + '/pacientes');
    }
}

/* Carga la información del diagnóstico de un paciente y la muestra en un formulario para que se puedan modificar
 * Parámetros:
 * - "patientId" indica el id del paciente
 */
function mostrarDiagnostico(patientId) {
    $.ajax({
        async: false,
        url: basedir + '/json/paciente/cargar_diagnostico.php',
        type: 'POST',
        data: {
            paciente: patientId
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (paciente) {
            try {
                var datos = JSON.parse(paciente);
                successMostrarDiagnostico(datos);

                $('.id_paciente').each(function () {
                    $(this).val(patientId);
                });
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

/* Actualiza en la base de datos los datos de diagnóstico de un paciente provenientes del formulario que se ha indicado
 * Parámetros:
 * - "archivoPhp" indica el archivo .php en la carpeta "json" al cual se le envían los datos del formulario para ser actualizados en la base de datos
 * - "formulario" es el nombre del formulario cuyos datos se quieren actualizar en la base de datos
 */
function ajaxActualizarDiagnostico(archivoPhp, formulario) {
    datos = $('#' + formulario).serialize();

    if (formulario === 'form-diagnostico')
        datos += '&nro_historia_clinica=' + $('#nro_historia_clinica').val();

    $.ajax({
        async: false,
        type: 'POST',
        url: basedir + '/json/paciente/actualizar/' + archivoPhp,
        data: datos,
        beforeSend: function () {
            $('#' + formulario + ' .status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando datos').show();
        },
        error: function () {
            $('#' + formulario + ' .status').html('Error cargando la información').show();
        },
        success: function (data) {
            try {
                $('#' + formulario + ' .status').hide();
                var r = JSON.parse(data);
                alert(r.msg);

            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

/* Aplica la acción correspondiente de acuerdo al formulario de datos de diagnóstico del paciente que se ha indicado para actualizar
 * Parámetros:
 * - "formulario" indica el nombre del formulario cuyos datos se quieren actualizar en la base de datos
 */
function actualizarDiagnostico(formulario) {
    if (formulario === 'form-diagnostico')
        ajaxActualizarDiagnostico('diagnostico.php', formulario);
    else if (formulario === 'form-medico')
        ajaxActualizarDiagnostico('medico_tratante.php', formulario);
}

$(document).ready(function () {
    var fechaActual = new Date();
    var url;
    $('.status').hide();

    //Controla el plugin "tooltipster" para colocar tooltips personalizados sobre tags de HTML en el módulo de pacientes
    $('.nueva-fila-tratamiento, .eliminar-fila-tratamiento, .enlace-diagnostico').tooltipster({
        theme: 'tooltipster-theme'
    });

    //Si el programa está posicionado en la búsqueda de pacientes, se carga de la base de datos la información necesaria de todos los pacientes registrados
    if (window.location.pathname === basedir + '/pacientes')
        cargarPacientes(); //Trae de la base de datos la información necesaria de todos los pacientes registrados

    //Si el programa está posicionado en el perfil de un paciente para modificar o ver sus datos, se cargan los datos de dicho paciente seleccionado
    if ((url = window.location.pathname).match(basedir + '/pacientes/modificar/[0-9]+'))
        mostrarPaciente(url.substring(url.lastIndexOf('/') + 1));

    //Si el programa está posicionado en el diagnostico de un paciente, se cargan los datos de dicho paciente seleccionado
    if ((url = window.location.pathname).match(basedir + '/pacientes/diagnostico/[0-9]+'))
        mostrarDiagnostico(url.substring(url.lastIndexOf('/') + 1));

    //Si esta en el perfil de un paciente para modificar sus datos, se cargan los datos del paciente seleccionado
    if (window.location.pathname === basedir + '/pacientes/registrar') {
        $('.antecedentes-perinatales').hide();
        $('.antecedentes-sexuales').hide();
        $('.antecedentes-modo-vida').hide();
        $('.antecedentes-patologicos').hide();
        $('.desarrollo-psicomotor').hide();
    }

    //Verifica el evento focusin de la barra de búsqueda para cambiarle el color de borde al ícono de buscar
    $('.input-buscar').focusin(function () {
        $('.icono-buscar').css({
            'background-color': '#4799B4',
            'border-bottom-color': '#4799B4'
        });
    });

    //Verifica el evento focusout de la barra de búsqueda para devolver el ícono de buscar a su color original
    $('.input-buscar').focusout(function () {
        $('.icono-buscar').css({
            'background-color': '#6FC8E5',
            'border-bottom-color': '#6FC8E5'
        });
    });

    /* Verifica que presionen la tecla "enter" para buscar pacientes o un médico según la sección en que se encuentre
     * el usuario y lo indicado en la barra de búsqueda
     */
    $('.input-buscar').keypress(function (e) {
        if (e.which == 13) {
            if ((url = window.location.pathname) === basedir + '/pacientes')
                cargarPacientes($(this).val());
            else if (url.match(basedir + '/pacientes/diagnostico/[0-9]+'))
                cargarMedico($(this).val());
        }
    });

    /* Verifica que se ejecute un click en el ícono de búsqueda para buscar pacientes o un médico según la sección en que se encuentre
     * el usuario y lo indicado en la barra de búsqueda
     */
    $('.icono-buscar').click(function () {
        if ((url = window.location.pathname) === basedir + '/pacientes')
            cargarPacientes($('.input-buscar').val());
        else if (url.match(basedir + '/pacientes/diagnostico/[0-9]+'))
            cargarMedico($('.input-buscar').val());
    });

    /* Verifica si el checkbox de búsqueda instantánea está activado en cada momento que se escriben datos en la barra de búsqueda.
     * Si es cierto, envía inmediatamente los datos en la barra en dicho momento, realiza una búsqueda y actualiza instantáneamente
     * con los pacientes encontrados, mientras el usuario está escribiendo
     */
    $('.input-buscar').on('input', function () {
        if ($('.buscar-instantaneo').is(':checked'))
            cargarPacientes($(this).val());
    });

    /* Verifica si se hace click en el botón de eliminar seleccionados y procede a confirmar la eliminación por parte del usuario.
     * Si es confirmado, procede a eliminar todos los pacientes indicados
     */
    $('.borrar-varios').click(function () {
        var confirmacion = confirm('¿Está seguro que desea eliminar los pacientes seleccionados?');

        if (confirmacion) {
            var pacientes = new Array();

            $('.busqueda table tr').each(function () {
                if ($(this).children('td').not('.icono-tabla').css('background-color') == 'rgba(18, 182, 235, 0.2)')
                    pacientes.push($(this).children('td.icono-tabla').attr('data-id'))
            });
            if (eliminarPacientes(pacientes))
                cargarPacientes(); //Refresca la lista de pacientes
        }
    });

    //Verifica cual es la acción correspondiente al formulario cuyo evento "submit" ha sido activado y aplica la acción correspondiente
    $('form').submit(function () {
        if ((url = window.location.pathname) === basedir + '/pacientes/registrar') {
            if ($(this).prop('data-enable') != 'false')
                agregarPaciente($(this).attr('id'));

        } else if (url.match(basedir + '/pacientes/modificar/[0-9]+')) {
            actualizarPaciente($(this).attr('id'));

        } else if (url.match(basedir + '/pacientes/diagnostico/[0-9]+')) {
            actualizarDiagnostico($(this).attr('id'));
        }
        return false;
    });

    //Maneja el plugin para mostrar un formato tipo calendario al momento de ingresar fechas en los formularios de registrar y modificar un paciente
    $('.calendario').datetimepicker({
        lang: 'es',
        timepicker: false,
        scrollInput: false,
        closeOnDateSelect: true,
        format: 'd/m/Y',
        formatDate: 'Y/m/d',
        minDate: '1920/01/01',
        maxDate: fechaActual.getFullYear() + '/' + fechaActual.getMonth + '/' + fechaActual.getDate(),
        yearStart: 1920,
        yearEnd: fechaActual.getFullYear()
    });

    //Calcula la edad del paciente de acuerdo a la fecha de nacimiento ingresada
    $('#datos-paciente #fecha_nacimiento').datetimepicker({
        onSelectDate: function (fechaNacimiento) {
            edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

            if (fechaNacimiento.getMonth() > fechaActual.getMonth() || (fechaNacimiento.getMonth() === fechaActual.getMonth() && fechaNacimiento.getDate() > fechaActual.getDate()))
                edad--;
        }
    });

    //Carga las ciudades por estado en los formularios de registro y modificación de un paciente desde un archivo .html con el nombre del estado indicado en la carpeta "ciudades"
    $('#estado_residencia').change(function () {
        $('#ciudad_residencia').load(basedir + '/ciudades/' + $(this).val() + '.html');
    });

    /* Verifica si se indica que se va a ingresar otra ciudad que no está en la lista de ciudades por estado, según el estado seleccionado, para
     * habilitar otro input inmediatamente por debajo del selector de ciudades, de manera que el usuario pueda indicar cual es la ciudad.
     * Si no se selecciona la opción de otro ciudad, simplemente se mantiene el selector de ciudades y no se muestra el input extra
     */
    $('#ciudad_residencia').change(function () {
        if ($(this).val() === '-OTRA-') {
            $(this).removeAttr('name');
            $(this).after('<br>');
            $('.otra_ciudad').attr('name', 'ciudad_residencia').prop('required', true).show();

        } else {
            if ($(this).attr('name') != 'ciudad_residencia') {
                $(this).siblings('br:last').remove();
                $(this).attr('name', 'ciudad_residencia');
            }
            if ($('.otra_ciudad').attr('name') === 'ciudad_residencia')
                $('.otra_ciudad').removeAttr('name').prop('required', false).hide();
        }
    });

    //Redirige a la página que contiene todos los datos del paciente indicado para que se puedan ver y editar
    $('.boton.modificar').click(function () {
        window.location.replace(basedir + '/pacientes/modificar/' + $(this).parents().find('.id_paciente').val());
    });

    //Redirige a la página que contiene todos los datos del paciente indicado para que se puedan ver y editar
    $('.enlace-diagnostico').click(function () {
        window.location.replace(basedir + '/pacientes/diagnostico/' + $('.id_paciente:first').val());
    });

    //Agrega una nueva fila a la tabla de tratamiento si no ha superado el límite de 8 filas
    $('.nueva-fila-tratamiento').click(function () {
        if ($('.tratamiento tr').length <= 8) {
            var html = '<tr><td><input type="text" name="producto_farmacologico[]" required></td><td><input type="text" name="presentacion[]" required></td><td><input type="text" name="concentracion[]" required></td><td><input type="text" name="dias_aplicacion[]" required></td></tr>';

            $('.tratamiento').append(html);
        } else {
            alert('Ha llegado al límite de filas permitidas');
        }
    });

    //Elimina la última fila de la tabla tratamiento a excepción de que la primera fila esté como última
    $('.eliminar-fila-tratamiento').click(function () {
        if ($('.tratamiento tr').length > 2) {
            $('.tratamiento tr:last').remove();
        } else {
            alert('No se puede eliminar la primera fila');
        }
    });

    //Marca o desmarcar filas de la tabla de pacientes
    $(document).on('click', '.busqueda table td', function () {
        var cont = 0;

        if ($(this).closest('tr').children('td').not('.icono-tabla').css('background-color') == 'rgba(0, 0, 0, 0)')
            $(this).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(18, 182, 235, 0.2)');
        else
            $(this).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(0,0,0,0)');

        $('.busqueda table tr').each(function () {
            if ($(this).children('td').not('.icono-tabla').css('background-color') == 'rgba(18, 182, 235, 0.2)')
                cont++;
        });

        if (cont > 1)
            $('.borrar-varios').show();
        else
            $('.borrar-varios').hide();
    });

    //Verifica la eliminación de un paciente de la base de datos. Si es aceptada, se procede a eliminar el paciente indicado
    $(document).on('click', '.pacientes tr .icono-tabla .borrar', function () {
        var confirmacion = confirm('¿Está seguro que desea eliminar este paciente?');

        if (confirmacion && eliminarPacientes([$(this).parent().attr('data-id')]))
            cargarPacientes(); //Refresca la lista de pacientes
    });

    //Redirige a la página que contiene todos los datos del paciente indicado para que se puedan ver y editar
    $(document).on('click', '.pacientes tr .icono-tabla .editar', function () {
        window.location.replace(basedir + '/pacientes/modificar/' + $(this).parent().attr('data-id'));
    });

    //Redirige a la página de diagnostico del paciente para agregar datos o ver los existentes y editar
    $(document).on('click', '.pacientes tr .icono-tabla .diagnostico', function () {
        window.location.replace(basedir + '/pacientes/diagnostico/' + $(this).parent().attr('data-id'));
    });
});