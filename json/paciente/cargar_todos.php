<?php
/* Códigos:
    0 = No se pudieron encontrar los pacientes en la BD
    1 = Pacientes encontrados en la BD
    2 = No posee permisos para realizar la operación
*/

session_start();
$msg['flag'] = 2;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $select = 'SELECT id, documento_identidad, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre, tlf_movil, correo_electronico FROM paciente';
    
    if($query = pg_query($select)){
        $msg['flag'] = 1;
        $cont = 0;
        
        while($resultado = pg_fetch_assoc($query))
            $msg['paciente'][$cont++] = $resultado;
        
    } else {
        $msg['flag'] = 0;
    }
    pg_close($conexion);
}
echo json_encode($msg);
?>