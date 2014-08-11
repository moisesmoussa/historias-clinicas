<?php
/* Códigos:
    0 = No se pudo encontrar el paciente indicado en la BD
    1 = Paciente encontrado en la BD
    2 = Error consultando en la base de datos
    3 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para cargar los datos del paciente';
$msg['flag'] = 3;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $select = 'SELECT id, nro_historia_clinica, apellidos, nombres, nacionalidad, documento_identidad, fecha_nacimiento, sexo, lugar_nacimiento, peso, estatura, superficie_corporal, direccion, tlf_casa, tlf_movil, ocupacion, empresa FROM paciente WHERE id = '.$_POST['paciente'];
    
    if($query = pg_query($select)){
        $resultado = pg_fetch_assoc($query);
        
        if(!empty($resultado['id'])){
            $msg['paciente'] = $resultado;
            $msg['paciente']['fecha_nacimiento'] = date('d-m-Y', strtotime($msg['paciente']['fecha_nacimiento']));
            unset($msg['msg']);
            $msg['flag'] = 1;
            
            $select = 'SELECT * FROM diagnostico WHERE id_paciente = '.$_POST['paciente'];

            if($query = pg_query($select)){
                $resultado = pg_fetch_assoc($query);
                
                if(!empty($resultado['id'])){
                    $msg['paciente'] = array_merge($msg['paciente'], $resultado);
                    $msg['paciente']['fecha_solicitud'] = date('d-m-Y', strtotime($msg['paciente']['fecha_solicitud']));
                    $msg['paciente']['fecha_primer_sintoma'] = date('d-m-Y', strtotime($msg['paciente']['fecha_primer_sintoma']));
                    $msg['paciente']['fecha_diagnostico'] = date('d-m-Y', strtotime($msg['paciente']['fecha_diagnostico']));
                    $msg['paciente']['fecha_inicio_tratamiento'] = date('d-m-Y', strtotime($msg['paciente']['fecha_inicio_tratamiento']));
                    
                    if(!empty($resultado['id_medico_tratante'])){
                        $select = 'SELECT * FROM medico_tratante WHERE id = '.$resultado['id_medico_tratante'];

                        if($query = pg_query($select)){
                            if($resultado = pg_fetch_assoc($query)){
                                $msg['paciente'] = array_merge($msg['paciente'], $resultado);
                                $msg['paciente']['tlf_contacto'] = explode('-', $msg['paciente']['tlf_contacto']);
                            }
                        }
                    }
                }
            }
        } else {
            $msg['msg'] = 'No se pudieron encontrar los datos del paciente';
            $msg['flag'] = 0;
        }
    } else {
        $msg['msg'] = 'Error consultando la información del paciente en la base de datos';
        $msg['flag'] = 2;
    }        
    pg_close($conexion);
}
echo json_encode($msg);
?>
