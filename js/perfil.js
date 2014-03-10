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
            FechaNacimiento: $('#FechaNacimiento').val().replace(/\//g,'-'),
            LugarNacimiento: $('#LugarNacimiento').val(),
            Cedula: $('#Cedula').val(),
            EstadoResidencia: $('#EstadoResidencia').val(),
            CiudadResidencia: $('#CiudadResidencia').val(),
            Urbanizacion_Sector_ZonaIndustrial: $('#Urbanizacion_Sector_ZonaIndustrial').val(),
            Avenida_Carrera_Esquina: $('#Avenida_Carrera_Esquina').val(),
            Edificio_Quinta_Galpon: $('#Edificio_Quinta_Galpon').val(),
            CodigoPostal: $('#CodigoPostal').val(),
            lugar_trabajo: $('#LugarTrabajo').val(),
            TlfMovil: $('#TlfMovil').val(),
            TlfCasa: $('#TlfCasa').val(),
            CorreoElectronico: $('#CorreoElectronico').val(),
            Especialidad: $('#Especialidad').val(),
            FechaIngreso: $('#FechaIngreso').val().replace(/\//g,'-')
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

    var fecha = new Date();

    //Trae de la base de datos todos los datos del usuario
    $.ajax({
        async: false,
        url: basedir + '/json/onload_perfil.php',
        error: function () {
            $('#status').html('Disculpe se presentó un error cargando la información').show();
        },
        success: function (usuario) {
            var datos = JSON.parse(usuario);

            if (datos.flag) {
                $('#NombreUsuario').val(datos.usuario.nombreusuario);
                $('#Clave').val(datos.usuario.clave);
                $('#clave2').val(datos.usuario.clave);
                $('#PrimerNombre').val(datos.usuario.primernombre);
                $('#SegundoNombre').val(datos.usuario.segundonombre);
                $('#PrimerApellido').val(datos.usuario.primerapellido);
                $('#SegundoApellido').val(datos.usuario.segundoapellido);
                $('#FechaNacimiento').val(datos.usuario.fechanacimiento.replace(/-/g,'/'));
                $('#LugarNacimiento').val(datos.usuario.lugarnacimiento);
                $('#Cedula').val(datos.usuario.cedula);
                $('#TipoUsuario').val(datos.usuario.tipousuario);
                $('#EstadoResidencia').val(datos.usuario.estadoresidencia);
                $('#CiudadResidencia').load(basedir + "/ciudades/" + datos.usuario.estadoresidencia + ".txt", function (){
                    $(this).val(datos.usuario.ciudadresidencia);
                });
                $('#Urbanizacion_Sector_ZonaIndustrial').val(datos.usuario.urbanizacion_sector_zonaindustrial);
                $('#Avenida_Carrera_Esquina').val(datos.usuario.avenida_carrera_esquina);
                $('#Edificio_Quinta_Galpon').val(datos.usuario.edificio_quinta_galpon);
                $('#CodigoPostal').val(datos.usuario.codigopostal);
                $('#LugarTrabajo').val(datos.usuario.lugar_trabajo);
                $('#TlfMovil').val(datos.usuario.tlfmovil);
                $('#TlfCasa').val(datos.usuario.tlfcasa);
                $('#CorreoElectronico').val(datos.usuario.correoelectronico);
                $('#Especialidad').val(datos.usuario.especialidad);
                $('#FechaIngreso').val(datos.usuario.fechaingreso.replace(/-/g,'/'));
            } else
                alert('Lo sentimos no se encontraron los datos del usuario');
        }
    });
    
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
        actualizarUsuario();
    });
});