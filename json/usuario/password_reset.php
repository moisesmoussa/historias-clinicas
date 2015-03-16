<?php
/* Códigos:
    0 = Algún campo está vacío
    1 = Contraseña actualizada exitosamente
    2 = La nueva contraseña no coincide
    3 = Error actualizando la contraseña
    4 = Error consultando en la base de datos
*/
$flag = 1;

foreach ($_POST as $valor)
    if(!isset($valor) || empty($valor)){
        $flag = 0;
        break;
    }

if($flag){
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    if($_POST['new_password'] === $_POST['password_confirmation']) {
        $query = 'SELECT email FROM password_resets WHERE token = \'' . $_POST['token'] . '\'';
        
        if($result = pg_query($query)) {
            if(!empty($email = pg_fetch_assoc($result)['email'])) {
                $query = 'DELETE FROM password_resets WHERE token = \'' . $_POST['token'] . '\'';
            
                if(pg_query($query)) {
                    $query = 'UPDATE usuario SET clave = \'' . md5($_POST['new_password']) . '\' WHERE correo_electronico = \'' . $email . '\'';

                    if(pg_query($query)) {
                        $msg['msg'] = 'Contraseña actualizada exitosamente\\nSerá redirigido al inicio de sesión';
                        $msg['route'] = '/usuarios/login';
                        $msg['flag'] = 1;

                    } else {
                        $msg['msg'] = 'Error actualizando la contraseña';
                        $msg['flag'] = 3;
                    }
                } else {
                    $msg['msg'] = 'Error consultando en la base de datos';
                    $msg['flag'] = 4;
                }
            } else {
                $msg['msg'] = 'Error consultando en la base de datos';
                $msg['flag'] = 4;
            }
        } else {
            $msg['msg'] = 'Error consultando en la base de datos';
            $msg['flag'] = 4;
        }
    } else {
        $msg['msg'] = 'La contraseña nueva no coincide';
        $msg['flag'] = 2;
    }
    pg_close($conexion);
    
} else {
    $msg['msg'] = 'Debe llenar todos los campos';
    $msg['flag'] = 0;
}
echo json_encode($msg);
?>
