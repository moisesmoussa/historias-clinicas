/* Envía la información suministrada por el usuario al servidor y valida que los datos estén almacenados y sean correctos para
 * proceder a enviar un correo al usuario por medio del cual podrá reestablecer su contraseña olvidada
 */
function forgotPassword() {
    $.ajax({
        async: true,
        url: basedir + '/json/usuario/forgot_password.php',
        type: 'POST',
        data: $('#form-forgot-password').serialize(),
        beforeSend: function () {
            $('.status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Procesando solicitud').show();
        },
        error: function () {
            $('.status').hide();
            alert('Error procesando solicitud para enviar correo de reestablecimiento de contraseña.');
        },
        success: function (data) {
            $('.status').hide();
            try {
                var resultado = JSON.parse(data);
                alert(resultado.msg);

            } catch (e) {
                console.log(data)
                console.log(e)
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
}

$(document).ready(function () {
    $('.status').hide();

    /* Verifica cuando se envían los datos del formulario "form-forgot-password" por medio del evento "Submit"
     * y procede a llamar a la función "forgotPassword" que se encarga de enviar un correo al usuario
     * por medio del cual podrá reestablecer su contraseña si los datos suministrados son válidos
     */
    $('#form-forgot-password').submit(function () {
        forgotPassword();
        return false;
    });
});