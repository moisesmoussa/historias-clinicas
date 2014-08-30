$(document).ready(function () {
    var url = '';

    //Si el sistema se encuentra posicionado en la página principal de entrada se aplica sombra al título de la sección
    if ((url = window.location.pathname) === basedir + '/pages') {
        $('.navcontainer a:first').css({
            'text-shadow': '1px 1px 8px #A14C5E'
        });
    }
    //Si el sistema se encuentra posicionado en la página principal del módulo de usuarios se aplica sombra al título de la sección
    else if (url === basedir + '/usuarios') {
        $('.navcontainer a:nth-child(2)').css({
            'text-shadow': '1px 1px 8px #A14C5E'
        });
    }
    //Si el sistema se encuentra posicionado en la página principal del módulo de pacientes se aplica sombra al título de la sección
    else if (url === basedir + '/pacientes') {
        $('.navcontainer a:last').css({
            'text-shadow': '1px 1px 8px #A14C5E'
        });
    }
    /* Si el sistema se encuentra posicionado en la página de modificación de perfil del usuario con sesión iniciada en el sistema
     * se aplica sombra al título de la sección
     */
    else if (url === basedir + '/usuarios/perfil') {
        $('.perfil').css({
            'text-shadow': '1px 1px 8px #A14C5E'
        });
    }

    //Verifica el scroll para cambiar la barra de menú y permitir que se mueva junto con la página o dejarla en su posición estándar
    $(window).scroll(function () {
        var offset = 83;
        var $e = $('.menu');
        var $busqueda = $('.busqueda');
        var $formulario = $('.contenedor-formulario:first');
        var marginBusqueda = $busqueda.css('margin-top');
        var marginFormulario = $formulario.css('margin-top');

        if ($(this).scrollTop() > 0 && $e.css('position') != 'fixed') {
            $e.css({
                'opacity': '0.8',
                'position': 'fixed',
                'top': '0px',
                'width': '100%'
            });

            $busqueda.css('margin-top', parseInt(marginBusqueda) + offset + 'px');
            $formulario.css('margin-top', parseInt(marginFormulario) + offset + 'px');
        }
        if ($(this).scrollTop() < 1 && $e.css('position') === 'fixed') {
            $e.css({
                'opacity': '1',
                'position': 'relative',
                'top': 'auto',
                'width': 'auto'
            });

            $busqueda.css('margin-top', parseInt(marginBusqueda) - offset + 'px');
            $formulario.css('margin-top', parseInt(marginFormulario) - offset + 'px');
        }
    });

    /* Verifica si el mouse está o no sobre el perfil del usuario con sesión iniciada en el sistema para mostrar las opciones del menú de pefil
     * y dejar o no la sombra fija sobre el perfil del usuario
     */
    $('.menu-perfil').hover(function () {
            if ($('.items-perfil').css('display') == 'none')
                $('.items-perfil').slideToggle();

            $('.perfil').css('text-shadow', '1px 1px 8px #A14C5E')
        },
        function () {
            if ($('.items-perfil').css('display') != 'none')
                $('.items-perfil').slideToggle();

            if (url != basedir + '/usuarios/perfil')
                $('.perfil').css('text-shadow', 'none');
        }
    );
});