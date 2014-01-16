//Actualiza los datos del perfil del usuario
function actualizarUsuario() {
    $.ajax({
        async: false,
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
            $('#status').html('Cargando...').show();
        },
        error: function () {
            $('#status').html('Disculpe se presentó un error cargando la información').show();
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
                alert('Usuario actualizado con éxito.');
            }

            if (r.codigo == 3) {
                alert('No se pudo actualizar el usuario');
            }

        }
    });
}

$(document).ready(function () {
    $('#status').hide();
    
    //Trae de la base de datos todos los datos del usuario
    $.ajax({
        async: false,
        url: basedir + '/json/onload_perfil.php',
        error: function () {
            $('#status').html('Disculpe se presentó un error cargando la información').show();
        },
        success: function (usuario) {
            var datos = JSON.parse(usuario);
            
            if(datos.flag){
                $('#NombreUsuario').val(datos.usuario.nombreusuario),
                $('#Clave').val(datos.usuario.clave),
                $('#clave2').val(datos.usuario.clave),
                $('#PrimerNombre').val(datos.usuario.primernombre),
                $('#SegundoNombre').val(datos.usuario.segundonombre),
                $('#PrimerApellido').val(datos.usuario.primerapellido),
                $('#SegundoApellido').val(datos.usuario.segundoapellido),
                $('#FechaNacimiento').val(datos.usuario.fechanacimiento),
                $('#LugarNacimiento').val(datos.usuario.lugarnacimiento),
                $('#Cedula').val(datos.usuario.cedula),
                $('#Nacionalidad').val(datos.usuario.nacionalidad.toLowerCase()),
                $('#Pasaporte').val(datos.usuario.pasaporte),
                $('#EstadoResidencia').val(datos.usuario.estadoresidencia),
                $('#CiudadResidencia').val(datos.usuario.ciudadresidencia),
                $('#ParroquiaResidencia').val(datos.usuario.parroquiaresidencia),
                $('#MunicipioResidencia').val(datos.usuario.municipioresidencia),
                $('#Urbanizacion_Sector_ZonaIndustrial').val(datos.usuario.urbanizacion_sectir_zonaindustrial),
                $('#Avenida_Carrera_Esquina').val(datos.usuario.avenida_carrera_esquina),
                $('#Edificio_Quinta_Galpon').val(datos.usuario.edificio_quinta_galpon),
                $('#Piso_Planta_Local').val(datos.usuario.piso_planta_local),
                $('#CodigoPostal').val(datos.usuario.codigopostal),
                $('#OtraDireccion').val(datos.usuario.otradireccion),
                $('#TlfMovil').val(datos.usuario.tlfmovil),
                $('#TlfCasa').val(datos.usuario.tlfcasa),
                $('#CorreoElectronico').val(datos.usuario.correoelectronico),
                $('#Especialidad').val(datos.usuario.especialidad)
            }
            else
                alert('Lo sentimos no se encontraron los datos del usuario');
        }
    });

    $('#EstadoResidencia').change(function () {
        $("#CiudadResidencia").load(basedir + "/ciudades/" + $(this).val() + ".txt")
    });
    
    $('.boton').click(function () {
        actualizarUsuario();
    });

    /*$('#Clave').change(function () {
        $('#Clave2').prop('disabled','disabled');
    });*/
});