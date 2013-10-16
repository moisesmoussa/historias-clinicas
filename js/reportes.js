$(document).ready(function () {
    $("#imprimir").click(function () {
        var w = window.open();
        var html = $("#tabla").html();
        $(w.document.head).html('<style type="text/css">body{font-family:Arial;}table{text-align:center;width:100%}table tr td{padding:2px}table tr td:nth-child(1){width:14.3119%}table tr td:nth-child(2){width:52.9357%}table tr td:nth-child(3){width:10.3669%}table tr td:nth-child(4){width:8.8073%}table tr td:nth-child(5){width:12.477%}table p{text-align:center}table tr:nth-child(even){background-color:#D1E1E8;}table tr:nth-child(odd){background-color:#F0F0F0;}</style>')
        $(w.document.body).html(html);
        w.window.print();
    });
    if (localStorage.getItem('actividad')) {
        if (localStorage.getItem('actividad') != 'Libro diario' && localStorage.getItem('actividad') != 'Libro mayor' && localStorage.getItem('actividad') != 'Balance') {
            localStorage.setItem('actividad', 'Libro diario');
        }
        $("#actividad").text(localStorage.getItem('actividad'));
        $("#titulo").text(localStorage.getItem('actividad') == 'Balance' ? 'Balance de comprobación' : localStorage.getItem('actividad'));

        switch (localStorage.getItem('actividad')) {
        case "Libro diario":
            $.ajax({
                url: 'consultar/libro-diario.php',
                beforeSend: function () {
                    $('.lista').html('<center>Cargando...</center>');
                },
                success: function (data) {
                    var operaciones = JSON.parse(data);
                    var reporteHTML = '';
                    var debeHTML = '',
                        haberHTML = '';
                    var descripcion = operaciones[0].descripcion;
                    var fecha = operaciones[0].fecha;
                    var fechaA;
                    var n_op = 1;
                    var debe = 0,
                        haber = 0;

                    fechaA = fecha.split("-");
                    reporteHTML += '<tr><td>' + fechaA[2] + "/" + fechaA[1] + "/" + fechaA[0] + '</td><td><center>-' + n_op + '-</center></td><td></td><td></td></tr>';

                    for (var i in operaciones) {
                        if (operaciones[i].fecha != fecha) {
                            reporteHTML += debeHTML + haberHTML;
                            debeHTML = '';
                            haberHTML = '';
                            fecha = operaciones[i].fecha;
                            fechaA = fecha.split("-");
                            operaciones[i].fecha = "" + fechaA[2] + "/" + fechaA[1] + "/" + fechaA[0];
                            reporteHTML += '<tr><td></td><td>' + descripcion + '</td><td></td><td></td></tr><tr><td>' + operaciones[i].fecha + '</td><td><center>-' + ++n_op + '-</center></td><td></td><td></td></tr>';
                            descripcion = operaciones[i].descripcion;
                        } else if (operaciones[i].descripcion != descripcion){
                            reporteHTML += debeHTML + haberHTML;
                            debeHTML = '';
                            haberHTML = '';
                            reporteHTML += '<tr><td></td><td>' + descripcion + '</td><td></td><td></td></tr><tr><td></td><td><center>-' + ++n_op + '-</center></td><td></td><td></td></tr>';
                            descripcion = operaciones[i].descripcion;
                        }
                        if ((operaciones[i].tipo == 'Activo' || operaciones[i].tipo == 'Egreso')) {
                            if (operaciones[i].cambio == 0) {
                                debeHTML += '<tr><td></td><td>' + operaciones[i].cuenta + '</td><td>' + parseFloat(operaciones[i].monto) + '</td><td></td></tr>';
                                debe += parseFloat(operaciones[i].monto);
                            } else {
                                haberHTML += '<tr><td></td><td>' + operaciones[i].cuenta + '</td><td></td><td>' + parseFloat(operaciones[i].monto) + '</td></tr>';
                                haber += parseFloat(operaciones[i].monto);
                            }
                        } else {
                            if (operaciones[i].cambio == 0) {
                                haberHTML += '<tr><td></td><td>' + operaciones[i].cuenta + '</td><td></td><td>' + parseFloat(operaciones[i].monto) + '</td></tr>';
                                haber += parseFloat(operaciones[i].monto);
                            } else {
                                debeHTML += '<tr><td></td><td>' + operaciones[i].cuenta + '</td><td>' + parseFloat(operaciones[i].monto) + '</td><td></td></tr>';
                                debe += parseFloat(operaciones[i].monto);
                            }
                        }
                        if (i == operaciones.length - 1)
                            reporteHTML += debeHTML + haberHTML + '<tr><td></td><td>' + operaciones[i].descripcion + '</td><td></td><td></td></tr><tr><td></td><td><b>Total</b></td><td><b>' + debe + '</b></td><td><b>' + haber + '</b></td></tr></table>';
                    }
                    $('#tabla').html('<center><b><p>' + operaciones[0].empresa + '</p></b></center><table><tr><th>Fecha</th><th>Cuenta y Explicación</th><th>Debe</th><th>Haber</th></tr>' + reporteHTML)
                }
            });
            break;
        case "Libro mayor":
            $.ajax({
                url: 'consultar/libro-mayor.php',
                beforeSend: function () {
                    $('.lista').html('<center>Cargando...</center>');
                },
                success: function (data) {
                    var operaciones = JSON.parse(data);
                    var reporteHTML = '',
                        reporteFinal = '';
                    var fecha = '',
                        cuentas_revisadas = Array(),
                        cuenta = '';
                    var fechaA;
                    var debe, haber, saldo;
                    var cont = 0,
                        flag;


                    cuentas_revisadas[cont] = operaciones[0].cuenta;
                    for (var j in operaciones) {
                        flag = 1;
                        debe = 0;
                        haber = 0;
                        saldo = 0;
                        reporteHTML = '';
                        for (var k in cuentas_revisadas)
                            if (cuentas_revisadas[k] == operaciones[j].cuenta && j != 0)
                                flag = 0;
                        if (flag) {
                            fecha = operaciones[j].fecha;
                            cuenta = operaciones[j].cuenta;
                            fechaA = fecha.split("-");
                            if (j != 0) cuentas_revisadas[++cont] = operaciones[j].cuenta;
                            for (var i in operaciones) {
                                if (operaciones[i].cuenta == cuenta) {
                                    if (operaciones[i].fecha != fecha) {
                                        fechaA = operaciones[i].fecha.split("-");
                                        reporteHTML += '<tr><td>' + fechaA[2] + "/" + fechaA[1] + "/" + fechaA[0] + '</td><td>';
                                        fecha = operaciones[i].fecha;
                                    }else{
                                        fechaA = operaciones[i].fecha.split("-");
                                        reporteHTML += '<tr><td>' + fechaA[2] + "/" + fechaA[1] + "/" + fechaA[0] + '</td><td>';
                                    }
                                    reporteHTML += operaciones[i].descripcion + '</td><td>';
                                    if ((operaciones[j].tipo == 'Activo' || operaciones[j].tipo == 'Egreso')) {
                                        if (operaciones[i].cambio == 0) {
                                            reporteHTML += parseFloat(operaciones[i].monto) + '</td><td></td><td>';
                                            debe += parseFloat(operaciones[i].monto);
                                        } else {
                                            reporteHTML += '</td><td>' + parseFloat(operaciones[i].monto) + '</td><td>';
                                            haber += parseFloat(operaciones[i].monto);
                                        }
                                    } else {
                                        if (operaciones[i].cambio == 0) {
                                            reporteHTML += '</td><td>' + parseFloat(operaciones[i].monto) + '</td><td>';
                                            haber += parseFloat(operaciones[i].monto);
                                        } else {
                                            reporteHTML += parseFloat(operaciones[i].monto) + '</td><td></td><td>';
                                            debe += parseFloat(operaciones[i].monto);
                                        }
                                    }
                                    reporteHTML += (saldo = debe - haber) > 0 ? ('>' + saldo + '</td></tr>') : ('<' + (-1) * saldo + '</td></tr>');
                                }
                            }
                            reporteHTML += '<tr><td></td><td><b>Total</b></td><td>';
                            if (debe)
                                reporteHTML += '<b>' + debe + '</b></td><td>';
                            else
                                reporteHTML += '</td><td>';
                            if (haber)
                                reporteHTML += '<b>' + haber + '</b></td><td>';
                            else
                                reporteHTML += '</td><td>';
                            if (saldo > 0)
                                reporteHTML += '<b>>' + saldo + '</b></td></tr></table>';
                            else
                                reporteHTML += '<b><' + (-1) * saldo + '</b></td></tr></table>';
                            reporteFinal += '<b><left><p>Cuenta: ' + cuenta + '</p><left></b><table><tr><th>Fecha</th><th>Explicación</th><th>Debe</th><th>Haber</th><th>Saldo</th></tr>' + reporteHTML;
                        }
                    }
                    $('#tabla').html('<center><b><p>' + operaciones[0].empresa + '</p></b></center>' + reporteFinal);
                }
            });
            break;
        case "Balance":
            $.ajax({
                url: 'consultar/libro-mayor.php',
                beforeSend: function () {
                    $('.lista').html('<center>Cargando...</center>');
                },
                success: function (data) {
                    var operaciones = JSON.parse(data);
                    var reporte = '',
                        reporteFinal = '';
                    var cont = 0,
                        flag;
                    var debe, haber, saldo;
                    var total_deudor = 0,
                        total_acreedor = 0;
                    var fecha = '',
                        cuentas_revisadas = Array(),
                        cuenta = '';

                    cuentas_revisadas[cont] = operaciones[0].cuenta;
                    for (var j in operaciones) {
                        flag = 1;
                        debe = 0;
                        haber = 0;
                        saldo = 0;
                        reporte = '';
                        for (var k in cuentas_revisadas)
                            if (cuentas_revisadas[k] == operaciones[j].cuenta && j != 0)
                                flag = 0;
                        if (flag) {
                            fecha = operaciones[j].fecha;
                            cuenta = operaciones[j].cuenta;
                            if (j != 0) cuentas_revisadas[++cont] = operaciones[j].cuenta;
                            for (var i in operaciones) {
                                if (operaciones[i].cuenta == cuenta) {
                                    if (operaciones[i].fecha != fecha) fecha = operaciones[i].fecha;
                                    if ((operaciones[j].tipo == 'Activo' || operaciones[j].tipo == 'Egreso')) {
                                        if (operaciones[i].cambio == 0)
                                            debe += parseFloat(operaciones[i].monto);
                                        else
                                            haber += parseFloat(operaciones[i].monto);
                                    } else {
                                        if (operaciones[i].cambio == 0)
                                            haber += parseFloat(operaciones[i].monto);
                                        else
                                            debe += parseFloat(operaciones[i].monto);
                                    }
                                    saldo = debe - haber;
                                }
                            }
                            if (saldo > 0) {
                                reporte += '<tr><td>' + cuenta + '</td><td>' + saldo + '</td><td></td></tr>';
                                total_deudor += parseFloat(saldo);
                            } else {
                                reporte += '<tr><td>' + cuenta + '</td><td></td><td>' + (-1) * saldo + '</td></tr>';
                                total_acreedor += parseFloat((-1) * saldo);
                            }
                            reporteFinal += reporte;
                        }
                    }
                    reporteFinal += '<tr><td><b>Total</b></td><td><b>' + total_deudor + '</b></td><td><b>' + total_acreedor + '</b></td></tr></table>';
                    $('#tabla').html('<table><b><tr><th>Cuenta</th><th>Saldo Deudor</th><th>Saldo Acreedor</th></tr></b>' + reporteFinal);
                }
            });
            break;
        }
    }
});
