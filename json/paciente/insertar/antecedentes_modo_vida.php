<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Antecedentes de modo de vida insertados correctamente en la BD
    2 = Los antecedentes de modo de vida no se pudieron insertar en la BD
    3 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para agregar datos de un paciente';
$msg['flag'] = 3;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    $flag = 1;
        
    foreach ($_POST as $clave => $valor){
        if(!isset($valor) || empty($valor)){
            if($clave != 'otros_estilos_vida'){
                $flag = 0;
                break;
            } else {
                unset($_POST[$clave]);
            }
        }
    }
    if(!isset($_POST['fuma_desde']))
        $_POST['fuma_desde'] = 0;
    if(!isset($_POST['cigarrillos_diarios']))
        $_POST['cigarrillos_diarios'] = 0;
    if(!isset($_POST['alcohol_semanal']))
        $_POST['alcohol_semanal'] = 0;
    
    if($flag){     
        require_once('../../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        if(isset($_SESSION['super_administrador']))
            $id_usuario = $_SESSION['super_administrador'];
        else if(isset($_SESSION['administrador']))
            $id_usuario = $_SESSION['administrador'];
        else if(isset($_SESSION['general']))
            $id_usuario = $_SESSION['general'];

        date_default_timezone_set('Etc/GMT+4');
        $columnas = 'INSERT INTO antecedentes_modo_vida (fecha_ua, usuario_ua, creador, ';
        $valores = 'VALUES (\''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', ';
        $len = count($_POST);
        $cont = 0;

        foreach ($_POST as $clave => $valor){
            if($cont === $len - 1){
                $columnas .= $clave.') ';
                $valores .= '\''.$valor.'\');';
                
            } else {
                $columnas .= $clave.',';
                $valores .= '\''.$valor.'\',';
            }
            $cont++;
        }
        $query = $columnas . $valores;
        
        if(pg_query($query)) {
            $msg['msg'] = 'Datos del paciente agregados exitosamente';
            $msg['flag'] = 1;
        } else {
            $msg['msg'] = 'Error con la base de datos, no se pudieron agregar los datos del paciente';
            $msg['flag'] = 2;
        }
        pg_close($conexion);
            
    } else{
        $msg['msg'] = 'Debe llenar todos los campos';
        $msg['flag'] = 0;
    }
}
echo json_encode($msg);
?>