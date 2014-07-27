<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Usuario actualizado correctamente en la BD
    2 = El usuario no se pudo actualizar en la BD
*/
session_start();
$msg = NULL;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    $flag = 1;
    
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }

    if($flag){
        $_POST['fecha_nacimiento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_nacimiento'])));
        $_POST['fecha_ingreso'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_ingreso'])));
        
        require_once('../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        if(isset($_SESSION['super_administrador']))
            $usuario_ua = $_SESSION['super_administrador'];
        else if(isset($_SESSION['administrador']))
            $usuario_ua = $_SESSION['administrador'];

        $id_usuario = $_POST['id_usuario'];
        unset($_POST['id_usuario']);
        $columnas = 'UPDATE usuario SET (fecha_ua, usuario_ua, ';
        $valores = '= (\''.date('Y-m-d').'\', '.$usuario_ua.', ';
        $len = count($_POST);
        $cont = 0;

        foreach ($_POST as $clave => $valor){
            if($cont == $len - 1) {
                $columnas .= sprintf('%s) ', $clave);
                $valores .= sprintf('\'%s\') WHERE id = %d;', $valor, $id_usuario);
            }
            else {
                $columnas .= sprintf('%s,', $clave); 
                $valores .= sprintf('\'%s\',', $valor);
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
    }else{
        $msg['codigo'] = 0;
    }
}
echo json_encode($msg);
?>