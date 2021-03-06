<?php
/* Códigos:
    0 = No se pudo eliminar el o los usuario(s) indicado(s) en la BD
    1 = Usuario(s) eliminado(s) correctamente en la BD
    2 = No posee permisos para eliminar usuarios
*/
session_start();
$msg['msg'] = 'No posee permisos para eliminar usuarios';
$msg['flag'] = 2;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $cont = 0;
    $flag = true;
    
    foreach ($_POST['usuario'] as $valor)
        $query[$cont++] = 'DELETE FROM usuario WHERE id = '.$valor;
    
    foreach($query as $valor)
        if(!pg_query($valor))
            $flag = false;
        
    if($flag){
        $msg['msg'] = (count($_POST['usuario']) === 1) ? 'Usuario eliminado exitosamente' : 'Usuarios indicados eliminados exitosamente';
        $msg['flag'] = 1;
            
    } else {
        $msg['msg'] = 'Error con la base de datos, ';
        
        if(count($_POST['usuario']) === 1){
            $msg['msg'] .= 'no se pudo eliminar el usuario';
            $msg['flag'] = 0;
        } else {
            $msg['msg'] .= 'no se pudieron eliminar alguno(s) o todos los usuarios indicados, por favor verifique';
            $msg['flag'] = 1;
        }
    }
    pg_close($conexion);
}
echo json_encode($msg);
?>