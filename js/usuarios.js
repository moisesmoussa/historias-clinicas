//Copia todos los datos traídos de la base de datos en los campos del formulario del usuario para modificar sus datos
function cargarPerfil(usuario) {
    try {
        var datos = JSON.parse(usuario);

        if (datos.flag === 1) {
            datos.usuario.fecha_nacimiento = datos.usuario.fecha_nacimiento.replace(/-/g, '/');
            datos.usuario.fecha_ingreso = datos.usuario.fecha_ingreso.replace(/-/g, '/');
            $('#ciudad_residencia').load(basedir + '/ciudades/' + datos.usuario.estado_residencia + '.html', function () {
                $(this).val(datos.usuario.ciudad_residencia);
            });

            //Carga los números telefónicos del usuario indicado en sus correspondientes campos separados
            $('input[name="tlf_movil[]"]').each(function () {
                $(this).val(datos.usuario.tlf_movil[$(this).index()]);
            });
            $('input[name="tlf_casa[]"]').each(function () {
                $(this).val(datos.usuario.tlf_casa[$(this).index()]);
            });
            datos.usuario.tlf_movil = null;
            datos.usuario.tlf_casa = null;

            //Carga todos los datos del usuario indicado enviados por el servidor
            for (var i in datos.usuario)
                $('#' + i).val(datos.usuario[i]);

        } else {
            alert(datos.msg);

            if (datos.flag === 2)
                window.location.replace(basedir + '/usuarios');
        }
    } catch (e) {
        alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
    }
}

//Carga la información de un usuario y la muestra en un formulario para que se puedan modificar
function mostrarPerfil() {
    $.ajax({ //Trae de la base de datos todos los datos del usuario
        async: false,
        url: basedir + '/json/perfil/cargar.php',
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
        url: basedir + '/json/perfil/actualizar_clave.php',
        type: 'POST',
        data: $('#nueva-clave').serialize(),
        beforeSend: function () {
            $('.status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando datos').show();
        },
        error: function () {
            $('.status').html('Error cargando la información').show();
        },
        success: function (flag) {
            try {
                $('.status').hide();
                var datos = JSON.parse(flag);
                alert(datos.msg);

                if (datos.flag === 4) {
                    $('#nueva-clave').each(function () {
                        this.reset();
                    });
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
            $('.status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando datos').show();
        },
        error: function () {
            $('.status').html('Error guardando la información').show();
        },
        success: function (data) {
            try {
                $('.status').hide();
                var r = JSON.parse(data);
                alert(r.msg.replace('\\n', '\n'));

                if (r.flag === 2) {
                    $('#nuevo-usuario').each(function () {
                        this.reset();
                    });
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

/* Trae algunos datos importantes de todos los usuarios o de los usuarios que consiga según una búsqueda indicada en la base de datos y los
 * muestra al usuario que los solicitó en una tabla
 * Parámetros:
 * - "busqueda" contiene la información para filtrar la búsqueda de usuarios
 */
function cargarUsuarios(busqueda) {
    var archivo;

    if (typeof (busqueda) === 'undefined') {
        archivo = 'cargar_todos.php';
        busqueda = '';
    } else {
        archivo = 'buscar.php';
    }
    $.ajax({
        async: false,
        url: basedir + '/json/usuario/' + archivo,
        type: 'POST',
        data: {
            busqueda: busqueda
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuarios) {
            try {
                var datos = JSON.parse(usuarios);
                var html = '<tr><th class="icono-tabla"></th><th>Cédula</th><th>Nombres</th><th>Apellidos</th><th>Usuario</th><th>Móvil</th><th>Email</th></tr>';

                if (datos.flag === 1) {
                    for (var i in datos.usuario) {
                        html += '<tr><td class="icono-tabla" data-id="' + datos.usuario[i].id + '"><i class="fa fa-trash-o fa-2x icon borrar" title="Eliminar usuario"></i><i class="fa fa-edit fa-2x icon editar" title="Modificar usuario"></i></td><td>' + datos.usuario[i].cedula + '</td><td>' + datos.usuario[i].nombres + '</td><td>' + datos.usuario[i].apellidos + '</td><td>' + datos.usuario[i].nombre_usuario + '</td><td>' + datos.usuario[i].tlf_movil + '</td><td>' + datos.usuario[i].correo_electronico + '</td></tr>';
                    }
                    $('.usuarios').html(html);

                } else {
                    alert(datos.msg);
                }
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
            $('.status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando datos').show();
        },
        error: function () {
            $('.status').html('Error cargando la información').show();
        },
        success: function (data) {
            try {
                $('.status').hide();
                var r = JSON.parse(data);
                alert(r.msg);

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
                var r = JSON.parse(resultado);
                alert(r.msg);

                if (r.flag === 1)
                    cargarUsuarios();

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

    //Controla el plugin "tooltipster" para colocar tooltips personalizados sobre tags de HTML en el módulo de usuarios
    $('.ayuda').tooltipster({
        contentAsHTML: true,
        theme: 'tooltipster-theme'
    });

    //Si el programa está posicionado en la búsqueda de usuarios, se carga de la base de datos la información necesaria de todos los usuarios registrados
    if (window.location.pathname === basedir + '/usuarios')
        cargarUsuarios();

    //Si el programa está posicionado en el perfil de un usuario para modificar o ver sus datos, se cargan los datos de dicho usuario seleccionado
    if ((url = window.location.pathname).match(basedir + '/usuarios/modificar/[0-9]+'))
        mostrarUsuario(url.substring(url.lastIndexOf('/') + 1));

    //Se cargan los datos del usuario si está en su perfil para modificar o ver dichos datos
    if (window.location.pathname === (basedir + '/usuarios/perfil'))
        mostrarPerfil();

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

    //Verifica que presionen la tecla "enter" para buscar usuarios según lo indicado en la barra de búsqueda
    $('.input-buscar').keypress(function (e) {
        if (e.which == 13)
            cargarUsuarios($(this).val());
    });

    //Verifica que se ejecute un click en el ícono de búsqueda para buscar usuarios según lo indicado en la barra de búsqueda
    $('.icono-buscar').click(function () {
        cargarUsuarios($('.input-buscar').val());
    });

    //Verifica cual es la acción correspondiente al formulario cuyo evento "submit" ha sido activado y aplica la acción correspondiente
    $('form').submit(function () {
        if ((url = window.location.pathname) == basedir + '/usuarios/perfil') {
            actualizarUsuario('perfil/actualizar.php');
        } else if (url == basedir + '/usuarios/cambiar-clave') {
            actualizarClave();
        } else if (url.match(basedir + '/usuarios/modificar/[0-9]+')) {
            $('#id_usuario').val(url.substring(url.lastIndexOf('/') + 1));
            actualizarUsuario('usuario/actualizar.php');
        } else if (url == basedir + '/usuarios/registrar') {
            agregarUsuario();
        }
        return false;
    });

    //Maneja el plugin para mostrar un formato tipo calendario al momento de ingresar fechas en los formularios de registrar y modificar un usuario
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

    //Carga las ciudades por estado en los formularios de registro y modificación de un usuario desde un archivo .html con el nombre del estado indicado en la carpeta "ciudades"
    $('#estado_residencia').change(function () {
        $('#ciudad_residencia').load(basedir + '/ciudades/' + $(this).val() + '.html');
    });

    //Marca o desmarcar filas de la tabla de usuarios
    $(document).on('click', '.busqueda table td', function (e) {
        if ($(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color') == 'rgba(0, 0, 0, 0)')
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(18, 182, 235, 0.2)');
        else
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(0,0,0,0)');
    });

    //Verifica la eliminación de un usuario de la base de datos. Si es aceptada, se procede a eliminar el usuario indicado
    $(document).on('click', '.usuarios tr .icono-tabla .borrar', function () {
        var confirmacion = confirm('¿Está seguro que desea eliminar este usuario?');
        if (confirmacion) {
            eliminarUsuario($(this).parent().attr('data-id'));
            cargarUsuarios(); //Refresca la lista de usuarios
        }
    });

    //Redirige a la página que contiene todos los datos del usuario indicado para que se puedan visualizar y editar
    $(document).on('click', '.usuarios tr .icono-tabla .editar', function () {
        window.location.replace(basedir + '/usuarios/modificar/' + $(this).parent().attr('data-id'));
    });
});