//Actualiza los datos del perfil del usuario
function actualizarUsuario() {
    $.ajax({
        async: false,
        url: basedir + '/json/actualizar_perfil.php',
        type: 'POST',
        data: $('#act-usuario').serialize(),
        beforeSend: function () {
            $('#status').html('Cargando...').show();
        },
        error: function () {
            $('#status').html('Error cargando la información').show();
        },
        success: function (data) {
            var r = JSON.parse(data);

            $('#status').hide();

            if (r.codigo == 0) {
                alert('Debe llenar todos los campos');
            }

            if (r.codigo == 1) {
                alert('Actualización de usuario exitosa');
            }

            if (r.codigo == 2) {
                alert('No se pudo actualizar el usuario');
            }

        }
    });
}

function cargar_usuario(){
    $.ajax({ //Trae de la base de datos todos los datos del usuario
        async: false,
        url: basedir + '/json/onload_perfil.php',
        error: function () {
            $('#status').html('Error cargando la información').show();
        },
        success: function (usuario) {
            var datos = JSON.parse(usuario);

            if (datos.flag) {
                $('#nombre_usuario').val(datos.usuario.nombre_usuario);
                $('#primer_nombre').val(datos.usuario.primer_nombre);
                $('#segundo_nombre').val(datos.usuario.segundo_nombre);
                $('#primer_apellido').val(datos.usuario.primer_apellido);
                $('#segundo_apellido').val(datos.usuario.segundo_apellido);
                $('#fecha_nacimiento').val(datos.usuario.fecha_nacimiento.replace(/-/g, '/'));
                $('#lugar_nacimiento').val(datos.usuario.lugar_nacimiento);
                $('#cedula').val(datos.usuario.cedula);
                $('#estado_residencia').val(datos.usuario.estado_residencia);
                $('#ciudad_residencia').load(basedir + "/ciudades/" + datos.usuario.estado_residencia + ".txt", function () {
                    $(this).val(datos.usuario.ciudad_residencia);
                });
                $('#direccion').val(datos.usuario.direccion);
                $('#codigo_postal').val(datos.usuario.codigo_postal);
                $('#lugar_trabajo').val(datos.usuario.lugar_trabajo);
                $('#tlf_movil').val(datos.usuario.tlf_movil);
                $('#tlf_casa').val(datos.usuario.tlf_casa);
                $('#correo_electronico').val(datos.usuario.correo_electronico);
                $('#correo_alternativo').val(datos.usuario.correo_alternativo);
                $('#especialidad').val(datos.usuario.especialidad);
                $('#fecha_ingreso').val(datos.usuario.fecha_ingreso.replace(/-/g, '/'));
            } else
                alert('No se pudo encontrar los datos del usuario');
        }
    });
}

$(document).ready(function () {
    $('#status').hide();

    var fecha = new Date();

    if (window.location.pathname == (basedir + "/perfil"))
        cargar_usuario();

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

    $('#estado_residencia').change(function () {
        $("#ciudad_residencia").load(basedir + "/ciudades/" + $(this).val() + ".txt")
    });

    $('.boton').click(function () {
        if (window.location.pathname == (basedir + "/perfil"))
            actualizarUsuario();
        else
            $.ajax({
                async: false,
                url: basedir + '/json/clave_perfil.php',
                type: 'POST',
                data: $('#nueva-clave').serialize(),
                error: function () {
                    $('#status').html('Error cargando la información').show();
                },
                success: function (flag) {
                    var datos = JSON.parse(flag);

                    switch (datos.flag) {
                        case 0:
                            alert('La contraseña nueva no coincide');
                            break;
                        case 1:
                            alert('Error en la base de datos');
                            break;
                        case 2:
                            alert('Error con la contraseña actual');
                            break;
                        case 3:
                            alert('No se pudo cambiar la contraseña');
                            break;
                        case 4:
                            alert('Cambio de contraseña exitoso');
                            $('#nueva-clave').each(function () {
                                this.reset();
                            });
                            break;
                    }
                }
            });
    });
});