/* Envía la información suministrada por el usuario al servidor y valida que los datos sean válidos para
 * actualizar la contraseña del usuario
 */
function passwordReset() {
    $.ajax({
        async: true,
        url: basedir + '/json/usuario/password_reset.php',
        type: 'POST',
        data: $('#form-password-reset').serialize(),
        beforeSend: function () {
            $('.status').html('<i class="fa fa-spinner fa-spin fa-fw"></i>   Guardando nueva contraseña').show();
        },
        error: function () {
            $('.status').hide();
            alert('Error guardando la información.');
        },
        success: function (data) {
            $('.status').hide();
            try {
                var resultado = JSON.parse(data);
                alert(resultado.msg.replace(/\\n/g, '\n'));

                if (resultado.flag === 1)
                    window.location = basedir + resultado.route;

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

    //Controla el plugin "tooltipster" para colocar tooltips personalizados sobre tags de HTML en el módulo de usuarios
    $('.ayuda').tooltipster({
        contentAsHTML: true,
        theme: 'tooltipster-theme'
    });

    /* Verifica cuando se envían los datos del formulario "form-password-reset" por medio del evento "Submit"
     * y procede a llamar a la función "passwordReset" que se encarga de actualizar la contraseña del
     * usuario si los datos suministrados son válidos
     */
    $('#form-password-reset').submit(function () {
        passwordReset();
        return false;
    });
});