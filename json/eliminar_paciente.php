<?php
/* Códigos:
    0 = No se pudo eliminar el usuario indicado en la BD
    1 = Usuario eliminado correctamente en la BD
*/
session_start();
$msg = NULL;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    require_once('../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $query = 'DELETE FROM paciente WHERE id = '.$_POST['paciente'];
    
    if(pg_query($query))
        $msg = 1;
    else
        $msg = 0;

    pg_close($conexion);
}
echo json_encode($msg);
?>