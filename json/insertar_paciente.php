<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Paciente insertado correctamente en la BD
    2 = El paciente no se pudo insertar en la BD
*/
session_start();

$_POST['Nacionalidad'] = ucfirst($_POST['Nacionalidad']);
$msg = NULL;
$flag = 1;

if(isset($_SESSION['administrador']) || isset($_SESSION['medico']) || isset($_SESSION['enfermera'])) {
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }
    if(!flag)
        $msg['codigo'] = 0;
    else {
        
        require_once('../config.php');
        $conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");
    
        $columnas = 'INSERT INTO paciente (';
        $valores = 'VALUES (';
        $len = count($_POST);
        $cont = 1;
        
        if(!$_POST["Pasaporte"])
			$_POST["Pasaporte"]=0;
		if(!$_POST["SegundoApellido"])
			$_POST["SegundoApellido"]="N/A";
		if(!$_POST["SegundoNombre"])
			$_POST["SegundoNombre"]="N/A";
		if(!$_POST["Etnia"])
			$_POST["Etnia"]="N/A";
		if(!$_POST["Profesion"])
			$_POST["Proseion"]="N/A";
		if(!$_POST["CorreoElectronico"])
			$_POST["CorreoElectronico"]="N/A";
		if(!$_POST["MunicipioReside"])
			$_POST["MunicipioReside"]="N/A";
		if(!$_POST["ParroquiaReside"])
			$_POST["ParroquiaReside"]="N/A";
		if(!$_POST["LocalidadReside"])
			$_POST["LocalidadReside"]="N/A";
		if(!$_POST["UrbanizacionSectorZonaIndustrial"])
			$_POST["UrbanizacionSectorZonaIndustrial"]="N/A";
		if(!$_POST["AvenidaCarreraEsquina"])
			$_POST["AvenidaCarreraEsquina"]="N/A";
		if(!$_POST["EdificioQuintaGalpon"])
			$_POST["EdificioQuintaGalpon"]="N/A";
		if(!$_POST["PisoPlantaLocal"])
			$_POST["PisoPlantaLocal"]="N/A";
		if(!$_POST["PuntoReferencia"])
			$_POST["PuntoReferencia"]="N/A";
		if(!$_POST["TlfDomicilio"])
			$_POST["TlfDomicilio"]=0;
		if(!$_POST["DesdeCuandoFuma"])
			$_POST["DesdeCuandoFuma"]=0;
		if(!$_POST["CigarrillosDia"])
			$_POST["CigarrillosDia"]=0;
		if(!$_POST["AlcoholSemana"])
			$_POST["AlcoholSemana"]=0;
		if(!$_POST["OtrosEstiloVida"])
			$_POST["OtrosEstiloVida"]="N/A";
		if(!$_POST["OtrasPatologias"])
			$_POST["OtrasPatologias"]="N/A";
		if(!$_POST["Observaciones"])
			$_POST["Observaciones"]="N/A";


		if($_POST["Sexo"]=="Femenino")
			$_POST["InicioCrecimientoTesticular"]="0";
		else if($_POST["Sexo"]=="Masculino"){
			$_POST["Telarquia"]=0;
			$_POST["Menarquia"]=0;
			$_POST["CicloMenstrual"]=0;
			$_POST["Anticoncepcion"]="FALSE";
			$_POST["ACO"]="FALSE";
			$_POST["DIU"]="FALSE";
			$_POST["OtroAnticonceptivo"]="FALSE";
			$_POST["NroGestas"]=0;
			$_POST["NroPartos"]=0;
			$_POST["NroCesareas"]=0;
			$_POST["NroAbortos"]=0;
			$_POST["LegradoUterino"]="FALSE";
		}

		if($_POST["Pe_flag"]==0){
			$_POST["CarnetPrenatal"]=0;
			$_POST["NroConsultasPrenatal"]=0;
			$_POST["NombreMadre"]="N/A";
			$_POST["NombrePadre"]="N/A";
			$_POST["TrastornosEmbarazo"]="FALSE";
			$_POST["EmbarazoATermino"]="FALSE";
			$_POST["PartoUnicoEspontaneo"]="FALSE";
			$_POST["PartoForceps"]="FALSE";
			$_POST["ComplicacionesParto"]="FALSE";
			$_POST["ComplicacionesPuerperio"]="FALSE";
			$_POST["TrastornosRecienNacido"]="FALSE";
			$_POST["Reanimacion"]="FALSE";
			$_POST["PesoAlNacer"]=0;
			$_POST["TallaAlNacer"]=0;
			$_POST["PerimetroCefalico"]=0;
			$_POST["LactanciaExclusiva"]=0;
			$_POST["LactanciaMixta"]=0;
			$_POST["Ablactacion"]=0;
			$_POST["EgresoRecienNacidoPatologico"]="FALSE";
			$_POST["Asfixia"]="FALSE";
			$_POST["EgresoRecienNacidoSano"]="FALSE";
		}


		if($_POST["Ps_flag"]==0){
			$_POST["Cabeza"]=0;
			$_POST["Social"]=0;
			$_POST["SeSento"]=0;
			$_POST["Gateo"]=0;
			$_POST["SeParo"]=0;
			$_POST["Camino"]=0;
			$_POST["Comio"]=0;
			$_POST["Palabras"]=0;
			$_POST["ControlEsfinterVesical"]=0;
			$_POST["ControlEsfinterAnal"]=0;
		}
        
        foreach ($_POST as $clave => $valor){
            if($cont == $len - 1)
                $columnas .= sprintf('%s) ', $clave);
            else
                $columnas .= sprintf('%s,', $clave);
            if($clave != "Cedula" && $clave != "Pasaporte" && $clave != "TlfMovil" && $clave != "TlfCasa" && $clave != "CodigoPostal") 
                if($cont == $len - 1)
                    $valores .= sprintf('\'%s\');', $valor);
                else
                    $valores .= sprintf('\'%s\',', $valor);
            else if($cont == $len - 1)
                    $valores .= sprintf('\'%s\');', $valor);
            else
                    $valores .= sprintf('\'%s\',', $valor);   
            $cont++;
        }
  
        $query = $columnas . $valores;
        
        if(pg_query($query)) {
            $msg['codigo'] = 1;
        } else {
            $msg['codigo'] = 2;
        }
        
        pg_close($conexion);
    }
}
echo json_encode($msg);
?>
<?php

	$db=pg_connect("host=localhost port=5432 dbname=historias_clinicas user=postgres password=20506388");
	if (!$db){
		echo "Error en la conexion.\n";
    	exit;
	} 

		if(!$_POST["Pasaporte"])
			$_POST["Pasaporte"]=0;
		if(!$_POST["SegundoApellido"])
			$_POST["SegundoApellido"]="N/A";
		if(!$_POST["SegundoNombre"])
			$_POST["SegundoNombre"]="N/A";
		if(!$_POST["Etnia"])
			$_POST["Etnia"]="N/A";
		if(!$_POST["Profesion"])
			$_POST["Proseion"]="N/A";
		if(!$_POST["CorreoElectronico"])
			$_POST["CorreoElectronico"]="N/A";
		if(!$_POST["MunicipioReside"])
			$_POST["MunicipioReside"]="N/A";
		if(!$_POST["ParroquiaReside"])
			$_POST["ParroquiaReside"]="N/A";
		if(!$_POST["LocalidadReside"])
			$_POST["LocalidadReside"]="N/A";
		if(!$_POST["UrbanizacionSectorZonaIndustrial"])
			$_POST["UrbanizacionSectorZonaIndustrial"]="N/A";
		if(!$_POST["AvenidaCarreraEsquina"])
			$_POST["AvenidaCarreraEsquina"]="N/A";
		if(!$_POST["EdificioQuintaGalpon"])
			$_POST["EdificioQuintaGalpon"]="N/A";
		if(!$_POST["PisoPlantaLocal"])
			$_POST["PisoPlantaLocal"]="N/A";
		if(!$_POST["PuntoReferencia"])
			$_POST["PuntoReferencia"]="N/A";
		if(!$_POST["TlfDomicilio"])
			$_POST["TlfDomicilio"]=0;
		if(!$_POST["DesdeCuandoFuma"])
			$_POST["DesdeCuandoFuma"]=0;
		if(!$_POST["CigarrillosDia"])
			$_POST["CigarrillosDia"]=0;
		if(!$_POST["AlcoholSemana"])
			$_POST["AlcoholSemana"]=0;
		if(!$_POST["OtrosEstiloVida"])
			$_POST["OtrosEstiloVida"]="N/A";
		if(!$_POST["OtrasPatologias"])
			$_POST["OtrasPatologias"]="N/A";
		if(!$_POST["Observaciones"])
			$_POST["Observaciones"]="N/A";


		if($_POST["Sexo"]=="Femenino"){
			$_POST["InicioCrecimientoTesticular"]="0";

			echo $_POST["InicioCrecimientoTesticular"];
			echo " femenino";
		} else
		if($_POST["Sexo"]=="Masculino"){
			$_POST["Telarquia"]=0;
			$_POST["Menarquia"]=0;
			$_POST["CicloMenstrual"]=0;
			$_POST["Anticoncepcion"]="FALSE";
			$_POST["ACO"]="FALSE";
			$_POST["DIU"]="FALSE";
			$_POST["OtroAnticonceptivo"]="FALSE";
			$_POST["NroGestas"]=0;
			$_POST["NroPartos"]=0;
			$_POST["NroCesareas"]=0;
			$_POST["NroAbortos"]=0;
			$_POST["LegradoUterino"]="FALSE";
		}

		if($_POST["Pe_flag"]==0){
			$_POST["CarnetPrenatal"]=0;
			$_POST["NroConsultasPrenatal"]=0;
			$_POST["NombreMadre"]="N/A";
			$_POST["NombrePadre"]="N/A";
			$_POST["TrastornosEmbarazo"]="FALSE";
			$_POST["EmbarazoATermino"]="FALSE";
			$_POST["PartoUnicoEspontaneo"]="FALSE";
			$_POST["PartoForceps"]="FALSE";
			$_POST["ComplicacionesParto"]="FALSE";
			$_POST["ComplicacionesPuerperio"]="FALSE";
			$_POST["TrastornosRecienNacido"]="FALSE";
			$_POST["Reanimacion"]="FALSE";
			$_POST["PesoAlNacer"]=0;
			$_POST["TallaAlNacer"]=0;
			$_POST["PerimetroCefalico"]=0;
			$_POST["LactanciaExclusiva"]=0;
			$_POST["LactanciaMixta"]=0;
			$_POST["Ablactacion"]=0;
			$_POST["EgresoRecienNacidoPatologico"]="FALSE";
			$_POST["Asfixia"]="FALSE";
			$_POST["EgresoRecienNacidoSano"]="FALSE";
		}


		if($_POST["Ps_flag"]==0){
			$_POST["Cabeza"]=0;
			$_POST["Social"]=0;
			$_POST["SeSento"]=0;
			$_POST["Gateo"]=0;
			$_POST["SeParo"]=0;
			$_POST["Camino"]=0;
			$_POST["Comio"]=0;
			$_POST["Palabras"]=0;
			$_POST["ControlEsfinterVesical"]=0;
			$_POST["ControlEsfinterAnal"]=0;
		}

	$query = pg_query ("
		INSERT INTO \"Paciente\" (
			\"Nacionalidad\",
			\"Cedula\",
			\"Pasaporte\",
			\"PrimerApellido\",
			\"SegundoApellido\",
			\"PrimerNombre\",
			\"SegundoNombre\",
			\"Etnia\",
			\"FechaNacimiento\",
			\"Sexo\",
			\"PaisNacimiento\",
			\"SituacionConyugal\",
			\"Analfabeta\",
			\"Educacion\",
			\"Profesion\",
			\"Ocupacion\",
			\"SeguridadSocial\",
			\"CorreoElectronico\",
			\"EstadoReside\",
			\"CiudadReside\",
			\"MunicipioReside\",
			\"ParroquiaReside\",
			\"LocalidadReside\",
			\"Urbanizacion/Sector/ZonaIndustrial\",
			\"Avenida/Carrera/Esquina\",
			\"Edificio/Quinta/Galpon\",
			\"Piso/Planta/Local\",
			\"CodigoPostal\",
			\"PuntoReferencia\",
			\"TlfDomicilio\",
			\"TlfMovil\",
			\"CarnetPrenatal\",
			\"NroConsultasPrenatal\",
			\"NombrePadre\",
			\"NombreMadre\",
			\"TrastornosEmbarazo\",
			\"EmbarazoATermino\",
			\"PartoUnicoEspontaneo\",
			\"PartoForceps\",
			\"ComplicacionesParto\",
			\"ComplicacionesPuerperio\",
			\"TrastornosRecienNacido\",
			\"Reanimacion\",
			\"PesoAlNacer\",
			\"TallaAlNacer\",
			\"PerimetroCefalico\",
			\"LactanciaExclusiva\",
			\"LactanciaMixta\",
			\"Ablactacion\",
			\"EgresoRecienNacidoPatologico\",
			\"Asfixia\",
			\"EgresoRecienNacidoSano\",
			\"Telarquia\",
			\"Pubarquia\",
			\"Menarquia\",
			\"InicioCrecimientoTesticular\",
			\"CicloMenstrual\",
			\"PrimeraRelacionSexual\",
			\"FrecuenciaRelacionesSexualesMes\",
			\"NroParejasUltimoAnio\",
			\"RelSexualSatisfactoria\",
			\"Anticoncepcion\",
			\"ACO\",
			\"DIU\",
			\"OtroAnticonceptivo\",
			\"NroGestas\",
			\"NroPartos\",
			\"NroCesareas\",
			\"NroAbortos\",
			\"LegradoUterino\",
			\"Menopausia/Andropausia\",
			\"OtrosAntecedentesSexuales\",
			\"Fuma\",
			\"DesdeCuandoFuma\",
			\"CigarrillosDia\",
			\"Alcohol\",
			\"AlcoholSemana\",
			\"DrogasIlicitas\",
			\"ActividadFisica\",
			\"Sedentarismo\",
			\"ManejoEstres\",
			\"OtrosEstiloVida\",
			\"TumorBenigno\",
			\"TumorMaligno\",
			\"EnfEruptivas\",
			\"ITS\",
			\"Meningitis\",
			\"Chagas\",
			\"Tuberculosis\",
			\"Dengue\",
			\"Hansen\",
			\"Leishmaniasis\",
			\"Leptospirosis\",
			\"Malaria\",
			\"Desnutricion\",
			\"Diabetes\",
			\"Dislipidemias\",
			\"Obesidad\",
			\"TrastornoApetito\",
			\"Enuresis\",
			\"ChupaDedo\",
			\"Onicofagia\",
			\"TrastornoLlanto\",
			\"HTASistemica\",
			\"Tromboembolismo\",
			\"Varices\",
			\"Cardiopatia\",
			\"Asma\",
			\"Neumonia\",
			\"Gastroenteropatias\",
			\"Hepatopatias\",
			\"TrastornosEvacuacion\",
			\"Colagenopatias\",
			\"Artritis\",
			\"TrastornosMiccionales\",
			\"EnfermedadRenal\",
			\"Alergias\",
			\"TrastornosSuenio\",
			\"ViolenciaPsicologica\",
			\"ViolenciaFisica\",
			\"ViolenciaSexual\",
			\"Accidentes\",
			\"OtrasPatologias\",
			\"GrupoSanguineo\",
			\"Hospitalizacion\",
			\"IntervencionQuirurgica\",
			\"Observaciones\",
			\"Cabeza\",
			\"Social\",
			\"SeSento\",
			\"Gateo\",
			\"SeParo\",
			\"Camino\",
			\"Comio\",
			\"Palabras\",
			\"ControlEsfinterVesical\",
			\"ControlEsfinterAnal\",
			\"Ficha\"
		)

		VALUES (
			'".$_POST['Nacionalidad']."',
			".$_POST['Cedula'].",
			".$_POST['Pasaporte'].",
			'".$_POST['PrimerApellido']."',
			'".$_POST['SegundoApellido']."',
			'".$_POST['PrimerNombre']."',
			'".$_POST['SegundoNombre']."',
			'".$_POST['Etnia']."',
			'".$_POST['AnioN']."-".$_POST['MesN']."-".$_POST['DiaN']."',
			'".$_POST['Sexo']."',
			'".$_POST['PaisNacimiento']."',
			'".$_POST['SituacionConyugal']."',
			".$_POST['Analfabeta'].",
			'".$_POST['Educacion']."',
			'".$_POST['Profesion']."',
			'".$_POST['Ocupacion']."',
			".$_POST['SeguridadSocial'].",
			'".$_POST['CorreoElectronico']."',
			'".$_POST['EstadoReside']."',
			'".$_POST['CiudadReside']."',
			'".$_POST['MunicipioReside']."',
			'".$_POST['ParroquiaReside']."',
			'".$_POST['LocalidadReside']."',
			'".$_POST['UrbanizacionSectorZonaIndustrial']."',
			'".$_POST['AvenidaCarreraEsquina']."',
			'".$_POST['EdificioQuintaGalpon']."',
			'".$_POST['PisoPlantaLocal']."',
			".$_POST['CodigoPostal'].",
			'".$_POST['PuntoReferencia']."',
			".$_POST['TlfDomicilio'].",
			".$_POST['TlfMovil'].",
			'".$_POST['CarnetPrenatal']."',
			".$_POST['NroConsultasPrenatal'].",
			'".$_POST['NombrePadre']."',
			'".$_POST['NombreMadre']."',
			".$_POST['TrastornosEmbarazo'].",
			".$_POST['EmbarazoATermino'].",
			".$_POST['PartoUnicoEspontaneo'].",
			".$_POST['PartoForceps'].",
			".$_POST['ComplicacionesParto'].",
			".$_POST['ComplicacionesPuerperio'].",
			".$_POST['TrastornosRecienNacido'].",
			".$_POST['Reanimacion'].",
			".$_POST['PesoAlNacer'].",
			".$_POST['TallaAlNacer'].",
			".$_POST['PerimetroCefalico'].",
			".$_POST['LactanciaExclusiva'].",
			".$_POST['LactanciaMixta'].",
			".$_POST['Ablactacion'].",
			".$_POST['EgresoRecienNacidoPatologico'].",
			".$_POST['Asfixia'].",
			".$_POST['EgresoRecienNacidoSano'].",
			".$_POST['Telarquia'].",
			".$_POST['Pubarquia'].",
			".$_POST['Menarquia'].",
			".$_POST['InicioCrecimientoTesticular'].",
			".$_POST['CicloMenstrual'].",
			".$_POST['PrimeraRelacionSexual'].",
			".$_POST['FrecuenciaRelacionesSexualesMes'].",
			".$_POST['NroParejasUltimoAnio'].",
			".$_POST['RelSexualSatisfactoria'].",
			".$_POST['Anticoncepcion'].",
			".$_POST['ACO'].",
			".$_POST['DIU'].",
			'".$_POST['OtroAnticonceptivo']."',
			".$_POST['NroGestas'].",
			".$_POST['NroPartos'].",
			".$_POST['NroCesareas'].",
			".$_POST['NroAbortos'].",
			".$_POST['LegradoUterino'].",
			".$_POST['MenopausiaAndropausia'].",
			'".$_POST['OtrosAntecedentesSexuales']."',
			".$_POST['Fuma'].",
			".$_POST['DesdeCuandoFuma'].",
			".$_POST['CigarrillosDia'].",
			".$_POST['Alcohol'].",
			".$_POST['AlcoholSemana'].",
			".$_POST['DrogasIlicitas'].",
			".$_POST['ActividadFisica'].",
			".$_POST['Sedentarismo'].",
			".$_POST['ManejoEstres'].",
			'".$_POST['OtrosEstiloVida']."',
			".$_POST['TumorBenigno'].",
			".$_POST['TumorMaligno'].",
			".$_POST['EnfEruptivas'].",
			".$_POST['ITS'].",
			".$_POST['Meningitis'].",
			".$_POST['Chagas'].",
			".$_POST['Tuberculosis'].",
			".$_POST['Dengue'].",
			".$_POST['Hansen'].",
			".$_POST['Leishmaniasis'].",
			".$_POST['Leptospirosis'].",
			".$_POST['Malaria'].",
			".$_POST['Desnutricion'].",
			".$_POST['Diabetes'].",
			".$_POST['Dislipidemias'].",
			".$_POST['Obesidad'].",
			".$_POST['TrastornoApetito'].",
			".$_POST['Enuresis'].",
			".$_POST['ChupaDedo'].",
			".$_POST['Onicofagia'].",
			".$_POST['TrastornoLlanto'].",
			".$_POST['HTASistemica'].",
			".$_POST['Tromboembolismo'].",
			".$_POST['Varices'].",
			".$_POST['Cardiopatia'].",
			".$_POST['Asma'].",
			".$_POST['Neumonia'].",
			".$_POST['Gastroenteropatias'].",
			".$_POST['Hepatopatias'].",
			".$_POST['TrastornosEvacuacion'].",
			".$_POST['Colagenopatias'].",
			".$_POST['Artritis'].",
			".$_POST['TrastornosMiccionales'].",
			".$_POST['EnfermedadRenal'].",
			".$_POST['Alergias'].",
			".$_POST['TrastornosSuenio'].",
			".$_POST['ViolenciaPsicologica'].",
			".$_POST['ViolenciaFisica'].",
			".$_POST['ViolenciaSexual'].",
			".$_POST['Accidentes'].",
			'".$_POST['OtrasPatologias']."',
			'".$_POST['GrupoSanguineo']."',
			".$_POST['Hospitalizacion'].",
			".$_POST['IntervencionQuirurgica'].",
			'".$_POST['Observaciones']."',
			".$_POST['Cabeza'].",
			".$_POST['Social'].",
			".$_POST['SeSento'].",
			".$_POST['Gateo'].",
			".$_POST['SeParo'].",
			".$_POST['Camino'].",
			".$_POST['Comio'].",
			".$_POST['Palabras'].",
			".$_POST['ControlEsfinterVesical'].",
			".$_POST['ControlEsfinterAnal'].",
			1
		)"
	);

	if($query)
		echo "Ingreso de paciente exitoso";
	else {
		echo "Hubo un error en el ingreso de paciente<br>";
		echo pg_last_error();
	}
	pg_close($db);


?>