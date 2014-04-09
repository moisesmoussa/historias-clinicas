function agregarUsuario() {
    $.ajax({
        async: false,
        url: basedir + '/json/insertar_usuario.php',
        type: 'POST',
        data: {
            NombreUsuario: $('#NombreUsuario').val(),
            Clave: $('#Clave').val(),
            clave2: $('#clave2').val(),
            PrimerNombre: $('#PrimerNombre').val(),
            SegundoNombre: $('#SegundoNombre').val(),
            PrimerApellido: $('#PrimerApellido').val(),
            SegundoApellido: $('#SegundoApellido').val(),
            FechaNacimiento: $('#FechaNacimiento').val().replace(/\//g,'-'),
            LugarNacimiento: $('#LugarNacimiento').val(),
            Cedula: $('#Cedula').val(),
            EstadoResidencia: $('#EstadoResidencia').val(),
            CiudadResidencia: $('#CiudadResidencia').val(),
            Direccion: $('#Direccion').val(),
            CodigoPostal: $('#CodigoPostal').val(),
            lugar_trabajo: $('#LugarTrabajo').val(),
            TlfMovil: $('#TlfMovil').val(),
            TlfCasa: $('#TlfCasa').val(),
            CorreoElectronico: $('#CorreoElectronico').val(),
            Especialidad: $('#Especialidad').val(),
            FechaIngreso: $('#FechaIngreso').val().replace(/\//g,'-')
        },
        beforeSend: function () {
            $('#status').html('Guardando datos...').show();
        },
        error: function () {
            $('#status').html('Disculpe se presentó un error guardando la información').show();
        },
        success: function (data) {
            var r = JSON.parse(data);
            
            $('#status').hide();

            if (r.codigo == 0) {
                alert('Debe llenar todos los campos');
            }

            if (r.codigo == 1) {
                alert('Las contraseñas no coinciden.');
            }

            if (r.codigo == 2) {
                $('#nuevo-usuario').each(function () {
                    this.reset();
                });
                alert('Usuario agregado con éxito.');
            }

            if (r.codigo == 3) {
                alert('No se pudo agregar el usuario, es posible que ya exista el usuario.');
            }

        }
    });
}

$(document).ready(function () {
    $('#status').hide();

    var fecha = new Date();

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

    $('#EstadoResidencia').change(function () {
        $("#CiudadResidencia").load(basedir + "/ciudades/" + $(this).val() + ".txt")
    });

    $('.boton').click(function () {
        agregarUsuario();
    });
});