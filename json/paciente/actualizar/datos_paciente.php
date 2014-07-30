<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Datos personales del paciente actualizados correctamente en la BD
    2 = Los datos personales del paciente no se pudieron actualizar en la BD
    3 = No posee permisos para realizar la operación
*/
session_start();
$msg['codigo'] = 3;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    $flag = 1;
    
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }

    if($flag){
        $_POST['fecha_nacimiento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_nacimiento'])));
        
        require_once('../../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        if(isset($_SESSION['super_administrador']))
            $id_usuario = $_SESSION['super_administrador'];
        else if(isset($_SESSION['administrador']))
            $id_usuario = $_SESSION['administrador'];
        else if(isset($_SESSION['general']))
            $id_usuario = $_SESSION['general'];
                
        date_default_timezone_set('Etc/GMT+4');
        $columnas = 'UPDATE paciente SET (fecha_ua, usuario_ua, ';
        $valores = '= (\''.date('Y-m-d').'\', '.$id_usuario.', ';
        $id_paciente = $_POST['id_paciente'];
        unset($_POST['id_paciente']);                
        $len = count($_POST);
        $cont = 0;
            
        foreach ($_POST as $clave => $valor){
            if($cont == $len - 1) {
                $columnas .= $clave.') ';
                $valores .= '\''.$valor.'\') WHERE id = '.$id_paciente.';';
                
            } else {
                $columnas .= $clave.',';
                $valores .= '\''.$valor.'\',';
            }
            $cont++;
        }
        $query = $columnas . $valores;

        if(pg_query($query)) {
            $msg['codigo'] = 1;
        } else {
            $msg['codigo'] = 2;
        }
        pg_close($conexion);
        
    } else{
        $msg['codigo'] = 0;
    }
}
echo json_encode($msg);
?>