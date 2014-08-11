<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Datos del médico tratante insertados correctamente en la BD
    2 = Los datos del médico no se pudieron insertar en la BD
    3 = No se puede insertar en la BD porque la cédula del médico indicado ya existe y debe ser único
    4 = No se puede insertar en la BD porque el número del colegio de médicos del médico indicado ya existe y debe ser único
    5 = No se puede insertar en la BD porque el número de registro MPPS del médico indicado ya existe y debe ser único
    6 = No se puede insertar en la BD porque no existe un diagnóstico asociado al id de paciente recibido
    7 = Error consultando en la base de datos
    8 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para ingresar o actualizar los datos del diagnóstico del paciente';
$msg['flag'] = 8;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    $flag = 1;
    
    foreach ($_POST as $valor){
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }
    }
    
    if($flag){
        $tlf_contacto = '';
        
        foreach ($_POST['tlf_contacto'] as $clave => $valor){
            $tlf_contacto .= $valor.'-';
            unset($_POST['tlf_contacto'][$clave]);
        }
        $_POST['tlf_contacto'] = substr_replace($tlf_contacto, '', strlen($tlf_contacto) - 1);
        
        require_once('../../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        $select = 'SELECT id_paciente, id_medico_tratante FROM diagnostico WHERE id_paciente = \''.$_POST['id_paciente'].'\'';
        
        if($query = pg_query($select)){
            $respuesta = pg_fetch_assoc($query);
            $id_medico_tratante = $respuesta['id_medico_tratante'];
            
            if(!empty($respuesta['id_paciente'])){
                $select = 'SELECT id, cedula_medico FROM medico_tratante WHERE cedula_medico = \''.$_POST['cedula_medico'].'\'';
                
                if($query = pg_query($select)){
                    $respuesta = pg_fetch_assoc($query);

                    if(empty($respuesta['cedula_medico']) || $respuesta['id'] === $id_medico_tratante){
                        $select = 'SELECT id, nro_colegio_medicos FROM medico_tratante WHERE nro_colegio_medicos = \''.$_POST['nro_colegio_medicos'].'\'';

                        if($query = pg_query($select)){
                            $respuesta = pg_fetch_assoc($query);

                            if(empty($respuesta['nro_colegio_medicos']) || $respuesta['id'] === $id_medico_tratante){
                                $select = 'SELECT id, nro_registro_mpps FROM medico_tratante WHERE nro_registro_mpps = \''.$_POST['nro_registro_mpps'].'\'';

                                if($query = pg_query($select)){
                                    $respuesta = pg_fetch_assoc($query);

                                    if(empty($respuesta['nro_registro_mpps']) || $respuesta['id'] === $id_medico_tratante){
                                        date_default_timezone_set('Etc/GMT+4');
                                        $id_paciente = $_POST['id_paciente'];
                                        unset($_POST['id_paciente']);
                                        
                                        if(isset($_SESSION['super_administrador']))
                                            $id_usuario = $_SESSION['super_administrador'];
                                        else if(isset($_SESSION['administrador']))
                                            $id_usuario = $_SESSION['administrador'];
                                        else if(isset($_SESSION['general']))
                                            $id_usuario = $_SESSION['general'];

                                        if(empty($id_medico_tratante)){
                                            $columnas = 'INSERT INTO medico_tratante (fecha_ua, usuario_ua, creador, ';
                                            $valores = 'VALUES (\''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', ';
                                            $last_value = ') RETURNING id;';

                                        } else{
                                            $columnas = 'UPDATE medico_tratante SET (fecha_ua, usuario_ua, ';
                                            $valores = '= (\''.date('Y-m-d').'\', '.$id_usuario.', ';
                                            $last_value = ') WHERE id = '.$id_medico_tratante.';';
                                        }
                                        $cont = 0;
                                        $len = count($_POST);

                                        foreach ($_POST as $clave => $valor){
                                            if($cont === $len - 1) {
                                                $columnas .= $clave.') ';
                                                $valores .= '\''.$valor.'\''.$last_value;

                                            } else {
                                                $columnas .= $clave.',';
                                                $valores .= '\''.$valor.'\',';
                                            }
                                            $cont++;
                                        }
                                        $query = $columnas . $valores;

                                        if($resultado = pg_query($query)) {
                                            $return = pg_fetch_assoc($resultado);
                                            $msg['flag'] = 1;
                                            
                                            if(isset($return['id']) && !empty($return['id']))
                                                $id_medico_tratante = $return['id'];
                                            
                                            $query = 'UPDATE diagnostico SET (fecha_ua, usuario_ua, id_medico_tratante) = (\''.date('Y-m-d').'\', '.$id_usuario.', '.$id_medico_tratante.') WHERE id_paciente = '.$id_paciente.';';
                                            
                                            if(pg_query($query)){
                                                $msg['msg'] = 'Actualización de datos exitosa';
                                            } else {
                                                $msg['msg'] = 'Error asignando el médico tratante en el diagnóstico, pero sus datos fueron actualizados exitosamente';
                                            }
                                        } else {
                                            $msg['msg'] = 'No se pudieron ingresar o actualizar los datos del diagnóstico del paciente';
                                            $msg['flag'] = 2;
                                        }
                                    } else {
                                        $msg['msg'] = 'El número de registro MPPS indicado del médico tratante ya existe';
                                        $msg['flag'] = 5;
                                    }
                                } else {
                                    $msg['msg'] = 'Error de consulta en la base de datos';
                                    $msg['flag'] = 7;
                                }
                            } else {
                                $msg['msg'] = 'El número del colegio de médicos indicado del médico tratante ya existe';
                                $msg['flag'] = 4;
                            }
                        } else {
                            $msg['msg'] = 'Error de consulta en la base de datos';
                            $msg['flag'] = 7;
                        }
                    } else {
                        $msg['msg'] = 'La cédula indicada del médico tratante ya existe';
                        $msg['flag'] = 3;
                    }
                } else {
                    $msg['msg'] = 'Error de consulta en la base de datos';
                    $msg['flag'] = 7;
                }
            } else {
                $msg['msg'] = 'Debe asignar primero un diagnóstico al paciente para poder ingresar los datos del médico tratante';
                $msg['flag'] = 6;
            }
        } else {
            $msg['msg'] = 'Error de consulta en la base de datos';
            $msg['flag'] = 7;
        }
        pg_close($conexion);
        
    } else {
        $msg['msg'] = 'Debe llenar todos los campos';
        $msg['flag'] = 0;
    }
}
echo json_encode($msg);
?>