/* Habilita los formularios restantes para un paciente de acuerdo al cumplimiento o no de ciertas condiciones según la información brindada por este formulario
 * Parámetros:
 * - "id_paciente" es el id del paciente y se utiliza para cargarlo en inputs ocultos de los demas formularios del paciente
 *   para que se pueda acceder al id posteriormente
 */
function successAgregarDatosPaciente(id_paciente) {
    var fecha = new Date();
    $('.id_paciente').each(function () {
        $(this).val(id_paciente);
    });
    
    $('.antecedentes-modo-vida').show();
    $('.antecedentes-patologicos').show();
    $('.antecedentes-sexuales').show();

    //Verifica el sexo indicado de un paciente para activar el formulario de antecedentes sexuales de acuerdo a la opción seleccionada
    if ($('input:radio[name=sexo]:checked').val() == 'Masculino')
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
            $('.status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando datos').show();
        },
        error: function () {
            $('.status').html('Error guardando la información').show();
        },
        success: function (data) {
            try {
                $('.status').hide();
                var r = JSON.parse(data);

                if (r.codigo == 0) {
                    alert('Debe llenar todos los campos');
                }

                if (r.codigo == 1) {
                    $('#' + formulario + ' .boton').prop('data-enable', 'false');
                    $('#' + formulario + ' .boton').css('background-color', '#ECECEC');
                    $('#' + formulario + ' .boton').css('cursor', 'default');
                    
                    if(formulario === 'datos-paciente')
                        successAgregarDatosPaciente(r.id);

                    alert('Datos del paciente agregados exitosamente.');
                }

                if (r.codigo == 2) {
                    alert('No se pudieron agregar los datos del paciente, es posible que ya existan');
                }
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

//Trae algunos datos importantes de todos los pacientes de la base de datos
function cargarPacientes() {
    $.ajax({
        async: false,
        url: basedir + '/json/paciente/cargar_todos.php',
        error: function () {
            alert('Error cargando la información');
        },
        success: function (pacientes) {
            try {
                var datos = JSON.parse(pacientes);
                var html = '<tr><th class="icono-tabla"></th><th>Documento de Identidad</th><th>Nombres</th><th>Apellidos</th><th>Móvil</th><th>Email</th></tr>';

                if (datos.flag) {
                    for (var i in datos.paciente) {
                        html += '<tr><td class="icono-tabla" data-id="' + datos.paciente[i].id + '"><i class="fa fa-trash-o fa-2x icon borrar"></i><i class="fa fa-edit fa-2x icon editar"></i></td><td>' + datos.paciente[i].documento_identidad + '</td><td>' + datos.paciente[i].primer_nombre + ' ' + datos.paciente[i].segundo_nombre + '</td><td>' + datos.paciente[i].primer_apellido + ' ' + datos.paciente[i].segundo_apellido + '</td><td>' + datos.paciente[i].tlf_movil + '</td><td>' + datos.paciente[i].correo_electronico + '</td></tr>';
                    }

                    $('.pacientes').html(html);
                } else
                    alert('No se encontraron los datos del paciente');
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

/* Verifica la edad del paciente a modificar para activar los formularios "desarrollo psicomotor" y "antecedentes perinatales"
 * Parámetros:
 * - "fechaNacimiento" es la fecha de nacimiento del paciente
 */
function verificarEdad(fechaNacimiento) {
    var fechaActual = new Date();
    var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

    if (fechaNacimiento.getMonth() > fechaActual.getMonth() || (fechaNacimiento.getMonth() == fechaActual.getMonth() && (fechaNacimiento.getDate() + 1) > fechaActual.getDate()))
        edad--;

    if (edad > 9)
        $('.desarrollo-psicomotor').hide();

    if (edad > 18)
        $('.antecedentes-perinatales').hide();
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

                if (datos.flag) {
                    var form;
                    verificarEdad(new Date(datos.paciente.fecha_nacimiento_original));
                    datos.paciente.fecha_nacimiento = datos.paciente.fecha_nacimiento.replace(/-/g, '/');
                    $('input:radio[name=sexo][value=' + datos.paciente.sexo + ']').prop('checked', true);
                    $('#ciudad_residencia').load(basedir + '/ciudades/' + datos.paciente.estado_residencia + '.html', function () {
                        $(this).val(datos.paciente.ciudad_residencia);
                    });

                    //Verifica el sexo indicado de un paciente para activar el formulario de antecedentes sexuales de acuerdo a la opción seleccionada
                    if (datos.paciente.sexo == 'Masculino') {
                        form = '#form-antecedentes-sexuales-m ';
                        $('#form-antecedentes-sexuales-f').hide();
                    } else {
                        form = '#form-antecedentes-sexuales-f ';
                        $('#form-antecedentes-sexuales-m').hide();
                    }

                    for (var i in datos.paciente) {
                        if (datos.paciente[i] == 'f' && $('input:radio[name=' + i + ']').is('input:radio'))
                            $('input:radio[name=' + i + '][value=FALSE]').prop('checked', true);
                        else if (datos.paciente[i] == 't' && $('input:radio[name=' + i + ']').is('input:radio'))
                            $('input:radio[name=' + i + '][value=TRUE]').prop('checked', true);
                        else
                            $('#' + i).val(datos.paciente[i]);
                    }

                    for (var i in datos.antecedentes_sexuales) {
                        if (datos.antecedentes_sexuales[i] == 'f' && $(form + 'input:radio[name=' + i + ']').is('input:radio'))
                            $(form + 'input:radio[name=' + i + '][value=FALSE]').prop('checked', true);
                        else if (datos.antecedentes_sexuales[i] == 't' && $(form + 'input:radio[name=' + i + ']').is('input:radio'))
                            $(form + 'input:radio[name=' + i + '][value=TRUE]').prop('checked', true);
                        else
                            $(form + '#' + i).val(datos.antecedentes_sexuales[i]);
                    }
                } else {
                    alert('No se pudieron encontrar los datos del paciente');
                }
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
            $('.status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando datos').show();
        },
        error: function () {
            $('.status').html('Error cargando la información').show();
        },
        success: function (data) {
            try {
                $('.status').hide();
                var r = JSON.parse(data);

                if (r.codigo == 0) {
                    alert('Debe llenar todos los campos');
                }

                if (r.codigo == 1) {
                    alert('Actualización de datos exitosa');
                }

                if (r.codigo == 2) {
                    alert('No se pudieron actualizar los datos del paciente');
                }
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

//Se encarga de eliminar un paciente de la base de datos
function eliminarPaciente(patientId) {
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
                var msg = JSON.parse(resultado);

                if (msg) {
                    alert('Paciente eliminado exitosamente');
                    cargarPacientes();
                } else {
                    alert('No se pudo eliminar el paciente');
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

$(document).ready(function () {
    var fechaActual = new Date();
    var url;
    $('.status').hide();

    $('.enlace-registrar').click(function(){
        window.location.replace(basedir + '/pacientes/registrar');
    });
    
    //Si esta en el perfil de un paciente para modificar sus datos, se cargan los datos del paciente seleccionado
    if (window.location.pathname == basedir + '/pacientes/registrar') {
        $('.antecedentes-perinatales').hide();
        $('.antecedentes-sexuales').hide();
        $('.antecedentes-modo-vida').hide();
        $('.antecedentes-patologicos').hide();
        $('.desarrollo-psicomotor').hide();
    }

    //Si esta en el perfil de un paciente para modificar sus datos, se cargan los datos del paciente seleccionado
    if ((url = window.location.pathname).match(basedir + '/pacientes/modificar/[0-9]+'))
        mostrarPaciente(url.substring(url.lastIndexOf('/') + 1));

    if (window.location.pathname == basedir + '/pacientes')
        cargarPacientes(); //Trae de la base de datos la información necesaria de todos los pacientes registrados

    //Maneja el plugin para mostrar un formato tipo calendario al momento de ingresar fechas
    $('.calendario').datetimepicker({
        lang: 'es',
        timepicker: false,
        scrollInput: false,
        format: 'd/m/Y',
        formatDate: 'Y/m/d',
        minDate: '1920/01/01',
        maxDate: fechaActual.getFullYear() + '/' + fechaActual.getMonth + '/' + fechaActual.getDate(),
        yearStart: 1920,
        yearEnd: fechaActual.getFullYear()
    });

    //Calcula la edad del paciente de acuerdo a la fecha de nacimiento ingresada
    $('#datos-paciente .calendario').datetimepicker({
        onSelectDate: function (fechaNacimiento) {
            edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
            if (fechaNacimiento.getMonth() > fechaActual.getMonth() || (fechaNacimiento.getMonth() == fechaActual.getMonth() && fechaNacimiento.getDate() > fechaActual.getDate()))
                edad--;
        }
    });

    //Carga las ciudades por estado desde un archivo .txt con el nombre del estado indicado en la carpeta "ciudades"
    $('#estado_residencia').change(function () {
        $('#ciudad_residencia').load(basedir + '/ciudades/' + $(this).val() + '.html');
    });

    //Valida cuando se hace click en el botón de algún formulario y realiza la acción correspondiente al formulario 
    $('.boton').click(function () {
        if (url.match(basedir + '/pacientes/modificar/[0-9]+')) {
            var id_paciente = url.substring(url.lastIndexOf('/') + 1);
            $('.id_paciente').each(function () {
                $(this).val(id_paciente);
            });
            actualizarPaciente($(this).parents('form').attr('id'));
        } else if (url == basedir + '/pacientes/registrar') {
            if ($(this).prop('data-enable') != 'false')
                agregarPaciente($(this).parents('form').attr('id'));
        }
    });

    //Verifica la eliminación de un paciente de la base de datos. Si es aceptada, se procede a eliminar el paciente indicado
    $(document).on('click', '.pacientes tr .icono-tabla .borrar', function () {
        var confirmacion = confirm('¿Está seguro que desea eliminar este paciente?');
        if (confirmacion) {
            eliminarPaciente($(this).parent().attr('data-id'));
            cargarPacientes(); //Refresca la lista de pacientes
        }
    });

    //Redirige a la página que contiene todos los datos del paciente indicado para que se puedan ver y editar
    $(document).on('click', '.pacientes tr .icono-tabla .editar', function () {
        window.location.replace(basedir + '/pacientes/modificar/' + $(this).parent().attr('data-id'));
    });

    //Marca o desmarcar filas de la tabla
    $(document).on('click', '.busqueda table td', function (e) {
        if ($(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color') == 'rgba(0, 0, 0, 0)')
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(18, 182, 235, 0.2)');
        else
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(0,0,0,0)');
    });
});