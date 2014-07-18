$(document).ready(function () {
    $(".perfil").mouseenter(function () {
        if ($(".items-perfil").css("display") == "none")
            $(".items-perfil").slideToggle();
    });

    $(".area-perfil").mouseleave(function () {
        if ($(".items-perfil").css("display") != "none")
            $(".items-perfil").slideToggle();
    });

    $("#insertar").click(function () {
        $(".item-menu").slideToggle();
    });

    $('.tlf').keypress(function (evento) {
        var key;
        if (window.event) // IE
        {
            key = evento.keyCode;
        } else if (evento.which) // Netscape/Firefox/Opera
        {
            key = evento.which;
        }

        if (key < 48 || key > 57) {
            if (key == 45) // Detectar - (guión)
                return true;
            else
                return false;
        }
        return true;
    });

    $('.numeros').keypress(function (evento) {
        var key;
        if (window.event) // IE
        {
            key = evento.keyCode;
        } else if (evento.which) // Netscape/Firefox/Opera
        {
            key = evento.which;
        }

        if (key < 48 || key > 57)
            return false;
        else
            return true;
    });
});