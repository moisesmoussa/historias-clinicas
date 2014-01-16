<?php
require_once('../config.php');
session_start();

$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");

$msg = array();
$usuario = '';
if(isset($_SESSION['administrador']))
    $usuario = $_SESSION['administrador'];
else if(isset($_SESSION['medico']))
    $usuario = $_SESSION['medico'];
else if(isset($_SESSION['enfermera']))
    $usuario = $_SESSION['enfermera'];

$query = pg_query("SELECT * FROM usuario WHERE nombreusuario = '".$usuario."'");

if(($resultado = pg_fetch_array($query))){
    $msg['flag'] = 1;
    $msg['usuario'] = $resultado;
}else
    $msg['flag'] = 0;

pg_close($conexion);

echo json_encode($msg);
?>