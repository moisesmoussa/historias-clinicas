<?php
/* Códigos:
    0 = No se pudieron encontrar los pacientes en la BD según lo indicado por el usuario en la búsqueda
    1 = Pacientes encontrados en la BD según lo indicado por el usuario en la búsqueda
    2 = Error consultando en la BD
    3 = No posee permisos para buscar pacientes
*/

session_start();
$msg['msg'] = 'No posee permisos para buscar pacientes';
$msg['flag'] = 3;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $select = 'SELECT id, nro_historia_clinica, documento_identidad, apellidos, nombres, tlf_movil, correo_electronico FROM paciente WHERE nro_historia_clinica LIKE \'%'.$_POST['busqueda'].'%\' OR documento_identidad LIKE \'%'.$_POST['busqueda'].'%\' OR nombres LIKE \'%'.$_POST['busqueda'].'%\' OR apellidos LIKE \'%'.$_POST['busqueda'].'%\' OR tlf_movil LIKE \'%'.$_POST['busqueda'].'%\' OR correo_electronico LIKE \'%'.$_POST['busqueda'].'%\'';
    
    if($query = pg_query($select)){        
        $cont = 0;
        
        while($resultado = pg_fetch_assoc($query))
            $msg['paciente'][$cont++] = $resultado;
        
        if(!empty($msg['paciente'])){
            unset($msg['msg']);
            $msg['flag'] = 1;
        } else {
            $msg['msg'] = 'No se pudieron encontrar pacientes según lo indicado en la búsqueda';
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