$(document).ready(function () {
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
});