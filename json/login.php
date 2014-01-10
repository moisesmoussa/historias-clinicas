<?php
require_once('../config.php');
$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");

$msg = array();
$login_query = pg_query("SELECT nombreusuario, tipousuario FROM usuario WHERE nombreusuario = '".$_POST['usuario']."' AND clave = '".md5($_POST['clave'])."'");

if(($resultado = pg_fetch_array($login_query))){
    session_start();
    $_SESSION[strtolower($resultado['tipousuario'])] = $resultado['nombreusuario'];
    $msg['flag'] = 1;
    $msg['msg'] = '/'.strtolower($resultado['tipousuario']);
}
else{
    $msg['flag'] = 0;
    $msg['msg'] = "Usuario o clave inválida";
}

pg_close($conexion);

echo json_encode($msg);
?>