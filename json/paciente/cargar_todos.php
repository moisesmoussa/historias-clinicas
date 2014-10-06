<?php
/* Códigos:
    0 = No se pudieron encontrar los pacientes en la BD
    1 = Pacientes encontrados en la BD
    2 = No posee permisos para realizar la operación
*/

session_start();
$msg['msg'] = 'No posee permisos para cargar los datos de los pacientes';
$msg['flag'] = 2;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    if(!empty($order = $_POST['order'])) {
        switch($order['field']) {
            case 'Número de Historia Clínica':
                $order = 'nro_historia_clinica::int ' . $order['type'];
                break;
            case 'Documento de Identidad':
                $order = 'documento_identidad ' . $order['type'];
                break;
            case 'Nombres':
                $order = 'nombres ' . $order['type'];
                break;
            case 'Apellidos':
                $order = 'apellidos ' . $order['type'];
                break;
            case 'Móvil':
                $order = 'tlf_movil ' . $order['type'];
                break;
            case 'Email':
                $order = 'correo_electronico ' . $order['type'];
                break;
        }
    } else {
        $order = 'nro_historia_clinica::int';
    }
    
    $select = 'SELECT id, nro_historia_clinica, documento_identidad, apellidos, nombres, tlf_movil, correo_electronico FROM paciente ORDER BY ' . $order;
    
    if($query = pg_query($select)){
        unset($msg['msg']);
        $msg['flag'] = 1;
        $cont = 0;
        
        while($resultado = pg_fetch_assoc($query))
            $msg['paciente'][$cont++] = $resultado;
        
    } else {
        $msg['msg'] = 'No se pudieron encontrar los datos de los pacientes';
        $msg['flag'] = 0;
    }
    pg_close($conexion);
}
echo json_encode($msg);
?>