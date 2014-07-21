<?php
/* Códigos:
    0 = No se pudo encontrar el usuario indicado en la BD
    1 = Usuario encontrado en la BD
*/
session_start();
$msg = NULL;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    require_once('../config.php');
    $conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Error de conexión con la base de datos");

    $msg = array();

    $query = pg_query("SELECT * FROM usuario WHERE id = ".$_POST['usuario']);

    if(($resultado = pg_fetch_array($query))){
        $msg['flag'] = 1;
        $msg['usuario'] = $resultado;
        $msg['usuario']['fecha_nacimiento'] = date("d-m-Y", strtotime($msg['usuario']['fecha_nacimiento']));
        $msg['usuario']['fecha_ingreso'] = date("d-m-Y", strtotime($msg['usuario']['fecha_ingreso']));
    }else
        $msg['flag'] = 0;

    pg_close($conexion);
}
echo json_encode($msg);
?>
