var usuarioModificado = false;
var claveModificada = false;

function login() {
    $.ajax({
        async: false,
        url: basedir + '/json/login.php',
        type: 'POST',
        data: {
            usuario: $('#nombre').val(),
            clave: $('#clave').val()
        },
        beforeSend: function () {
            $('#status').html('Verificando información').show();
        },
        error: function () {
            alert('Se produjo un error iniciando sesión.');
        },
        success: function (data) {
            $('#status').hide();
            var resultado = JSON.parse(data);
            
            if (resultado.flag == 0)
                alert(resultado.msg);
            else
                window.location = basedir + resultado.msg;
        }
    });
}

$(document).ready(function () {
    $('#status').hide();
    
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

    $('#iniciar-sesion').click(function () {
        login();
    });

    $(document).keypress(function (e) {
        if (e.which == 13)
            login();
    });
});