<?php
/* Códigos:
    0 = No se pudo encontrar el paciente indicado en la BD
    1 = Paciente encontrado en la BD
    2 = Error consultando en la base de datos
    3 = No posee permisos para realizar la operación
*/
session_start();
$msg['flag'] = 3;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $select = 'SELECT * FROM paciente WHERE id = '.$_POST['paciente'];
    
    if($query = pg_query($select)){
        $resultado = pg_fetch_assoc($query);
        
        if(!empty($resultado['id'])){
            $msg['paciente'] = $resultado;
            $msg['paciente']['fecha_nacimiento_original'] = $msg['paciente']['fecha_nacimiento'];
            $msg['paciente']['fecha_nacimiento'] = date('d-m-Y', strtotime($msg['paciente']['fecha_nacimiento']));
            $msg['flag'] = 1;

            $select = 'SELECT * FROM antecedentes_modo_vida WHERE id_paciente = '.$_POST['paciente'];

            if($query = pg_query($select))
                if($resultado = pg_fetch_assoc($query))
                    $msg['paciente'] = array_merge($msg['paciente'], $resultado);

            $select = 'SELECT * FROM antecedentes_patologicos WHERE id_paciente = '.$_POST['paciente'];

            if($query = pg_query($select))
                if($resultado = pg_fetch_assoc($query))
                    $msg['paciente'] = array_merge($msg['paciente'], $resultado);

            $select = 'SELECT * FROM antecedentes_perinatales WHERE id_paciente = '.$_POST['paciente'];

            if($query = pg_query($select))
                if($resultado = pg_fetch_assoc($query))
                    $msg['paciente'] = array_merge($msg['paciente'], $resultado);

            $select = 'SELECT * FROM antecedentes_sexuales WHERE id_paciente = '.$_POST['paciente'];

            if($query = pg_query($select))
                    if($resultado = pg_fetch_assoc($query))
                        $msg['antecedentes_sexuales'] = $resultado;

            if($msg['paciente']['sexo'] == 'Masculino'){
                $select = 'SELECT * FROM antecedentes_sexuales_hombre WHERE id_paciente = '.$_POST['paciente'];

                if($query = pg_query($select))
                    if($resultado = pg_fetch_assoc($query))
                        $msg['paciente'] = array_merge($msg['paciente'], $resultado);
            } else{
                $select = 'SELECT * FROM antecedentes_sexuales_mujer WHERE id_paciente = '.$_POST['paciente'];

                if($query = pg_query($select))
                    if($resultado = pg_fetch_assoc($query))
                        $msg['paciente'] = array_merge($msg['paciente'], $resultado);
            }

            $select = 'SELECT * FROM desarrollo_psicomotor WHERE id_paciente = '.$_POST['paciente'];

            if($query = pg_query($select))
                if($resultado = pg_fetch_assoc($query))
                    $msg['paciente'] = array_merge($msg['paciente'], $resultado);
                
        } else {
            $msg['flag'] = 2;
        }
    } else {
        $msg['flag'] = 0;
    }        
    pg_close($conexion);
}
echo json_encode($msg);
?>
