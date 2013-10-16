$(document).ready(function () {
    if (localStorage.getItem('actividad')) {
        if (localStorage.getItem('actividad') != 'Cuentas' && localStorage.getItem('actividad') != 'Operaciones') {
            localStorage.setItem('actividad', 'Cuentas');
        }
        $("#actividad").text(localStorage.getItem('actividad'));
        $("#titulo").text(localStorage.getItem('actividad') + ' registradas');
    }
    switch (localStorage.getItem('actividad')) {
    case "Cuentas":
        agregarTabla('Cuentas');
        agregarFormulario('Cuentas');
        break;
    case "Operaciones":
        agregarTabla('Operaciones');
        agregarFormulario('Operaciones');
        break;
    }
});

function agregarTabla(actividad) {
    switch (actividad) {
    case "Cuentas":
        $.ajax({
            url: 'consultar/cuentas.php',
            beforeSend: function () {
                $('.lista').html('<center>Cargando...</center>');
            },
            success: function (data) {
                var cuentas = JSON.parse(data);
                var cuentasHTML = '';

                for (var i in cuentas) {
                    cuentasHTML += '<tr><td>' + cuentas[i].nombre + '</td><td>' + cuentas[i].descripcion + '</td><td>' + cuentas[i].tipo + '</td><td><a href="javascript:void(0);" onclick="javascript:modificarCuenta(\'' + cuentas[i].nombre + '\', \'' + cuentas[i].descripcion + '\', \'' + cuentas[i].tipo + '\');">Modificar</a> / <a href="javascript:void(0);" onclick="javascript:eliminarCuenta(\'' + cuentas[i].nombre + '\')">Eliminar</a></td></tr>';
                }

                $('.lista').html('<tr><th>Nombre</th><th>Descripción</th><th>Tipo</th><th>Acción</th></tr>' + cuentasHTML);
            }
        });
        break;
    case "Operaciones":
        $.ajax({
            url: 'consultar/operaciones.php',
            beforeSend: function () {
                $('.lista').html('<center>Cargando...</center>');
            },
            success: function (data) {
                var operaciones = JSON.parse(data);
                var operacionesHTML = '';

                for (var i in operaciones) {
                    operacionesHTML += '<tr><td>' + operaciones[i].fecha + '</td><td>' + operaciones[i].descripcion + '</td><td>' + operaciones[i].cuenta + '</td><td>' + operaciones[i].monto + '</td><td>' + operaciones[i].cambio + '</td><td><a href="javascript:void(0);" onclick="javascript:modificarOperacion(\'' + operaciones[i].codigo + '\', \'' + operaciones[i].fecha + '\', \'' + operaciones[i].descripcion + '\', \'' + operaciones[i].cuenta + '\', \'' + operaciones[i].monto + '\', \'' + operaciones[i].cambio + '\');">Modificar</a> / <a href="javascript:void(0);" onclick="javascript:eliminarOperacion(\'' + operaciones[i].codigo + '\')">Eliminar</a></td></tr>';
                }

                $('.lista').html('<tr><th>Fecha</th><th>Descripción</th><th>Cuenta</th><th>Monto</th><th>Cambio</th><th>Acción</th></tr>' + operacionesHTML);
            }
        });
        break;
    }
}

function agregarFormulario(actividad) {
    switch (actividad) {
    case "Cuentas":
        $('#formulario').attr('onsubmit', 'javascript:return (agregarCuenta(),false);');
        $('#formulario').html('<table><tr><td><label for="cuenta">Nombre:</label><br><input id="cuenta" type="text" required></td></tr><tr><td><label for="descripcion">Descripción:</label><br><input id="descripcion" type="text" required></td></tr><tr><td><label for="cuentas">Tipo de cuenta:</label><br><select name="" id="cuentas"><option value="Activo">Activo</option><option value="Egreso">Egreso</option><option value="Ingreso">Ingreso</option><option value="Pasivo">Pasivo</option><option value="Patrimonio">Patrimonio</option></select></td></tr><tr><td><input type="submit" value="Agregar"></td></tr></table>')
        break;
    case "Operaciones":
        $.ajax({
            url: 'consultar/cuentas.php',
            beforeSend: function () {
                $('#formulario').html('<center>Cargando...</center>');
            },
            success: function (data) {
                var cuentas = JSON.parse(data);
                var cuentasHTML = '';

                for (var i in cuentas) {
                    cuentasHTML += '<option value="' + cuentas[i].nombre + '">' + cuentas[i].nombre + '</option>';
                }

                if (cuentas == null) {
                    alert('Debe agregar al menos una cuenta para poder agregar una operación.');
                }
                $('#formulario').attr('onsubmit', 'javascript:return (agregarOperacion(),false);');
                $('#formulario').html('<table><tr><td><label for="fecha">Fecha (dd/mm/aaaa):</label><br><input id="fecha" type="date" required></td></tr><tr><td><label for="descripcion">Descripción:</label><br><input id="descripcion" type="text" required></td></tr><tr><td><label for="cuenta">Cuenta:</label><br><select id="cuenta" required>' + cuentasHTML + '</select></td></tr><tr><td><label for="monto">Monto:</label><br><input id="monto" type="number" min="0" required></td></tr><tr><td><label for="cambio">Cambio:</label><br><select id="cambio"><option value="0">Aumento</option><option value="1">Disminución</option></select></td></tr><tr><td><input type="submit" value="Agregar"></td></tr></table>')
            }
        });
        break;
    }
}

function agregarCuenta() {
    $.ajax({
        url: 'insertar/cuenta.php',
        type: 'POST',
        data: {
            nombre: $('#cuenta').val(),
            descripcion: $('#descripcion').val(),
            tipo: $('#cuentas').val()
        },
        beforeSend: function () {
            $('#status').html('Agregando cuenta...');
        },
        success: function (data) {
            var r = JSON.parse(data);

            $('#status').html('');

            if (r.codigo == 1) {
                $('#formulario').each(function () {
                    this.reset();
                });
                agregarTabla('Cuentas');
            }

            if (r.codigo == 2) {
                alert('Ocurrió un problema agregando la cuenta, por favor verifique que la cuenta no exista.');
            }
        }
    });
}

function agregarOperacion() {
    $.ajax({
        url: 'insertar/operacion.php',
        type: 'POST',
        data: {
            fecha: $('#fecha').val(),
            descripcion: $('#descripcion').val(),
            cuenta: $('#cuenta').val(),
            monto: $('#monto').val(),
            cambio: $('#cambio').val()
        },
        beforeSend: function () {
            $('#status').html('Agregando operación...');
        },
        success: function (data) {
            var r = JSON.parse(data);

            $('#status').html('');

            if (r.codigo == 1) {
                $('#formulario').each(function () {
                    this.reset();
                });
                agregarTabla('Operaciones');
            }

            if (r.codigo == 2) {
                alert('Ocurrió un problema agregando la operación.');
            }
        }
    });
}

function modificarCuenta(nombre, descripcion, tipo) {
    $('#formulario').attr('onsubmit', 'javascript:return (_modificarCuenta(),false);');
    $('#formulario').html('<table><tr><td><label for="cuenta">Nombre:</label><br><input id="cuenta" type="text" value="' + nombre + '" required></td></tr><tr><td><label for="descripcion">Descripción:</label><br><input id="descripcion" type="text" value="' + descripcion + '" required></td></tr><tr><td><label for="cuentas">Tipo de cuenta:</label><br><select name="" id="cuentas"><option value="Activo">Activo</option><option value="Egreso">Egreso</option><option value="Ingreso">Ingreso</option><option value="Pasivo">Pasivo</option><option value="Patrimonio">Patrimonio</option></select></td></tr><tr><td><input type="hidden" id="cuenta_o" value="' + nombre + '"><input type="submit" value="Modificar"></td></tr></table><center><a href="javascript:void(0);" onclick="javascript:agregarFormulario(\'Cuentas\');">Volver a agregar cuenta</a></center>');
    $('#cuentas').val(tipo);
}

function _modificarCuenta() {
    /* Hace el trabajo sucio */
    $.ajax({
        url: 'actualizar/cuenta.php',
        type: 'POST',
        data: {
            nombre: $('#cuenta').val(),
            descripcion: $('#descripcion').val(),
            tipo: $('#cuentas').val(),
            nombre_old: $('#cuenta_o').val()
        },
        beforeSend: function () {
            $('#status').html('Cargando...');
        },
        success: function (data) {
            $('#status').html('');
            $('#cuenta_o').val($('#cuenta').val());
            agregarTabla('Cuentas');
        }
    });
}

function modificarOperacion(codigo, fecha, descripcion, cuenta, monto, cambio) {
    $.ajax({
        url: 'consultar/cuentas.php',
        beforeSend: function () {
            $('#formulario').html('<center>Cargando...</center>');
        },
        success: function (data) {
            var cuentas = JSON.parse(data);
            var cuentasHTML = '';
            var fechaA = fecha.split("/");

            for (var i in cuentas) {
                cuentasHTML += '<option value="' + cuentas[i].nombre + '">' + cuentas[i].nombre + '</option>';
            }

            $('#formulario').attr('onsubmit', 'javascript: return (_modificarOperacion(), false);');
            $('#formulario').html('<table><tr><td><label for="fecha">Fecha (dd/mm/aaaa):</label><br><input id="fecha" type="date" value="' + fechaA[2] + "-" + fechaA[1] + "-" + fechaA[0] + '" required></td></tr><tr><td><label for="descripcion">Descripción:</label><br><input id="descripcion" type="text" value="' + descripcion + '" required></td></tr><tr><td><label for="cuenta">Cuenta:</label><br><select id="cuenta" required>' + cuentasHTML + '</select></td></tr><tr><td><label for="monto">Monto:</label><br><input id="monto" type="number" min="0" value="' + monto + '" required></td></tr><tr><td><label for="cambio">Cambio:</label><br><select id="cambio"><option value="0">Aumento</option><option value="1">Disminución</option></select></td></tr><tr><td><input type="hidden" id="codigo" value="' + codigo + '"><input type="submit" value="Modificar"></td></tr></table><center><a href="javascript:void(0);" onclick="javascript:agregarFormulario(\'Operaciones\');">Volver a agregar operación</a></center>');
            $('#cuenta').val(cuenta);
            $('#cambio').val(cambio == 'Aumento' ? 0 : 1);
        }
    });
}

function _modificarOperacion() {
    $.ajax({
        url: 'actualizar/operacion.php',
        type: 'POST',
        data: {
            codigo: $('#codigo').val(),
            fecha: $('#fecha').val(),
            descripcion: $('#descripcion').val(),
            cuenta: $('#cuenta').val(),
            monto: $('#monto').val(),
            cambio: $('#cambio').val()
        },
        beforeSend: function () {
            $('#status').html('Cargando...');
        },
        success: function (data) {
            $('#status').html('');
            agregarTabla('Operaciones');
        }
    });
}

function eliminarCuenta(nombre) {
    if (confirm('¿Está seguro que desea eliminar la cuenta ' + nombre + '? Se eliminarán todas las operaciones asociadas a esta cuenta.')) {
        $.ajax({
            url: 'eliminar/cuenta.php?nombre=' + nombre,
            beforeSend: function () {
                $('.lista').html('<center>Cargando...</center>');
            },
            success: function (data) {
                agregarTabla('Cuentas');
            }
        });
    }
}

function eliminarOperacion(codigo) {
    if (confirm('¿Está seguro que desea eliminar esta operación?')) {
        $.ajax({
            url: 'eliminar/operacion.php?codigo=' + codigo,
            beforeSend: function () {
                $('.lista').html('<center>Cargando...</center>');
            },
            success: function (data) {
                agregarTabla('Operaciones');
            }
        });
    }
}
