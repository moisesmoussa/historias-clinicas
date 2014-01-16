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
            FechaNacimiento: $('#FechaNacimiento').val().substr(3, 3) + $('#FechaNacimiento').val().substr(0, 3) + $('#FechaNacimiento').val().substr(6, 4),
            LugarNacimiento: $('#LugarNacimiento').val(),
            Cedula: $('#Cedula').val(),
            Nacionalidad: $('#Nacionalidad').val(),
            Pasaporte: $('#Pasaporte').val(),
            TipoUsuario: $('#TipoUsuario').val(),
            EstadoResidencia: $('#EstadoResidencia').val(),
            CiudadResidencia: $('#CiudadResidencia').val(),
            ParroquiaResidencia: $('#ParroquiaResidencia').val(),
            MunicipioResidencia: $('#MunicipioResidencia').val(),
            Urbanizacion_Sector_ZonaIndustrial: $('#Urbanizacion_Sector_ZonaIndustrial').val(),
            Avenida_Carrera_Esquina: $('#Avenida_Carrera_Esquina').val(),
            Edificio_Quinta_Galpon: $('#Edificio_Quinta_Galpon').val(),
            Piso_Planta_Local: $('#Piso_Planta_Local').val(),
            CodigoPostal: $('#CodigoPostal').val(),
            OtraDireccion: $('#OtraDireccion').val(),
            TlfMovil: $('#TlfMovil').val(),
            TlfCasa: $('#TlfCasa').val(),
            CorreoElectronico: $('#CorreoElectronico').val(),
            Especialidad: $('#Especialidad').val(),
            FechaIngreso: $('#FechaIngreso').val().substr(3, 3) + $('#FechaIngreso').val().substr(0, 3) + $('#FechaIngreso').val().substr(6, 4)
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
        format: 'd/m/Y',
        formatDate: 'Y/m/d',
        minDate: '1900/01/01',
        maxDate: fecha.getDate() + '/' + fecha.getMonth + '/' + fecha.getFullYear()
    });

    $('#EstadoResidencia').change(function () {
        $("#CiudadResidencia").load(basedir + "/ciudades/" + $(this).val() + ".txt")
    });

    /*$('#nuevo-usuario').validate({
        rules: {
            CorreoElectronico: {
                required: true,
                email: true
            },
        },
        messages: {
            CorreoElectronico: {
                required: 'Campo requerido',
                email: "Debe ingresar un e-mail válido."
            }
        }
    });*/

    $('.boton').click(function () {
        agregarUsuario();
    });
});