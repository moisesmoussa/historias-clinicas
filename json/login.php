<?php
/* Códigos:
    0 = Usuario o clave inválida en el inicio de sesion
    1 = Se ha iniciado la sesión del usuario correctamente
    2 = Error consultando en la base de datos
*/
$msg['flag'] = 2;

require_once('../config.php');
$conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

$query = 'SELECT id, nombre_usuario, tipo_usuario FROM usuario WHERE nombre_usuario = \''.$_POST['nombre'].'\' AND clave = \''.md5($_POST['clave']).'\'';

if($login_query = pg_query($query)){
    $resultado = pg_fetch_assoc($login_query);
    
    if(!empty($resultado['id'])){
        session_start();
        $_SESSION[strtolower(str_replace(' ', '_', $resultado['tipo_usuario']))] = $resultado['id'];
        $_SESSION['nombre_usuario'] = $resultado['nombre_usuario'];
        $msg['msg'] = '/pages';
        $msg['flag'] = 1;
        
    } else {
        $msg['msg'] = 'Usuario o clave inválida';
        $msg['flag'] = 0;
    }
} else {
    $msg['flag'] = 2;
}
pg_close($conexion);

echo json_encode($msg);
?>
