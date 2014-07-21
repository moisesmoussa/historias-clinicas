//Se encarga de ingresar los datos de un nuevo usuario en la base de datos
function agregarUsuario() {
    $.ajax({
        async: false,
        url: basedir + '/json/insertar_usuario.php',
        type: 'POST',
        data: $('#nuevo-usuario').serialize(),
        beforeSend: function () {
            $('#status').html('Guardando datos...').show();
        },
        error: function () {
            $('#status').html('Error guardando la información').show();
        },
        success: function (data) {
            var r = JSON.parse(data);

            $('#status').hide();

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

        }
    });
}

//Trae algunos datos importantes de todos los usuarios de la base de datos
function cargar_usuarios() {
    $.ajax({
        async: false,
        url: basedir + '/json/onload_usuario.php',
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuarios) {
            var datos = JSON.parse(usuarios);
            var html = "<tr><th class='icono-tabla'></th><th>Cédula</th><th>Nombres</th><th>Apellidos</th><th>Nombre de Usuario</th><th>Móvil</th><th>Email</th></tr>";

            if (datos.flag) {
                for (var i in datos.usuario) {
                    html += "<tr><td class='icono-tabla' data-id='" + datos.usuario[i].id + "'><i class='fa fa-trash-o fa-2x icon borrar'></i><i class='fa fa-edit fa-2x icon editar'></i></td><td>" + datos.usuario[i].cedula + "</td><td>" + datos.usuario[i].primer_nombre + " " + datos.usuario[i].segundo_nombre + "</td><td>" + datos.usuario[i].primer_apellido + " " + datos.usuario[i].segundo_apellido + "</td><td>" + datos.usuario[i].nombre_usuario + "</td><td>" + datos.usuario[i].tlf_movil + "</td><td>" + datos.usuario[i].correo_electronico + "</td></tr>";
                }

                $('.usuarios').html(html);
            } else
                alert('No se encontraron los datos del usuario');
        }
    });
}

function datos_usuario(user_id) {
    $.ajax({
        async: false,
        url: basedir + '/json/cargar_usuario.php',
        type: 'POST',
        data: {
            usuario: user_id
        },
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuario) {
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
                    $('#ciudad_residencia').load(basedir + "/ciudades/" + datos.usuario.estado_residencia + ".txt", function () {
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
                } else
                    alert('No se pudo encontrar los datos del usuario');
        }
    });
}

//Actualiza los datos del perfil del usuario
function actualizar_usuario() {
    $.ajax({
        async: false,
        url: basedir + '/json/actualizar_usuario.php',
        type: 'POST',
        data: $('#act-usuario').serialize(),
        beforeSend: function () {
            $('#status').html('Cargando...').show();
        },
        error: function () {
            $('#status').html('Error cargando la información').show();
        },
        success: function (data) {
            var r = JSON.parse(data);
            
            $('#status').hide();

            if (r.codigo == 0) {
                alert('Debe llenar todos los campos');
            }

            if (r.codigo == 1) {
                alert('Actualización de usuario exitosa');
            }

            if (r.codigo == 2) {
                alert('No se pudo actualizar el usuario');
            }

        }
    });
}

//Se encarga de eliminar un usuario de la base de datos
function eliminar_usuario(user_id) {
    $.ajax({
        async: false,
        url: basedir + '/json/eliminar_usuario.php',
        type: 'POST',
        data: {
            usuario: user_id
        },
        error: function () {
            alert('Error enviando la información');
        },
        success: function (resultado) {
            var msg = JSON.parse(resultado);

            if (msg) {
                alert('Usuario eliminado exitosamente');
                cargar_usuarios();
            } else
                alert('No se pudo eliminar el usuario');
        }
    });
}

$(document).ready(function () {
    var fecha = new Date();
    var url;
    $('#status').hide();
    $('.DesarrolloPsicomotor').hide();
    $('.AntecedentesPerinatales').hide();

    //Si esta en el perfil de un usuario para modificar sus datos, se cargan los datos del usuario seleccionado
    if ((url = window.location.pathname).match(basedir + '/administrador/modificar-usuario/*'))
        datos_usuario(url.substring(url.lastIndexOf('/') + 1));
    
    //Trae de la base de datos la información necesaria de todos los usuarios registrados
    cargar_usuarios();
    
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

    $('#nuevo-paciente .calendario').datetimepicker({
        onSelectDate: function (date) {
            var edad = fecha.getFullYear() - parseInt($('#fecha_nacimiento').val().substr(06));
            if (date.getMonth() < fecha.getMonth() || (date.getMonth() == fecha.getMonth() && date.getDate() > fecha.getDate()))
                edad--;

            if (edad < 10)
                $('.DesarrolloPsicomotor').show();
            else
                $('.DesarrolloPsicomotor').hide();

            if (edad < 19)
                $('.AntecedentesPerinatales').show();
            else
                $('.AntecedentesPerinatales').hide();
        }
    });

    //Carga las ciudades por estado
    $('#estado_residencia').change(function () {
        $("#ciudad_residencia").load(basedir + "/ciudades/" + $(this).val() + ".txt");
    });

    $('.boton').click(function () {
        if ((url = window.location.pathname).match(basedir + '/administrador/modificar-usuario/*')){
            $('#id_usuario').val(url.substring(url.lastIndexOf('/') + 1));
            actualizar_usuario();
        } else{
            agregarUsuario();
        }
    });

    $('#enviar-paciente').click(function () {
        $.ajax({
            async: false,
            type: "POST",
            url: basedir + '/json/insertar_paciente.php',
            data: $("#nuevo-paciente").serialize(), // Adjuntar los campos del formulario a enviar.
            success: function (data) {
                var msg = JSON.parse(data);
                console.log(msg);
            }
        });
    });

    //Verifica la eliminación de un usuario de la base de datos. Si es aceptada, se procede a eliminar el usuario indicado
    $(document).on('click', '.usuarios tr .icono-tabla .borrar', function () {
        var confirmacion = confirm("¿Está seguro que desea eliminar este usuario?");
        if (confirmacion) {
            eliminar_usuario($(this).parent().attr('data-id'));
            cargar_usuarios();
        }
    });

    //Redirige a la página que contiene todos los datos del usuario indicado para que se puedan ver y editar
    $(document).on('click', '.usuarios tr .icono-tabla .editar', function () {
        window.location.replace(basedir + "/administrador/modificar-usuario/" + $(this).parent().attr('data-id'));
    });

    //Marca o desmarcar filas de la tabla
    $(document).on('click', '.usuarios td', function (e) {
        if ($(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color') == 'rgba(0, 0, 0, 0)')
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(18, 182, 235, 0.2)');
        else
            $(e.target).closest('tr').children('td').not('.icono-tabla').css('background-color', 'rgba(0,0,0,0)');
    });
});