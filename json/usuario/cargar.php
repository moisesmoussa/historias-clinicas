<?php
/* Códigos:
    0 = No se pudo encontrar el usuario indicado en la BD
    1 = Usuario encontrado en la BD
    2 = Error consultando en la base de datos
    3 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para cargar los datos del usuario';
$msg['flag'] = 3;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $select = 'SELECT * FROM usuario WHERE id = '.$_POST['usuario'];
    
    if($query = pg_query($select)){
        $respuesta = pg_fetch_assoc($query);
        
        if(!empty($respuesta['id'])){
            $msg['usuario'] = $respuesta;
            $msg['usuario']['fecha_nacimiento'] = date('d-m-Y', strtotime($msg['usuario']['fecha_nacimiento']));
            $msg['usuario']['fecha_ingreso'] = date('d-m-Y', strtotime($msg['usuario']['fecha_ingreso']));
            $msg['usuario']['tlf_movil'] = explode('-', $msg['usuario']['tlf_movil']);
            $msg['usuario']['tlf_casa'] = explode('-', $msg['usuario']['tlf_casa']);
            unset($msg['msg']);
            $msg['flag'] = 1;
            
        } else {
            $msg['msg'] = 'Error consultando la información del usuario en la base de datos';
            $msg['flag'] = 2;
        }
    } else {
        $msg['msg'] = 'No se pudieron encontrar los datos del usuario';
        $msg['flag'] = 0;
    }
    pg_close($conexion);
}
echo json_encode($msg);
?>
