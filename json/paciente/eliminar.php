<?php
/* Códigos:
    0 = No se pudo eliminar el paciente indicado en la BD
    1 = Paciente eliminado correctamente en la BD
    2 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para eliminar el paciente';
$msg['flag'] = 2;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $query = 'DELETE FROM paciente WHERE id = '.$_POST['paciente'];
    
    if(pg_query($query)){
        $msg['msg'] = 'Paciente eliminado exitosamente';
        $msg['flag'] = 1;
    } else {
        $msg['msg'] = 'Error con la base de datos, no se pudo eliminar el paciente';
        $msg['flag'] = 0;
    }
    pg_close($conexion);
}
echo json_encode($msg);
?>