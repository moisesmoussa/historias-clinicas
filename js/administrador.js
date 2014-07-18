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
                    alert('Usuario agregado exitosamente.\nCorreo con la clave enviado');
                else
                    alert('Usuario agregado exitosamente.\nNo se pudo enviar el correo con la clave');
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
        url: basedir + '/json/onload_usuario.php',
        type: 'GET',
        data: {
            usuario: user_id
        },
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
    $('#status').hide();
    $('.DesarrolloPsicomotor').hide();
    $('.AntecedentesPerinatales').hide();

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
        agregarUsuario();
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