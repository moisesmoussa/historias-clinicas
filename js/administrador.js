//Se encarga de ingresar los datos de un nuevo usuario en la base de datos
function agregarUsuario() {
    $.ajax({
        async: false,
        url: basedir + '/json/insertar_usuario.php',
        type: 'POST',
        data: $('#nuevo-usuario').serialize(),
        beforeSend: function () {
            $('.status').html('Guardando datos...').show();
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
                    alert('Las contraseñas no coinciden');
                }

                if (r.codigo == 2) {
                    $('#nuevo-usuario').each(function () {
                        this.reset();
                    });
                    if (r.correo)
                        alert('Usuario agregado exitosamente.\nCorreo con los datos de la cuenta enviado');
                    else
                        alert('Usuario agregado exitosamente.\nNo se pudo enviar el correo con los datos de la cuenta');
                }

                if (r.codigo == 3) {
                    alert('No se pudo agregar el usuario, es posible que ya exista');
                }

                if (r.codigo == 4) {
                    alert('El nombre de usuario indicado ya existe');
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

//Trae algunos datos importantes de todos los usuarios de la base de datos
function cargarUsuarios() {
    $.ajax({
        async: false,
        url: basedir + '/json/onload_usuario.php',
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuarios) {
            try {
                var datos = JSON.parse(usuarios);
                var html = '<tr><th class="icono-tabla"></th><th>Cédula</th><th>Nombres</th><th>Apellidos</th><th>Nombre de Usuario</th><th>Móvil</th><th>Email</th></tr>';

                if (datos.flag) {
                    for (var i in datos.usuario) {
                        html += '<tr><td class="icono-tabla" data-id="' + datos.usuario[i].id + '"><i class="fa fa-trash-o fa-2x icon borrar"></i><i class="fa fa-edit fa-2x icon editar"></i></td><td>' + datos.usuario[i].cedula + '</td><td>' + datos.usuario[i].primer_nombre + ' ' + datos.usuario[i].segundo_nombre + '</td><td>' + datos.usuario[i].primer_apellido + ' ' + datos.usuario[i].segundo_apellido + '</td><td>' + datos.usuario[i].nombre_usuario + '</td><td>' + datos.usuario[i].tlf_movil + '</td><td>' + datos.usuario[i].correo_electronico + '</td></tr>';
                    }

                    $('.usuarios').html(html);
                } else
                    alert('No se encontraron los datos del usuario');
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

/* Carga la información de un usuario y la muestra en un formulario para que se puedan modificar
 * Parámetros:
 * - "userId" indica el id del usuario
 */
function mostrarUsuario(userId) {
    $.ajax({
        async: false,
        url: basedir + '/json/cargar_usuario.php',
        type: 'POST',
        data: {
            usuario: userId
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuario) {
            try {
                var datos = JSON.parse(usuario);

                if (datos.flag) {
                    $('#nombre_usuario').val(datos.usuario.nombre_usuario);
                    $('#tipo_usuario').val(datos.usuario.tipo_usuario);
                    $('#primer_nombre').val(datos.usuario.primer_nombre);
                    $('#segundo_nombre').val(datos.usuario.segundo_nombre);
                    $('#primer_apellido').val(datos.usuario.primer_apellido);
                    $('#segundo_apellido').val(datos.usuario.segundo_apellido);
                    $('#fecha_nacimiento').val(datos.usuario.fecha_nacimiento.replace(/-/g, '/'));
                    $('#lugar_nacimiento').val(datos.usuario.lugar_nacimiento);
                    $('#cedula').val(datos.usuario.cedula);
                    $('#estado_residencia').val(datos.usuario.estado_residencia);
                    $('#ciudad_residencia').load(basedir + '/ciudades/' + datos.usuario.estado_residencia + '.txt', function () {
                        $(this).val(datos.usuario.ciudad_residencia);
                    });
                    $('#direccion').val(datos.usuario.direccion);
                    $('#codigo_postal').val(datos.usuario.codigo_postal);
                    $('#lugar_trabajo').val(datos.usuario.lugar_trabajo);
                    $('#tlf_movil').val(datos.usuario.tlf_movil);
                    $('#tlf_casa').val(datos.usuario.tlf_casa);
                    $('#correo_electronico').val(datos.usuario.correo_electronico);
                    $('#correo_alternativo').val(datos.usuario.correo_alternativo);
                    $('#especialidad').val(datos.usuario.especialidad);
                    $('#fecha_ingreso').val(datos.usuario.fecha_ingreso.replace(/-/g, '/'));
                } else {
                    alert('No se pudo encontrar los datos del usuario');
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

//Actualiza los datos del perfil del usuario
function actualizarUsuario() {
    $.ajax({
        async: false,
        url: basedir + '/json/actualizar_usuario.php',
        type: 'POST',
        data: $('#act-usuario').serialize(),
        beforeSend: function () {
            $('.status').html('Cargando...').show();
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
                    alert('Actualización de usuario exitosa');
                }

                if (r.codigo == 2) {
                    alert('No se pudo actualizar el usuario');
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

//Se encarga de eliminar un usuario de la base de datos
function eliminarUsuario(userId) {
    $.ajax({
        async: false,
        url: basedir + '/json/eliminar_usuario.php',
        type: 'POST',
        data: {
            usuario: userId
        },
        error: function () {
            alert('Error enviando la información');
        },
        success: function (resultado) {
            try {
                var msg = JSON.parse(resultado);

                if (msg) {
                    alert('Usuario eliminado exitosamente');
                    cargarUsuarios();
                } else {
                    alert('No se pudo eliminar el usuario');
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

/* Se encarga de insertar en la base de datos los datos del paciente provenientes del formulario que se ha indicado
 * Parámetros:
 * - "archivoPhp" indica el archivo .php en la carpeta "json" al cual se le envían los datos del formulario para ser insertados en la base de datos
 * - "formulario" es el nombre del formulario cuyos datos se quieren guardar en la base de datos
 */
function ajaxInsertarPaciente(archivoPhp, formulario) {
    $.ajax({
        async: false,
        type: 'POST',
        url: basedir + '/json/' + archivoPhp,
        data: $('#' + formulario).serialize(), // Adjuntar los campos del formulario a enviar.
        beforeSend: function () {
            $('.status').html('Guardando datos...').show();
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

/* Inserta en la base de datos los datos personales, de contacto y dirección del paciente y posteriormente habilita los formularios restantes para un paciente de acuerdo
 * al cumplimiento o no de ciertas condiciones según la información brindada por este formulario
 * Parámetros:
 * - "formulario" indica el nombre del formulario cuyos datos se quiere almacenar en la base de datos
 */
function ajaxInsertarDatosPaciente(formulario){
    $.ajax({
        async: false,
        type: 'POST',
        url: basedir + '/json/insertar_datos_paciente.php',
        data: $('#datos-paciente').serialize(), // Adjuntar los campos del formulario a enviar.
        beforeSend: function () {
            $('.status').html('Guardando datos...').show();
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
                    var fecha = new Date();
                    $('.id_paciente').each(function () {
                        $(this).val(r.id);
                    });
                    $('#' + formulario + ' .boton').prop('data-enable', 'false');
                    $('#' + formulario + ' .boton').css('background-color', '#ECECEC');
                    $('#' + formulario + ' .boton').css('cursor', 'default');
                    $('.antecedentes-modo-vida').show();
                    $('.antecedentes-patologicos').show();
                    $('.antecedentes-sexuales').show();

                    //Verifica el sexo indicado de un paciente para activar el formulario de antecedentes sexuales de acuerdo a la opción seleccionada
                    if ($('input:radio[name=sexo]').val() == 'Masculino')
                        $('#form-antecedentes-sexuales-f').hide();
                    else
                        $('#form-antecedentes-sexuales-m').hide();

                    //Verifica la edad del paciente a registrar para activar los formularios "desarrollo psicomotor" y "antecedentes perinatales"
                    if (edad < 10)
                        $('.desarrollo-psicomotor').show();

                    if (edad < 19)
                        $('.antecedentes-perinatales').show();

                    alert('Paciente agregado exitosamente.');
                }

                if (r.codigo == 2) {
                    alert('No se pudo agregar el paciente, es posible que ya exista');
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
        break;
    case 'form-antecedentes-perinatales':
        ajaxInsertarPaciente('insertar_antecedentes_perinatales.php', formulario);
        break;
    case 'form-antecedentes-sexuales-f':
        ajaxInsertarPaciente('insertar_antecedentes_sexuales.php', formulario);
        break;
    case 'form-antecedentes-sexuales-m':
        ajaxInsertarPaciente('insertar_antecedentes_sexuales.php', formulario);
        break;
    case 'form-antecedentes-modo-vida':
        ajaxInsertarPaciente('insertar_antecedentes_modo_vida.php', formulario);
        break;
    case 'form-antecedentes-patologicos':
        ajaxInsertarPaciente('insertar_antecedentes_patologicos.php', formulario);
        break;
    case 'form-desarrollo-psicomotor':
        ajaxInsertarPaciente('insertar_desarrollo_psicomotor.php', formulario);
        break;
    }
}

//Trae algunos datos importantes de todos los pacientes de la base de datos
function cargarPacientes() {
    $.ajax({
        async: false,
        url: basedir + '/json/onload_paciente.php',
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

//Se encarga de eliminar un usuario de la base de datos
function eliminarPaciente(patientId) {
    $.ajax({
        async: false,
        url: basedir + '/json/eliminar_paciente.php',
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
                    cargarUsuarios();
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
    var fecha = new Date();
    var url;
    $('.status').hide();
    $('.antecedentes-perinatales').hide();
    $('.antecedentes-sexuales').hide();
    $('.antecedentes-modo-vida').hide();
    $('.antecedentes-patologicos').hide();
    $('.desarrollo-psicomotor').hide();

    //Si esta en el perfil de un usuario para modificar sus datos, se cargan los datos del usuario seleccionado
    if ((url = window.location.pathname).match(basedir + '/administrador/modificar-usuario/*'))
        mostrarUsuario(url.substring(url.lastIndexOf('/') + 1));

    if (window.location.pathname == basedir + '/administrador/usuario')
        cargarUsuarios(); //Trae de la base de datos la información necesaria de todos los usuarios registrados

    if (window.location.pathname == basedir + '/administrador/pacientes')
        cargarPacientes(); //Trae de la base de datos la información necesaria de todos los pacientes registrados
    
    //Maneja el plugin para mostrar un formato tipo calendario al momento de ingresar fechas
    $('.calendario').datetimepicker({
        lang: 'es',
        timepicker: false,
        scrollInput: false,
        format: 'd/m/Y',
        formatDate: 'Y/m/d',
        minDate: '1920/01/01',
        maxDate: fecha.getFullYear() + '/' + fecha.getMonth + '/' + fecha.getDate(),
        yearStart: 1920,
        yearEnd: fecha.getFullYear()
    });

    //Calcula la edad del paciente de acuerdo a la fecha de nacimiento ingresada
    $('#datos-paciente .calendario').datetimepicker({
        onSelectDate: function (date) {
            edad = fecha.getFullYear() - parseInt($('#fecha_nacimiento').val().substr(06));
            if (date.getMonth() < fecha.getMonth() || (date.getMonth() == fecha.getMonth() && date.getDate() > fecha.getDate()))
                edad--;
        }
    });

    //Carga las ciudades por estado desde un archivo .txt con el nombre del estado indicado en la carpeta "ciudades"
    $('#estado_residencia').change(function () {
        $('#ciudad_residencia').load(basedir + '/ciudades/' + $(this).val() + '.txt');
    });

    //Valida cuando se hace click en el botón de algún formulario y realiza la acción correspondiente al formulario 
    $('.boton').click(function () {
        if ((url = window.location.pathname).match(basedir + '/administrador/modificar-usuario/*')) {
            $('#id_usuario').val(url.substring(url.lastIndexOf('/') + 1));
            actualizarUsuario();
        } else if (url == basedir + '/administrador/registrar-paciente') {
            if ($(this).prop('data-enable') != 'false')
                agregarPaciente($(this).parents('form').attr('id'));
        } else {
            agregarUsuario();
        }
    });

    //Verifica la eliminación de un usuario de la base de datos. Si es aceptada, se procede a eliminar el usuario indicado
    $(document).on('click', '.usuarios tr .icono-tabla .borrar', function () {
        var confirmacion = confirm('¿Está seguro que desea eliminar este usuario?');
        if (confirmacion) {
            eliminarUsuario($(this).parent().attr('data-id'));
            cargarUsuarios(); //Refresca la lista de usuarios
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

    //Redirige a la página que contiene todos los datos del usuario indicado para que se puedan ver y editar
    $(document).on('click', '.usuarios tr .icono-tabla .editar', function () {
        window.location.replace(basedir + '/administrador/modificar-usuario/' + $(this).parent().attr('data-id'));
    });

    //Redirige a la página que contiene todos los datos del paciente indicado para que se puedan ver y editar
    $(document).on('click', '.pacientes tr .icono-tabla .editar', function () {
        window.location.replace(basedir + '/administrador/modificar-paciente/' + $(this).parent().attr('data-id'));
    });
    
    //Marca o desmarcar filas de la tabla
    $(document).on('click', '.busqueda table td', function (e) {
        if ($(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color') == 'rgba(0, 0, 0, 0)')
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(18, 182, 235, 0.2)');
        else
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(0,0,0,0)');
    });
});