<?php
/* Códigos:
    0 = No se pudieron encontrar los usuarios en la BD
    1 = Usuarios encontrados en la BD
    2 = No posee permisos para realizar la operación
*/

session_start();
$msg['msg'] = 'No posee permisos para cargar los datos de los usuarios';
$msg['flag'] = 2;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');
    
    $administrador = '';
    
    if(isset($_SESSION['super_administrador'])){
        $id_usuario = $_SESSION['super_administrador'];
    } else if(isset($_SESSION['administrador'])){
        $id_usuario = $_SESSION['administrador'];
        $administrador = ' AND tipo_usuario != \'Administrador\'';
    }
    
    if(!empty($order = $_POST['order'])) {
        switch($order['field']) {
            case 'Cédula':
                $order = 'cedula::int ' . $order['type'];
                break;
            case 'Nombres':
                $order = 'nombres ' . $order['type'];
                break;
            case 'Apellidos':
                $order = 'apellidos ' . $order['type'];
                break;
            case 'Usuario':
                $order = 'nombre_usuario ' . $order['type'];
                break;
            case 'Móvil':
                $order = 'tlf_movil ' . $order['type'];
                break;
            case 'Email':
                $order = 'correo_electronico ' . $order['type'];
                break;
        }
    } else {
        $order = 'cedula::int';
    }
    
    $select = 'SELECT id, cedula, apellidos, nombres, nombre_usuario, tlf_movil, correo_electronico FROM usuario WHERE id != '.$id_usuario.' AND tipo_usuario != \'Super Administrador\''.$administrador.' ORDER BY ' . $order;
    
    if($query = pg_query($select)){
        unset($msg['msg']);
        $msg['flag'] = 1;
        $cont = 0;
        
        while($resultado = pg_fetch_assoc($query))
            $msg['usuario'][$cont++] = $resultado;
        
    } else {
        $msg['msg'] = 'No se pudieron encontrar los datos de los usuarios';
        $msg['flag'] = 0;
    }
    pg_close($conexion);
}
echo json_encode($msg);
?>