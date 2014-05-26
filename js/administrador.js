function cargar_usuarios() {
    $.ajax({
        async: false,
        url: basedir + '/json/onload_usuario.php',
        error: function () {
            alert('Disculpe se presentó un error cargando la información');
        },
        success: function (usuarios) {
            var datos = JSON.parse(usuarios);
            var html = "<tr><th class='icono-tabla'></th><th>Nombre</th><th>Cédula</th><th>Fecha de Nacimiento</th><th>Lugar de Nacimiento</th><th>Fecha de Ingreso</th><th>Especialidad</th><th>Nombre de Usuario</th><th>Estado</th><th>Ciudad</th><th>Dirección</th><th>Código Postal</th><th>Lugar de Trabajo</th><th>Móvil</th><th>Tlf de Casa</th><th>Email</th></tr>";

            if (datos.flag) {
                for (var i in datos.usuario) {
                    html += "<tr><td class='icono-tabla' data-id='" + datos.usuario[i].id + "'><i class='fa fa-trash-o fa-2x icon'></i></td><td>" + datos.usuario[i].primernombre + " " + datos.usuario[i].segundonombre + " " + datos.usuario[i].primerapellido + " " + datos.usuario[i].segundoapellido + "</td><td>" + datos.usuario[i].cedula + "</td><td>" + datos.usuario[i].fechanacimiento + "</td><td>" + datos.usuario[i].lugarnacimiento + "</td><td>" + datos.usuario[i].fechaingreso + "</td><td>" + datos.usuario[i].especialidad + "</td><td>" + datos.usuario[i].nombreusuario + "</td><td>" + datos.usuario[i].estadoresidencia + "</td><td>" + datos.usuario[i].ciudadresidencia + "</td><td>" + datos.usuario[i].direccion + "</td><td>" + datos.usuario[i].codigopostal + "</td><td>" + datos.usuario[i].lugar_trabajo + "</td><td>" + datos.usuario[i].tlfmovil + "</td><td>" + datos.usuario[i].tlfcasa + "</td><td>" + datos.usuario[i].correoelectronico + "</td></tr>";
                }

                $('#usuarios').html(html);
            } else
                alert('Lo sentimos no se encontraron los datos del usuario');
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
            alert('Disculpe no se puedo eliminar el usuario');
        },
        success: function (resultado) {
            var msg = JSON.parse(resultado);

            if (msg) {
                alert('Usuario eliminado exitosamente');
                cargar_usuarios();
            } else
                alert('No se puedo eliminar el usuario por error en la base de datos');
        }
    });
}

$(document).ready(function () {
    var fecha = new Date();

    $('.DesarrolloPsicomotor').hide();
    $('.AntecedentesPerinatales').hide();
    //Trae de la base de datos la información necesaria de todos los usuarios registrados
    cargar_usuarios();

    $('.calendario').datetimepicker({
        lang: 'es',
        timepicker: false,
        scrollInput: false,
        format: 'd/m/Y',
        formatDate: 'Y/m/d',
        minDate: '1920/01/01',
        maxDate: fecha.getFullYear() + '/' + fecha.getMonth + '/' + fecha.getDate(),
        yearStart: 1920,
        yearEnd: fecha.getFullYear(),
        onSelectDate: function (date) {
            var edad = fecha.getFullYear() - parseInt($('#Fecha_Nacimiento').val().substr(06));
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

    $('#EstadoResidencia').change(function () {
        $("#CiudadResidencia").load(basedir + "/ciudades/" + $(this).val() + ".txt");
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
        var confirmacion = confirm("¿Desea eliminar este usuario?");
        if (confirmacion){
            eliminar_usuario($(this).attr('data-id'));
            cargar_usuarios();
        }
    });
});