<?php
require_once('../config.php');
$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");

$msg = array();
$login_query = pg_query("SELECT nombreusuario, tipousuario FROM usuario WHERE nombreusuario = '".$_POST['usuario']."' AND clave = '".md5($_POST['clave'])."'");

if(($resultado = pg_fetch_array($login_query)))
    
pg_close($conexion);

echo json_encode($msg);
?>