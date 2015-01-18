/* Envía la información suministrada por el usuario al servidor y valida que los datos estén almacenados y sean correctos para
 * iniciar la sesión del usuario en el sistema
 */
function login() {
    $.ajax({
        async: false,
        url: basedir + '/json/login.php',
        type: 'POST',
        data: $('#form-login').serialize(),
        beforeSend: function () {
            $('.status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Verificando información').show();
        },
        error: function () {
            alert('Error iniciando sesión.');
        },
        success: function (data) {
            try {
                $('.status').hide();
                var resultado = JSON.parse(data);

                if (resultado.flag === 1)
                    window.location = basedir + resultado.msg;
                else
                    alert(resultado.msg);

            } catch (e) {
                console.log(data)
                console.log(e)
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
    return false;
}

$(document).ready(function () {
    var usuarioModificado = false;
    var claveModificada = false;
    $('.status').hide();

    $('input[type=text]').focusin(function () {
        if (!usuarioModificado) {
            $(this).val('');
        }
    });
    $('input[type=password]').focusin(function () {
        if (!claveModificada) {
            $(this).val('');
        }
    });

    $('input[type=text]').change(function () {
        usuarioModificado = true;
    });
    $('input[type=password]').change(function () {
        claveModificada = true;
    });

    //Verifica cuando se envían los datos del formulario "form-login" por medio del evento "Submit" y procede a llamar a la función de iniciar sesión
    $('#form-login').submit(function () {
        return login();
    });
});