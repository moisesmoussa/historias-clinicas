function soloNumeros(evento) {
    var key;
    if(window.event) // IE
        {
        key = evento.keyCode;
        }
    else if(evento.which) // Netscape/Firefox/Opera
        {
        key = evento.which;
        }
    
    if (key < 48 || key > 57)
        {
        if(key == 46 || key == 8) // Detectar . (punto) y backspace (retroceso)
            { return true; }
        else 
            { return false; }
        }
    return true;
}

function numeros(evento) {
    var key;
    if(window.event) // IE
        {
        key = evento.keyCode;
        }
    else if(evento.which) // Netscape/Firefox/Opera
        {
        key = evento.which;
        }
    
    if (key < 48 || key > 57)
        return true;
}

function tlf(evento) {
    var key;
    if(window.event) // IE
        {
        key = evento.keyCode;
        }
    else if(evento.which) // Netscape/Firefox/Opera
        {
        key = evento.which;
        }
    
    if (key < 48 || key > 57)
        {
        if(key == 45) // Detectar - (guión)
            return true;
        else 
            return false;
        }
    return true;
}