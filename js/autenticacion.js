function login() {
    $.ajax({
        async: false,
        url: basedir + '/json/login.php',
        type: 'POST',
        data: $('#login').serialize(),
        beforeSend: function () {
            $('.status').html('Verificando información').show();
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
                alert("Error en la información recibida del servidor, no es válida. Esto indica un error en el servidor al solicitar los datos");
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

    $('.boton').click(function () {
        login();
    });

    $(document).keypress(function (e) {
        if (e.which == 13)
            login();
    });
});