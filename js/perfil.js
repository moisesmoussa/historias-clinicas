//Actualiza los datos del perfil del usuario
function actualizarUsuario() {
    $.ajax({
        async: false,
        url: basedir + '/json/actualizar_perfil.php',
        type: 'POST',
        data: $('#act-usuario').serialize(),
        beforeSend: function () {
            $('.status').html('Cargando...').show();
        },
        error: function () {
            $('.status').html('Error cargando la información').show();
        },
        success: function (data) {
            try {
                $('.status').hide();
                var r = JSON.parse(data);

                if (r.codigo == 0) {
                    alert('Debe llenar todos los campos');
                }

                if (r.codigo == 1) {
                    alert('Actualización de usuario exitosa');
                }

                if (r.codigo == 2) {
                    alert('No se pudo actualizar el usuario');
                }
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }

        }
    });
}

//Carga la información de un usuario y la muestra en un formulario para que se puedan modificar
function cargarUsuario() {
    $.ajax({ //Trae de la base de datos todos los datos del usuario
        async: false,
        url: basedir + '/json/onload_perfil.php',
        error: function () {
            $('.status').html('Error cargando la información').show();
        },
        success: function (usuario) {
            try {
                $('.status').hide();
                var datos = JSON.parse(usuario);

                if (datos.flag) {
                    for(var i in datos.usuario){
                        if(i == 'ciudad_residencia')
                            $('#ciudad_residencia').load(basedir + '/ciudades/' + datos.usuario.estado_residencia + '.txt', function () {
                                $(this).val(datos.usuario.ciudad_residencia);
                            });
                        else if(i.match('[fecha]*'))
                            $('#' + i).val(datos.usuario[i].replace(/-/g, '/'));
                        else
                            $('#' + i).val(datos.usuario[i]);
                    }
                } else
                    alert('No se pudo encontrar los datos del usuario');
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

//Actualiza la clave de un usuario en la base de datos
function actualizarClave(){
    $.ajax({
        async: false,
        url: basedir + '/json/clave_perfil.php',
        type: 'POST',
        data: $('#nueva-clave').serialize(),
        error: function () {
            $('.status').html('Error cargando la información').show();
        },
        success: function (flag) {
            try {
                $('.status').hide();
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
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al insertar los datos');
            }
        }
    });
}

$(document).ready(function () {
    var fecha = new Date();
    $('.status').hide();

    if (window.location.pathname == (basedir + '/perfil'))
        cargarUsuario();

    //Maneja el plugin para mostrar un formato tipo calendario al momento de ingresar fechas
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

    //Carga las ciudades por estado desde un archivo .txt con el nombre del estado indicado en la carpeta "ciudades"
    $('#estado_residencia').change(function () {
        $('#ciudad_residencia').load(basedir + '/ciudades/' + $(this).val() + '.txt')
    });

    /* Si se hace click en el botón del formulario de modificación de datos del usuario se envían los datos al servidor para actualizarlos en la base de datos
     * de lo contrario, si se hace click en el botón del formulario para cambio de contraseña se envían los datos al servidor para actualizar la contraseña
     */
    $('.boton').click(function () {
        if (window.location.pathname == (basedir + '/perfil'))
            actualizarUsuario();
        else
            actualizarClave();
    });
});