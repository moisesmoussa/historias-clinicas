<?php
/* Códigos:
    0 = No coincide la contraseña nueva
    1 = No se pudo encontrar la clave del usuario indicado en la BD
    2 = No coincide la contraseña actual
    3 = No se pudo actualizar la contraseña en la BD
    4 = Se actualizó la contraseña en la BD
*/
session_start();
$msg = NULL;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $usuario = '';
    
    if(isset($_SESSION['super_administrador']))
        $usuario = $_SESSION['super_administrador'];
    else if(isset($_SESSION['administrador']))
        $usuario = $_SESSION['administrador'];
    else if(isset($_SESSION['general']))
        $usuario = $_SESSION['general'];

    if($_POST['clave_nueva'] == $_POST['clave_nueva2']){
        $select = 'SELECT clave FROM usuario WHERE id = '.$usuario;
        if($query = pg_query($select)){
            $resultado = pg_fetch_assoc($query);
            if(!empty($resultado['clave'])){
                if($resultado['clave'] == md5($_POST['clave_actual']))
                    if(pg_query('UPDATE usuario SET clave = \''.md5($_POST['clave_nueva']).'\' WHERE id = '.$usuario))
                        $msg['flag'] = 4;
                    else
                        $msg['flag'] = 3;
                else
                    $msg['flag'] = 2;
            } else{
                $msg['flag'] = 1;
            }
        }
        pg_close($conexion);
    } else{
        $msg['flag'] = 0;
    }
}
echo json_encode($msg);
?>
