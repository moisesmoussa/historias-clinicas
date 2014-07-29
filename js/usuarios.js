function cargarPerfil(usuario) {
    try {
        var datos = JSON.parse(usuario);

        if (datos.flag) {
            datos.usuario.fecha_nacimiento = datos.usuario.fecha_nacimiento.replace(/-/g, '/');
            datos.usuario.fecha_ingreso = datos.usuario.fecha_ingreso.replace(/-/g, '/');
            $('#ciudad_residencia').load(basedir + '/ciudades/' + datos.usuario.estado_residencia + '.txt', function () {
                $(this).val(datos.usuario.ciudad_residencia);
            });

            for (var i in datos.usuario)
                $('#' + i).val(datos.usuario[i]);

        } else {
            alert('No se pudieron encontrar los datos del usuario');
        }
    } catch (e) {
        alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
    }
}

//Carga la información de un usuario y la muestra en un formulario para que se puedan modificar
function mostrarPerfil() {
    $.ajax({ //Trae de la base de datos todos los datos del usuario
        async: false,
        url: basedir + '/json/onload_perfil.php',
        error: function () {
            $('.status').html('Error cargando la información').show();
        },
        success: function (usuario) {
            cargarPerfil(usuario);
        }
    });
}

//Actualiza la clave de un usuario en la base de datos
function actualizarClave() {
    $.ajax({
        async: false,
        url: basedir + '/json/clave_perfil.php',
        type: 'POST',
        data: $('#nueva-clave').serialize(),
        error: function () {
            $('.status').html('Error cargando la información').show();
        },
        success: function (flag) {
            try {
                $('.status').hide();
                var datos = JSON.parse(flag);

                switch (datos.flag) {
                case 0:
                    alert('La contraseña nueva no coincide');
                    break;
                case 1:
                    alert('Error en la base de datos');
                    break;
                case 2:
                    alert('Error con la contraseña actual');
                    break;
                case 3:
                    alert('No se pudo cambiar la contraseña');
                    break;
                case 4:
                    alert('Cambio de contraseña exitoso');
                    $('#nueva-clave').each(function () {
                        this.reset();
                    });
                    break;
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

//Se encarga de ingresar los datos de un nuevo usuario en la base de datos
function agregarUsuario() {
    $.ajax({
        async: false,
        url: basedir + '/json/usuario/insertar.php',
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
        url: basedir + '/json/usuario/cargar_todos.php',
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
        url: basedir + '/json/usuario/cargar.php',
        type: 'POST',
        data: {
            usuario: userId
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuario) {
            cargarPerfil(usuario);
        }
    });
}

//Actualiza los datos del perfil del usuario
function actualizarUsuario(archivoPhp) {
    $.ajax({
        async: false,
        url: basedir + '/json/' + archivoPhp,
        type: 'POST',
        data: $('#actualizar-usuario').serialize(),
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
        url: basedir + '/json/usuario/eliminar.php',
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

$(document).ready(function () {
    var fechaActual = new Date();
    var url;
    $('.status').hide();

    if (window.location.pathname == (basedir + '/usuarios/perfil'))
        mostrarPerfil();

    //Si esta en el perfil de un usuario para modificar sus datos, se cargan los datos del usuario seleccionado
    if ((url = window.location.pathname).match(basedir + '/usuarios/modificar/[0-9]+'))
        mostrarUsuario(url.substring(url.lastIndexOf('/') + 1));

    if (window.location.pathname == basedir + '/usuarios')
        cargarUsuarios(); //Trae de la base de datos la información necesaria de todos los usuarios registrados

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

    //Carga las ciudades por estado desde un archivo .txt con el nombre del estado indicado en la carpeta "ciudades"
    $('#estado_residencia').change(function () {
        $('#ciudad_residencia').load(basedir + '/ciudades/' + $(this).val() + '.txt');
    });

    //Valida cuando se hace click en el botón de algún formulario y realiza la acción correspondiente al formulario 
    $('.boton').click(function () {
        if ((url = window.location.pathname) == basedir + '/usuarios/perfil') {
            actualizarUsuario('actualizar_perfil.php');
        } else if (url == basedir + '/usuarios/cambiar-clave') {
            actualizarClave();
        } else if (url.match(basedir + '/usuarios/modificar/[0-9]+')) {
            $('#id_usuario').val(url.substring(url.lastIndexOf('/') + 1));
            actualizarUsuario('usuario/actualizar.php');
        } else if (url == basedir + '/usuarios/registrar') {
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

    //Redirige a la página que contiene todos los datos del usuario indicado para que se puedan ver y editar
    $(document).on('click', '.usuarios tr .icono-tabla .editar', function () {
        window.location.replace(basedir + '/usuarios/modificar/' + $(this).parent().attr('data-id'));
    });

    //Marca o desmarcar filas de la tabla
    $(document).on('click', '.busqueda table td', function (e) {
        if ($(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color') == 'rgba(0, 0, 0, 0)')
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(18, 182, 235, 0.2)');
        else
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(0,0,0,0)');
    });
});