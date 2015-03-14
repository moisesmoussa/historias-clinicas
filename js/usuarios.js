/* Copia todos los datos traídos de la base de datos en los campos del formulario del usuario para modificar sus datos
 * Parámetros:
 * - "usuario" contiene todos los datos del usuario a cargar en la interfaz gráfica
 */
function cargarPerfil(usuario) {
    try {
        var datos = JSON.parse(usuario);

        if (datos.flag === 1) {
            datos.usuario.fecha_nacimiento = datos.usuario.fecha_nacimiento.replace(/-/g, '/');
            datos.usuario.fecha_ingreso = datos.usuario.fecha_ingreso.replace(/-/g, '/');

            //Carga la ciudad registrada como dirección del usuario, ya sea que esté o no en la lista de ciudades por estado
            $.ajax({
                async: true,
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
            window.location.replace(basedir + '/usuarios');
        }
    } catch (e) {
        alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
        window.location.replace(basedir + '/usuarios');
    }
}

//Carga la información de un usuario y la muestra en un formulario para que se puedan modificar
function mostrarPerfil() {
    $.ajax({ //Trae de la base de datos todos los datos del usuario
        async: true,
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
        async: true,
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
        async: true,
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
                alert(r.msg.replace(/\\n/g, '\n'));

                if (r.flag === 1) {
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

/* Muestra los usuarios encontrados según los parámetros indicados por el usuario con sesión iniciada en el sistema.
 * Se incluye todo el proceso de paginación para indicar la página correspondiente de la lista de usuarios
 * en la cual se obtuvieron los resultados
 * Parámetros:
 * - "usuarios" lista de usuarios
 * - "activePage" (Opcional) número de página actual
 *   + Valor por defecto: 1
 */
function mostrarUsuariosObtenidos(usuarios, activePage) {
    try {
        var datos = JSON.parse(usuarios),
            totalPages = datos.countPages,
            pageBarSize = (totalPages <= 6) ? totalPages : 5,
            paginationHtml = '',
            nextButtonHtml = '',
            tableHtml = '<tr><th class="icono-tabla"></th><th class="th-field">Cédula</th><th class="th-field">Nombres</th><th class="th-field">Apellidos</th><th class="th-field">Usuario</th><th class="th-field">Móvil</th><th class="th-field">Email</th></tr>';

        if (typeof (activePage) === 'undefined')
            activePage = 1;

        if (totalPages === 1) {
            paginationHtml += '<li class="previous page-disable"><a href="javascript:void(0);"><span><i class="fa fa-chevron-left fa-fw"></i>Previo</span></a></li>';
            nextButtonHtml += '<li class="next page-disable"><a href="javascript:void(0);"><span>Siguiente<i class="fa fa-chevron-right fa-fw"></i></span></a></li>';

        } else if (activePage === 1) {
            paginationHtml += '<li class="previous page-disable"><a href="javascript:void(0);"><span><i class="fa fa-chevron-left fa-fw"></i>Previo</span></a></li>';
            nextButtonHtml += '<li class="next"><a href="javascript:void(0);"><span>Siguiente<i class="fa fa-chevron-right fa-fw"></i></span></a></li>';

        } else if (activePage === totalPages) {
            paginationHtml += '<li class="previous"><a href="javascript:void(0);"><span><i class="fa fa-chevron-left fa-fw"></i>Previo</span></a></li>';
            nextButtonHtml += '<li class="next page-disable"><a href="javascript:void(0);"><span>Siguiente<i class="fa fa-chevron-right fa-fw"></i></span></a></li>';

        } else {
            paginationHtml += '<li class="previous"><a href="javascript:void(0);"><span><i class="fa fa-chevron-left fa-fw"></i>Previo</span></a></li>';
            nextButtonHtml += '<li class="next"><a href="javascript:void(0);"><span>Siguiente<i class="fa fa-chevron-right fa-fw"></i></span></a></li>';
        }
        var startPage,
            pageNumber,
            flag = (activePage - 1) > 3,
            pagesToEnd = totalPages - activePage;

        if (flag && totalPages > 6) {
            paginationHtml += '<li><a href="javascript:void(0);">1</a></li><li><a href="javascript:void(0);">...</a></li>';

            if (pagesToEnd === 0) {
                startPage = activePage - 4;
            } else if (pagesToEnd === 1) {
                startPage = activePage - 3;
            } else if (pagesToEnd > 1) {
                startPage = activePage - 2;
            }
        } else {
            startPage = 1;
        }

        for (var i = 0; i < pageBarSize; i++) {
            pageNumber = startPage + i;

            if (pageNumber === activePage) {
                paginationHtml += '<li class="page-active"><a href="javascript:void(0);">' + pageNumber.toString() + '</a></li>';
            } else {
                paginationHtml += '<li><a href="javascript:void(0);">' + pageNumber.toString() + '</a></li>';
            }
        }

        if (totalPages > 6) {
            if (pagesToEnd === 3 && !flag) {
                paginationHtml += '<li><a href="javascript:void(0);">' + (totalPages - 1).toString() + '</a></li><li><a href="javascript:void(0);">' + totalPages + '</a></li>';
            } else if (pagesToEnd === 3) {
                paginationHtml += '<li><a href="javascript:void(0);">' + totalPages + '</a></li>';
            } else if (pagesToEnd > 3) {
                paginationHtml += '<li><a href="javascript:void(0);">...</a></li><li><a href="javascript:void(0);">' + totalPages + '</a></li>';
            }
        }

        var startFrom = datos.offset + 1,
            show = parseInt(datos.show),
            endAt = datos.offset,
            totalResults = datos.totalResults,
            showLabel = '';

        if (datos.show === 'ALL' || totalResults < show || activePage === totalPages) {
            endAt = totalResults;
        } else if (startFrom === totalResults) {
            endAt = startFrom;
        } else {
            endAt += show;
        }
        showLabel = '<i class="fa fa-file-text-o fa-fw"></i>Mostrando ' + startFrom + ' - ' + endAt + ' de ' + datos.totalResults + ' usuarios'
        paginationHtml += nextButtonHtml;
        $('.showing').html(showLabel);
        $('.pagination').html(paginationHtml);

        if (datos.flag === 1) {
            for (var i in datos.usuario) {
                tableHtml += '<tr><td class="icono-tabla" data-id="' + datos.usuario[i].id + '"><i class="fa fa-trash-o fa-2x icon borrar" title="Eliminar usuario"></i><i class="fa fa-edit fa-2x icon editar" title="Modificar usuario"></i></td><td>' + datos.usuario[i].cedula + '</td><td>' + datos.usuario[i].nombres + '</td><td>' + datos.usuario[i].apellidos + '</td><td>' + datos.usuario[i].nombre_usuario + '</td><td>' + datos.usuario[i].tlf_movil + '</td><td>' + datos.usuario[i].correo_electronico + '</td></tr>';
            }
            $('.usuarios').html(tableHtml);

        } else {
            alert(datos.msg);
        }
    } catch (e) {
        alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
    }
}

/* Trae algunos datos importantes de todos los usuarios o de los usuarios que consiga según una búsqueda indicada en la base de datos y los
 * muestra al usuario que los solicitó en una tabla. Los resultados se muestran según el orden y la cantidad de resultados
 * que quiera obtener el usuario
 * Parámetros:
 * - "activePage" (Opcional) número de página actual
 *   + Valor por defecto: 1
 */
function cargarUsuarios(activePage) {
    var archivo,
        offset,
        search = $('.input-buscar').val().trim(),
        show = $('.show').val(),
        option = $('.order-by').val().split('-'),
        order = {
            field: option[0],
            type: option[1]
        };
    $('.borrar-varios').hide();

    if (typeof (activePage) === 'undefined')
        activePage = 1;

    if (!search) {
        archivo = 'cargar_todos.php';
    } else {
        archivo = 'buscar.php';
    }
    offset = (show === 'ALL') ? '' : parseInt(show) * (activePage - 1);

    $.ajax({
        async: true,
        url: basedir + '/json/usuario/' + archivo,
        type: 'POST',
        data: {
            busqueda: search,
            order: order,
            show: show,
            offset: offset
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuarios) {
            mostrarUsuariosObtenidos(usuarios, activePage);
        }
    });
}

/* 
 * Trae algunos datos importantes de los usuarios registrados en el sistema de acuerdo a la configuración de búsqueda por defecto.
 * Esta configuración incluye los siguientes valores:
 * - Orden de los resultados: Por cédula de menor a mayor (Ascendente)
 * - Cantidad de resultados mostrados: 10 por página
 * - Cantidad de resultados que hay que saltar: 0
 */
function cargarUsuariosPorDefecto() {
    $.ajax({
        async: true,
        url: basedir + '/json/usuario/cargar_todos.php',
        type: 'POST',
        data: {
            order: '',
            show: '',
            offset: ''
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuarios) {
            mostrarUsuariosObtenidos(usuarios);
        }
    });
}

/* Carga la información de un usuario y la muestra en un formulario para que se puedan modificar
 * Parámetros:
 * - "userId" indica el id del usuario
 */
function mostrarUsuario(userId) {
    $.ajax({
        async: true,
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

/* Actualiza los datos del perfil de un usuario indicado
 * Parámetros:
 * - "archivoPhp" indica el archivo hacia el cual se dirige, con ajax, la acción en el servidor
 */
function actualizarUsuario(archivoPhp) {
    $.ajax({
        async: true,
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

                if (r.flag === 1)
                    $('.perfil').html(r.usuario);

            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

/* Elimina uno o varios usuarios, seleccionados por el usuario con sesión iniciada en el sistema, de la base de datos
 * Parámetros:
 * - "userId" es un arreglo que indica el id de los usuarios a eliminar (Puede tener un solo elemento)
 * Valor de retorno: (boolean) usuarios eliminados o no
 */
function eliminarUsuarios(userId) {
    var result;

    $.ajax({
        async: true,
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

                result = (r.flag === 1) ? true : false;

            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
    return result;
}

/* Esta función se encarga de determinar cual es la página actual de la lista de usuarios obtenida
 * Valor de retorno: (int) página actual
 */
function getActivePage() {
    var activePage;

    $('.pagination li').each(function () {
        var currentPage = $(this).children('a').text();

        if ($(this).hasClass('page-active')) {
            activePage = parseInt(currentPage);
            return false;
        }
    });
    return activePage;
}

/* Esta función se encarga de determinar cual es la cantidad de páginas que posee la lista de usuarios obtenida
 * Valor de retorno: (int) cantidad de páginas
 */
function getNumberPages() {
    var pages = [];

    $('.pagination li').each(function () {
        var currentPage = $(this).children('a').text();

        if (currentPage != 'Previo' && currentPage != 'Siguiente' && currentPage != '...')
            pages.push(currentPage);
    });
    return parseInt(pages[pages.length - 1]);
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
        cargarUsuariosPorDefecto();

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
            cargarUsuarios();
    });

    //Verifica que se ejecute un click en el ícono de búsqueda para buscar usuarios según lo indicado en la barra de búsqueda
    $('.icono-buscar').click(function () {
        cargarUsuarios();
    });

    /* Verifica si el checkbox de búsqueda instantánea está activado en cada momento que se escriben datos en la barra de búsqueda.
     * Si es cierto, envía inmediatamente los datos en la barra en dicho momento, realiza una búsqueda y actualiza instantáneamente
     * con los usuarios encontrados, mientras el usuario está escribiendo
     */
    $('.input-buscar').on('input', function () {
        var input = $(this).val();

        if (input.charAt(0) === ' ' || (input.charAt(input.length - 2) === ' ' && input.charAt(input.length - 1) === ' '))
            $(this).val(input.trim());

        if ($('.buscar-instantaneo').is(':checked'))
            cargarUsuarios();
    });

    /* Verifica el campo select "Ordenar por" cada vez que cambia, para ordenar ascendente o descendentemente 
     * las filas de dicha tabla utilizando el campo indicado por el usuario
     */
    $('.order-by').change(function () {
        cargarUsuarios();
    });

    /* Verifica el campo select "Mostrar" cada vez que cambia, para mostrar la cantidad de filas
     * que indique el usuario a través de este campo en el resultado
     */
    $('.show').change(function () {
        cargarUsuarios();
    });

    /* Verifica si se hace click en el botón de eliminar seleccionados y procede a confirmar la eliminación por parte del usuario.
     * Si es confirmado, procede a eliminar todos los usuarios indicados
     */
    $('.borrar-varios').click(function () {
        var confirmacion = confirm('¿Está seguro que desea eliminar los usuarios seleccionados?');

        if (confirmacion) {
            var usuarios = [];

            $('.busqueda table tr').each(function () {
                if ($(this).children('td').not('.icono-tabla').css('background-color') == 'rgba(18, 182, 235, 0.2)')
                    usuarios.push($(this).children('td.icono-tabla').attr('data-id'))
            });
            if (eliminarUsuarios(usuarios))
                cargarUsuarios(); //Refresca la lista de usuarios
        }
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

    /* Evento que se activa cuando el usuario hace click en el botón "Previo" para luego mostrar a dicho usuario
     * la página anterior de resultados de la lista de usuarios si está disponible
     */
    $(document).on('click', '.previous', function () {
        var activePage = getActivePage();

        if (activePage > 1)
            cargarUsuarios(activePage - 1);
    });

    /* Evento que se activa cuando el usuario hace click en el botón "Siguiente" para luego mostrar a dicho usuario
     * la página siguiente de resultados de la lista de usuarios si está disponible
     */
    $(document).on('click', '.next', function () {
        var activePage = getActivePage(),
            countPages = getNumberPages();

        if (activePage < countPages)
            cargarUsuarios(activePage + 1);
    });

    /* Evento que se activa cuando el usuario hace click en alguna de los números de página de la barra de paginación
     * para luego mostrar a dicho usuario la página de resultados que él está indicando de la lista de usuarios
     */
    $(document).on('click', '.pagination li', function () {
        var clickPage = $(this).text();

        if (getActivePage() != clickPage && clickPage !== 'Previo' && clickPage !== 'Siguiente' && clickPage !== '...')
            cargarUsuarios(parseInt(clickPage));
    });

    //Marca o desmarcar filas de la tabla de usuarios
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

    //Verifica la eliminación de un usuario de la base de datos. Si es aceptada, se procede a eliminar el usuario indicado
    $(document).on('click', '.usuarios tr .icono-tabla .borrar', function () {
        var confirmacion = confirm('¿Está seguro que desea eliminar este usuario?');

        if (confirmacion && eliminarUsuarios([$(this).parent().attr('data-id')]))
            cargarUsuarios(); //Refresca la lista de usuarios
    });

    //Redirige a la página que contiene todos los datos del usuario indicado para que se puedan visualizar y editar
    $(document).on('click', '.usuarios tr .icono-tabla .editar', function () {
        window.location.replace(basedir + '/usuarios/modificar/' + $(this).parent().attr('data-id'));
    });
});