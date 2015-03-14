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
        if($order['field'] === 'nro_historia_clinica' || $order['field'] === 'documento_identidad') {
            $order['field'] .= '::int';
        }
        $order = $order['field'] . ' ' . $order['type'];
        
    } else {
        $order = 'nro_historia_clinica::int ASC';
    }
    
    if(empty($show = $_POST['show']))
        $show = '10';
    
    if(empty($offset = $_POST['offset']))
        $offset = '0';
    
    $totalResults = 0;
    $count = 'SELECT COUNT(*) FROM paciente';
    $select = 'SELECT id, nro_historia_clinica, documento_identidad, apellidos, nombres, tlf_movil, correo_electronico FROM paciente ORDER BY ' . $order . ' LIMIT ' . $show . ' OFFSET ' . $offset;
    
    if($query = pg_query($count)){
        $totalResults = pg_fetch_assoc($query)['count'];
        
        if($show !== 'ALL')
            $msg['countPages'] = ceil($totalResults/$show);
        else
            $msg['countPages'] = 1;
        
    } else {
        $msg['msg'] = 'Error de consulta en la base de datos';
        $msg['flag'] = 0;
        pg_close($conexion);
        return json_encode($msg);
    }
    
    if($query = pg_query($select)){
        unset($msg['msg']);
        $msg['show'] = $show;
        $msg['totalResults'] = (int) $totalResults;
        $msg['offset'] = (int) $offset;
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