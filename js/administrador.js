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
                alert('Usuario agregado exitosamente');
            }

            if (r.codigo == 3) {
                alert('No se pudo agregar el usuario, es posible que ya exista');
            }

        }
    });
}

function cargar_usuarios() {
    $.ajax({
        async: false,
        url: basedir + '/json/onload_usuario.php',
        error: function () {
            alert('Error cargando la información');
        },
        success: function (usuarios) {
            var datos = JSON.parse(usuarios);
            var html = "<tr><th class='icono-tabla'></th><th>Nombre</th><th>Cédula</th><th>Fecha de Nacimiento</th><th>Lugar de Nacimiento</th><th>Fecha de Ingreso</th><th>Especialidad</th><th>Nombre de Usuario</th><th>Estado</th><th>Ciudad</th><th>Dirección</th><th>Código Postal</th><th>Lugar de Trabajo</th><th>Móvil</th><th>Tlf de Casa</th><th>Email</th></tr>";

            if (datos.flag) {
                for (var i in datos.usuario) {
                    html += "<tr><td class='icono-tabla' data-id='" + datos.usuario[i].id + "'><i class='fa fa-trash-o fa-2x icon'></i></td><td>" + datos.usuario[i].primer_nombre + " " + datos.usuario[i].segundo_nombre + " " + datos.usuario[i].primer_apellido + " " + datos.usuario[i].segundo_apellido + "</td><td>" + datos.usuario[i].cedula + "</td><td>" + datos.usuario[i].fecha_nacimiento + "</td><td>" + datos.usuario[i].lugar_nacimiento + "</td><td>" + datos.usuario[i].fecha_ingreso + "</td><td>" + datos.usuario[i].especialidad + "</td><td>" + datos.usuario[i].nombre_usuario + "</td><td>" + datos.usuario[i].estado_residencia + "</td><td>" + datos.usuario[i].ciudad_residencia + "</td><td>" + datos.usuario[i].direccion + "</td><td>" + datos.usuario[i].codigo_postal + "</td><td>" + datos.usuario[i].lugar_trabajo + "</td><td>" + datos.usuario[i].tlf_movil + "</td><td>" + datos.usuario[i].tlf_casa + "</td><td>" + datos.usuario[i].correo_electronico + "</td></tr>";
                }

                $('#usuarios').html(html);
            } else
                alert('No se encontraron los datos del usuario');
        }
    });
}

function eliminar_usuario(user) {
    $.ajax({
        async: false,
        url: basedir + '/json/eliminar_usuario.php',
        type: 'POST',
        data: {
            usuario: user
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
    
    $('.calendario').datetimepicker({
        lang: 'es',
        timepicker: false,
        scrollInput: false,
        format:'d/m/Y',
	    formatDate:'Y/m/d',
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
    
    $(document).on('click', '#usuarios tr .icono-tabla', function () {
        var confirmacion = confirm("¿Está seguro que desea eliminar este usuario?");
        if (confirmacion){
            eliminar_usuario($(this).attr('data-id'));
            cargar_usuarios();
        }
    });
});