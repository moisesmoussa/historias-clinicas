<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Paciente insertado correctamente en la BD
    2 = El paciente no se pudo insertar en la BD
*/
session_start();
$msg = NULL;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    $flag = 1;
    
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }
    
    if($flag){     
        require_once('../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        if($query = pg_query('SELECT sexo FROM paciente WHERE id = '.$_POST['id_paciente'])){
            $respuesta = pg_fetch_array($query);
            if($respuesta['sexo'] == 'Masculino'){
                $columnas = 'INSERT INTO antecedentes_sexuales_hombre (';
                $valores = 'VALUES (';
            }else{
                $columnas = 'INSERT INTO antecedentes_sexuales_mujer (';
                $valores = 'VALUES (';
            }
            
            if(isset($_SESSION['super_administrador'])){
                $id_usuario = $_SESSION['super_administrador'];
            }else if(isset($_SESSION['administrador'])){
                $id_usuario = $_SESSION['administrador'];
            }else if(isset($_SESSION['general'])){
                $id_usuario = $_SESSION['general'];
            }

            date_default_timezone_set('Etc/GMT+4');
            $columnas_general = 'INSERT INTO antecedentes_sexuales (fecha_ua, usuario_ua, creador, ';
            $valores_general = 'VALUES (\''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', ';
            $antecedentes_sexuales_g['id_paciente'] = $_POST['id_paciente'];

            foreach ($_POST as $clave => $valor){
                if($clave == 'primera_relacion_sexual' || $clave == 'frecuencia_relaciones_sexuales_mes' || $clave == 'num_parejas_ultimo_anio' || $clave == 'relacion_sexual_satisfactoria' || $clave == 'anticonceptivo' || $clave == 'otros_antecedentes_sexuales' || $clave == 'pubarquia'){
                    $antecedentes_sexuales_g[$clave] = $valor;
                    unset($_POST[$clave]);
                }
            }
            
            $len = count($antecedentes_sexuales_g);
            $cont = 0;
            foreach ($antecedentes_sexuales_g as $clave => $valor){
                if($cont == $len - 1){
                    $columnas_general .= sprintf('%s) ', $clave);
                    $valores_general .= sprintf('\'%s\');', $valor);
                }
                else {
                    $columnas_general .= sprintf('%s,', $clave);
                    $valores_general .= sprintf('\'%s\',', $valor);
                }
                $cont++;
            }
            
            $len = count($_POST);
            $cont = 0;
            foreach ($_POST as $clave => $valor){
                if($cont == $len - 1){
                    $columnas .= sprintf('%s) ', $clave);
                    $valores .= sprintf('\'%s\');', $valor);
                }
                else {
                    $columnas .= sprintf('%s,', $clave);
                    $valores .= sprintf('\'%s\',', $valor);
                }
                $cont++;
            }

            $query_general = $columnas_general . $valores_general;
            $query = $columnas . $valores;

            if(pg_query($query_general) && pg_query($query)) {
                $msg['codigo'] = 1;
            } else {
                $msg['codigo'] = 2;
            }
        }
        pg_close($conexion);
    } else{
        $msg['codigo'] = 0;
    }
}
echo json_encode($msg);
?>