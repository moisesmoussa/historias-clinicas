//Actualiza los datos del perfil del usuario
function actualizarUsuario() {
    $.ajax({
        url: basedir + '/json/actualizar_perfil.php',
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

$(document).ready(function () {
    //Trae de la base de datos todos los datos del usuario
    $.ajax({
        url: basedir + '/json/actualizar_usuario.php',
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

    $('.boton').click(function () {
        actualizarUsuario();
    });

    $('#EstadoReside').change(function () {
        $("#CiudadReside").load(basedir + "ciudades/" + $(this).val() + ".txt")
    });
});