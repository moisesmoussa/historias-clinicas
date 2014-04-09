$(document).ready(function () {
    var hoy = new Date();
    var dia = hoy.getDate();
    var mes = hoy.getMonth() + 1;
    var anio = hoy.getFullYear();
    var edad;
    $('input[name = "Sexo"]').change(function () {
        if ($(this).val() == "Masculino") { //No funciona
            $('#Hombre').show();
            $('#Mujer').hide();
            jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });
            $('#registro_p').validate({
                rules: {
                    InicioCrecimientoTesticular: "required"
                }
            });
        } else
        if ($(this).val() == "Femenino") { //No funciona
            $('#Mujer').show();
            $('#Hombre').hide();
            $('#registro_p').validate({
                rules: {
                    Telarquia: "required",
                    Menarquia: "required",
                    CicloMenstrual: "required",
                    Anticoncepcion: "required",
                    ACO: "required",
                    DIU: "required",
                    OtroAnticonceptivo: "required",
                    NroGestas: "required",
                    NroPartos: "required",
                    NroCesareas: "required",
                    NroAbortos: "required",
                    LegradoUterino: "required"
                }
            });
        }
    });
    $('#AnioN, #MesN, #DiaN').change(function () {
        if (anio != $('#AnioN').val()) {
            if (mes < $('#MesN').val()) {
                edad = anio - $('#AnioN').val();
            } else
            if (mes == $('#MesN').val()) {
                if (dia <= $('#DiaN').val()) {
                    edad = anio - $('#AnioN').val();
                } else {
                    edad = anio - $('#AnioN').val() - 1;
                }
            } else {
                edad = anio - $('#AnioN').val() - 1;
            }
        } else {
            edad = 0;
        }
        if (edad < 19) {
            $('#Perinatales').show();
            $('#Pe_flag').val("1");
            $('#registro_p').validate({ //No funciona
                rules: {
                    CarnetPrenatal: "required",
                    NroConsultasPrenatal: "required",
                    NombreMadre: "required",
                    NombrePadre: "required",
                    TrastornosEmbarazo: "required",
                    EmbarazoATermino: "required",
                    PartoUnicoEspontaneo: "required",
                    PartoForceps: "required",
                    ComplicacionesParto: "required",
                    ComplicacionesPuerperio: "required",
                    TrastornosRecienNacido: "required",
                    Reanimacion: "required",
                    PesoAlNacer: {
                        required: true,
                        digits: true
                    },
                    TallaAlNacer: {
                        required: true,
                        digits: true
                    },
                    PerimetroCefalico: {
                        required: true,
                        digits: true
                    },
                    LactanciaExclusiva: "required",
                    LactanciaMixta: "required",
                    Ablactacion: "required",
                    EgresoRecienNacidoPatologico: "required",
                    Asfixia: "required",
                    EgresoRecienNacidoSano: "required"
                }
            });
            if (edad < 10) {
                $('#Psicomotor').show();
                $('#Ps_flag').val("1");
                $('#registro_p').validate({ //No funciona
                    rules: {
                        Cabeza: "required",
                        Social: "required",
                        SeSento: "required",
                        Gateo: "required",
                        SeParo: "required",
                        Camino: "required",
                        Comio: "required",
                        Palabras: "required",
                        ControlEsfinterVesical: "required",
                        ControlEsfinterAnal: "required"
                    }
                });
            }
        } else {
            $('#Perinatales').hide();
            $('#Pe_flag').val("0");
            $('#Psicomotor').hide();
            $('#Ps_flag').val("0");

        }
    });
});
$("#registro_p").validate({
    rules: {
        Nacionalidad: "required",
        Cedula: {
            required: true,
            digits: true
        },
        Pasaporte: "digits",
        PrimerApellido: "required",
        PrimerNombre: "required",
        DiaN: "required",
        MesN: "required",
        AnioN: "required",
        Sexo: "required",
        PaisNacimiento: "required",
        SituacionConyugal: "required",
        Analfabeta: "required",
        Educacion: "required",
        Ocupacion: "required",
        SeguridadSocial: "required",
        CorreoElectronico: "email",
        EstadoReside: "required",
        CiudadReside: "required",
        CodigoPostal: "required",
        TlfDomicilio: "digits",
        TlfMovil: {
            required: true,
            digits: true
        },
        Pubarquia: "required",
        PrimeraRelacionSexual: "required",
        FrecuenciaRelacionesSexualesMes: "required",
        NroParejasUltimoAnio: "required",
        RelSexualSatisfactoria: "required",
        MenopausiaAndropausia: "required",
        Fuma: "required",
        Alcohol: "required",
        DrogasIlicitas: "required",
        ActividadFisica: "required",
        Sedentarismo: "required",
        ManejoEstres: "required",
        TumorBenigno: "required",
        TumorMaligno: "required",
        EnfEruptivas: "required",
        ITS: "required",
        Meningitis: "required",
        Chagas: "required",
        Tuberculosis: "required",
        Dengue: "required",
        Hansen: "required",
        Leishmaniasis: "required",
        Leptospirosis: "required",
        Malaria: "required",
        Desnutricion: "required",
        Diabetes: "required",
        Dislipidemias: "required",
        Obesidad: "required",
        TrastornoApetito: "required",
        Enuresis: "required",
        ChupaDedo: "required",
        Onicofagia: "required",
        TrastornoLlanto: "required",
        HTASistemica: "required",
        Tromboembolismo: "required",
        Varices: "required",
        Cardiopatia: "required",
        Asma: "required",
        Neumonia: "required",
        Gastroenteropatias: "required",
        Hepatopatias: "required",
        TrastornosEvacuacion: "required",
        Colagenopatias: "required",
        Artritis: "required",
        TrastornosMiccionales: "required",
        EnfermedadRenal: "required",
        Alergias: "required",
        TrastornosSuenio: "required",
        ViolenciaPsicologica: "required",
        ViolenciaFisica: "required",
        ViolenciaSexual: "required",
        Accidentes: "required",
        GrupoSanguineo: "required",
        Hospitalizacion: "required",
        IntervencionQuirurgica: "required"
    }
});