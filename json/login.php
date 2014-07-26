<?php
/* Códigos:
    0 = Usuario o clave inválida en el inicio de sesion
    1 = Se ha iniciado la sesión del usuario correctamente
*/
$msg = NULL;

require_once('../config.php');
$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Error de conexión con la base de datos");

$query = "SELECT id, nombre_usuario, tipo_usuario FROM usuario WHERE nombre_usuario = '".$_POST['nombre']."' AND clave = '".md5($_POST['clave'])."'";
if($login_query = pg_query($query)){
    $msg = array();
    $resultado = pg_fetch_array($login_query);
    session_start();
    $_SESSION[strtolower(str_replace(' ', '_', $resultado['tipo_usuario']))] = $resultado['id'];
    $_SESSION['nombre_usuario'] = $resultado['nombre_usuario'];
    
    if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']))
        $modulo = '/administrador';
    else
        $modulo = '/general';
    
    $msg['msg'] = $modulo;
    $msg['flag'] = 1;
} else{
    $msg['msg'] = "Usuario o clave inválida";
    $msg['flag'] = 0;
}
pg_close($conexion);

echo json_encode($msg);
?>
