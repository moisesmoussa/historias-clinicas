$(document).ready(function () {
    $(window).scroll(function () {
        $e = $('.menu');

        if ($(this).scrollTop() > 0 && $e.css('position') != 'fixed') {
            $e.css({
                'position': 'fixed',
                'top': '0px',
                'width': '100%'
            });
        }
        if ($(this).scrollTop() < 1 && $e.css('position') === 'fixed') {
            $e.css({
                'position': 'relative',
                'top': 'auto',
                'width': 'auto'
            });
        }
    });
});