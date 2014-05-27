<?php
/* Códigos:
    0 = No se pudo encontrar el usuario indicado en la BD
    1 = Usuario encontrado en la BD
*/
require_once('../config.php');
session_start();

$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");

$msg = array();
$usuario = '';
if(isset($_SESSION['super_administrador']))
    $usuario = $_SESSION['super_administrador'];
else if(isset($_SESSION['administrador']))
    $usuario = $_SESSION['administrador'];
else if(isset($_SESSION['general']))
    $usuario = $_SESSION['general'];

$query = pg_query("SELECT * FROM usuario WHERE id = ".$usuario);

if(($resultado = pg_fetch_array($query))){
    $msg['flag'] = 1;
    $msg['usuario'] = $resultado;
    $msg['usuario']['fecha_nacimiento'] = date("d-m-Y", strtotime($msg['usuario']['fecha_nacimiento']));
    $msg['usuario']['fecha_ingreso'] = date("d-m-Y", strtotime($msg['usuario']['fecha_ingreso']));
}else
    $msg['flag'] = 0;

pg_close($conexion);

echo json_encode($msg);
?>
