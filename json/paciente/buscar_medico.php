<?php
/* Códigos:
    0 = No se pudieron encontrar los datos del médico en la BD según lo indicado por el usuario en la búsqueda
    1 = Datos del médico encontrados en la BD según lo indicado por el usuario en la búsqueda
    2 = Error consultando en la BD
    3 = No posee permisos para buscar un médico
*/

session_start();
$msg['msg'] = 'No posee permisos para buscar un médico';
$msg['flag'] = 3;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $select = 'SELECT cedula_medico, apellidos_medico, nombres_medico, nro_colegio_medicos, nro_registro_mpps, tlf_contacto FROM medico_tratante WHERE cedula_medico = \''.$_POST['busqueda'].'\' OR apellidos_medico = \''.$_POST['busqueda'].'\' OR nombres_medico = \''.$_POST['busqueda'].'\' OR nro_colegio_medicos = \''.$_POST['busqueda'].'\' OR nro_registro_mpps = \''.$_POST['busqueda'].'\' OR tlf_contacto = \''.$_POST['busqueda'].'\'';
    
    if($query = pg_query($select)){        
        $msg['medico'] = pg_fetch_assoc($query);
        
        if(!empty($msg['medico'])){
            $msg['medico']['tlf_contacto'] = explode('-', $msg['medico']['tlf_contacto']);
            unset($msg['msg']);
            $msg['flag'] = 1;
        } else {
            $msg['msg'] = 'No se pudieron encontrar los datos del médico según lo indicado en la búsqueda';
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