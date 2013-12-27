function login() {
    $.ajax({
        url: 'login.php',
        type: 'POST',
        data: { usuario: $('#nombre').val(), clave: $('#clave').val() },
        beforeSend: function() {
            $('#status').html('Cargando...');
        },
        success: function(data) {
            $('#status').html('');
            try {
                var r = JSON.parse(data);
                
                if(r.codigo == 0) {
                    alert('Nombre de usuario y/o contraseña incorrectos.');   
                } else if(r.codigo == 1) {
                    document.location = r.tipousuario.concat('.php');
                }
            } catch (error) {
                alert(data);
            }
        }
    });
}