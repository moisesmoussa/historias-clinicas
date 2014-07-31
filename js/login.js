//Envía la información suministrada por el usuario y valida que los datos estén almacenados y sean correctos para validar la cuenta e iniciar la sesión del usuario en el sistema
function login() {
    $.ajax({
        async: false,
        url: basedir + '/json/login.php',
        type: 'POST',
        data: $('#login').serialize(),
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

                if (resultado.flag == 0)
                    alert(resultado.msg);
                else
                    window.location = basedir + resultado.msg;
            } catch (e) {
                alert('Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos');
            }
        }
    });
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

    $(document).keypress(function (e) {
        if (e.which == 13)
            login();
    });

    //Valida cuando se hace click en el botón de algún formulario y realiza la acción correspondiente al formulario 
    $('.boton').click(function () {
        login();
    });
});