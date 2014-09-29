<?php
/* Códigos:
    0 = No se pudieron encontrar los usuarios en la BD según lo indicado por el usuario en la búsqueda
    1 = Usuarios encontrados en la BD según lo indicado por el usuario en la búsqueda
    2 = Error consultando en la BD
    3 = No posee permisos para buscar usuarios
*/

session_start();
$msg['msg'] = 'No posee permisos para buscar usuarios';
$msg['flag'] = 3;

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

    $select = 'SELECT id, cedula, apellidos, nombres, nombre_usuario, tlf_movil, correo_electronico FROM usuario WHERE id != '.$id_usuario.' AND tipo_usuario != \'Super Administrador\''.$administrador.' AND ( cedula LIKE \'%'.$_POST['busqueda'].'%\' OR nombres LIKE \'%'.$_POST['busqueda'].'%\' OR apellidos LIKE \'%'.$_POST['busqueda'].'%\' OR nombre_usuario LIKE \'%'.$_POST['busqueda'].'%\' OR tlf_movil LIKE \'%'.$_POST['busqueda'].'%\' OR correo_electronico LIKE \'%'.$_POST['busqueda'].'%\') ORDER BY cedula::int';
    
    if($query = pg_query($select)){
        $cont = 0;
        
        while($resultado = pg_fetch_assoc($query))
            $msg['usuario'][$cont++] = $resultado;
        
        if(!empty($msg['usuario'])){
            unset($msg['msg']);
            $msg['flag'] = 1;
        } else {
            $msg['msg'] = 'No se pudieron encontrar usuarios según lo indicado en la búsqueda';
            $msg['flag'] = 0;
        }
    } else {
        $msg['msg'] = 'Error de consulta en la base de datos';
        $msg['flag'] = 2;
    }
    pg_close($conexion);
}
echo json_encode($msg);
?>