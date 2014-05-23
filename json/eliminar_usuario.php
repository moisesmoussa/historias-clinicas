<?php
/* Códigos:
    0 = No se pudo eliminar el usuario indicado en la BD
    1 = Usuario eliminado correctamente en la BD
*/
require_once('../config.php');
session_start();

$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");

$query = pg_query("DELETE FROM usuario WHERE id = ".$_POST['usuario']);

if($query)
    $msg = 1;
else
    $msg = 0;

pg_close($conexion);

echo json_encode($msg);
?>