$(document).ready(function () {
    $('#usuario').click(function () {
        $.ajax({
            url: 'logout.php',
            success: function (data) {
                document.location = 'index.php';
            }
        });
    });

    $("#perfil").click(function () {
        $("#modperfil").slideToggle();
    })

    $("#insertar").click(function () {
        $("#item-menu").slideToggle();
    })

    $('#EstadoReside').change(function () {
        $("#CiudadReside").load("ciudades/" + $(this).val() + ".txt")
    })

})

function actualizarUsuario() {
    $.ajax({
        url: 'actualizar/usuario.php',
        type: 'POST',
        data: {
            NombreUsuario: $('#NombreUsuario').val(),
            Clave: $('#Clave').val(),
            clave2: $('#clave2').val(),
            PrimerNombre: $('#PrimerNombre').val(),
            SegundoNombre: $('#SegundoNombre').val(),
            PrimerApellido: $('#PrimerApellido').val(),
            SegundoApellido: $('#SegundoApellido').val(),
            FechaNacimiento: $('#FechaNacimiento').val(),
            LugarNacimiento: $('#LugarNacimiento').val(),
            Cedula: $('#Cedula').val(),
            Nacionalidad: $('#Nacionalidad').val(),
            Pasaporte: $('#Pasaporte').val(),
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
            Especialidad: $('#Especialidad').val()
        },
        beforeSend: function () {
            $('#status').html('Cargando...');
        },
        success: function (data) {
            var r = JSON.parse(data);

            $('#status').html('');

            if (r.codigo == 0) {
                alert('Debe llenar todos los campos');
            }

            if (r.codigo == 1) {
                alert('Las contraseñas no coinciden.');
            }

            if (r.codigo == 2) {
                alert('Usuario actualizado con éxito.');
            }

            if (r.codigo == 3) {
                alert('No se pudo actualizar el usuario');
            }

        }
    });
}