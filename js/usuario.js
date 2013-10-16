function agregarUsuario() {
    $.ajax({
        url: 'insertar/insertar-usuario.php',
        type: 'POST',
        data: { NombreUsuario: $('#NombreUsuario').val(), Clave: $('#Clave').val(), clave2: $('#clave2').val(), PrimerNombre: $('#PrimerNombre').val(),
                SegundoNombre: $('#SegundoNombre').val(), PrimerApellido: $('#PrimerApellido').val(), SegundoApellido: $('#SegundoApellido').val(), FechaNacimiento: $('#FechaNacimiento').val(), LugarNacimiento: $('#LugarNacimiento').val(), Ficha: $('#Ficha').val(), Cedula: $('#Cedula').val(), Nacionalidad: $('#Nacionalidad').val(), Pasaporte: $('#Pasaporte').val(), TipoUsuario: $('#TipoUsuario').val(), EstadoResidencia: $('#EstadoResidencia').val(), CiudadResidencia: $('#CiudadResidencia').val(), ParroquiaResidencia: $('#ParroquiaResidencia').val(), MunicipioResidencia: $('#MunicipioResidencia').val(), Urbanizacion_Sector_ZonaIndustrial: $('#Urbanizacion_Sector_ZonaIndustrial').val(), Avenida_Carrera_Esquina: $('#Avenida_Carrera_Esquina').val(), Edificio_Quinta_Galpon: $('#Edificio_Quinta_Galpon').val(), Piso_Planta_Local: $('#Piso_Planta_Local').val(), CodigoPostal: $('#CodigoPostal').val(), OtraDireccion: $('#OtraDireccion').val(), TlfMovil: $('#TlfMovil').val(), TlfCasa: $('#TlfCasa').val(), CorreoElectronico: $('#CorreoElectronico').val(), Especialidad: $('#Especialidad').val(), FechaIngreso: $('#FechaIngreso').val()},
        beforeSend: function() {
            $('#status').html('Cargando...');
        },
        success: function(data) {
            var r = JSON.parse(data);
            
            $('#status').html('');
            
            if(r.codigo == 0) {
                alert('Debe llenar todos los campos');
            }
            
            if(r.codigo == 1) {
                alert('Las contraseñas no coinciden.');
            }
            
            if(r.codigo == 2) {
                $('#nuevo-usuario').each(function(){
                    this.reset();
                });
                alert('Usuario agregado con éxito.');
            }
            
            if(r.codigo == 3) {
                alert('No se pudo agregar el usuario, es posible que ya exista el usuario.');   
            }
            
        }
    });
}