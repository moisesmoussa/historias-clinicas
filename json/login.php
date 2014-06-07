<?php
/* Códigos:
    0 = Usuario o clave inválida en el inicio de sesion
    1 = Se ha iniciado la sesión del usuario correctamente
*/
require_once('../config.php');
$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Error de conexión con la base de datos");

$msg = array();
$login_query = pg_query("SELECT id, nombre_usuario, tipo_usuario FROM usuario WHERE nombre_usuario = '".$_POST['usuario']."' AND clave = '".md5($_POST['clave'])."'");

if(($resultado = pg_fetch_array($login_query))){
    session_start();
    $_SESSION[strtolower(str_replace(' ', '_', $resultado['tipo_usuario']))] = $resultado['id'];
    $_SESSION['nombre'] = $resultado['nombre_usuario'];
    $msg['flag'] = 1;
    if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']))
        $modulo = '/administrador';
    else
        $modulo = '/'.strtolower($resultado['tipo_usuario']);
    $msg['msg'] = $modulo;
}
else{
    $msg['flag'] = 0;
    $msg['msg'] = "Usuario o clave inválida";
}

pg_close($conexion);

echo json_encode($msg);
?>
