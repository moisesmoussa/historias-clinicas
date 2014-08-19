$(document).ready(function () {
    $(window).scroll(function () {
        $e = $('.menu');

        if ($(this).scrollTop() > 0 && $e.css('position') != 'fixed') {
            $e.css({
                'opacity': '0.8',
                'position': 'fixed',
                'top': '0px',
                'width': '100%'
            });
        }
        if ($(this).scrollTop() < 1 && $e.css('position') === 'fixed') {
            $e.css({
                'opacity': '1',
                'position': 'relative',
                'top': 'auto',
                'width': 'auto'
            });
        }
    });
});