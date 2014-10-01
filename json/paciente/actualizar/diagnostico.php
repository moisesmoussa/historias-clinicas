<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Diagnóstico del paciente actualizado correctamente en la BD
    2 = El diagnóstico del paciente no se pudo actualizar en la BD
    3 = Error consultando en la base de datos
    4 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para ingresar o actualizar los datos del diagnóstico del paciente';
$msg['flag'] = 4;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    $flag = 1;
    
    foreach ($_POST as $clave => $valor){
        if( $clave != 'respuesta_tratamiento' && $clave != 'tiempo_progresion' && $clave != 'motivo_falla_tratamiento' && $clave != 'linea_tratamiento_1' && $clave != 'linea_tratamiento_2' && $clave != 'linea_tratamiento_3' && $clave != 'linea_tratamiento_4' && $clave != 'otras_lineas_tratamiento' && $clave != 'esquema' && $clave != 'sobrevida_global' && $clave != 'dosis_esquema' && $clave != 'duracion_esquema' && $clave != 'motivo_solicitud' && $clave != 'id_medico_tratante' && $clave === 'grado_enfermedad' && $valor != 0 && (!isset($valor) || empty($valor)) ){
            $flag = 0;
            break;
        }
    }

    if($flag){
        $_POST['fecha_solicitud'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_solicitud'])));
        $_POST['fecha_primer_sintoma'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_primer_sintoma'])));
        $_POST['fecha_diagnostico'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_diagnostico'])));
        $_POST['fecha_inicio_tratamiento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_inicio_tratamiento'])));
        
        if(isset($_POST['fecha_ultima_menstruacion']))
            $_POST['fecha_ultima_menstruacion'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_ultima_menstruacion'])));
        
        require_once('../../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        if(isset($_SESSION['super_administrador']))
            $id_usuario = $_SESSION['super_administrador'];
        else if(isset($_SESSION['administrador']))
            $id_usuario = $_SESSION['administrador'];
        else if(isset($_SESSION['general']))
            $id_usuario = $_SESSION['general'];
        
        $select = 'SELECT id_paciente FROM diagnostico WHERE id_paciente = '.$_POST['id_paciente'];
        
        if($query = pg_query($select)){
            date_default_timezone_set('Etc/GMT+4');
            $tratamiento['producto_farmacologico'] = $_POST['producto_farmacologico'];
            $tratamiento['presentacion'] = $_POST['presentacion'];
            $tratamiento['concentracion'] = $_POST['concentracion'];
            $tratamiento['dias_aplicacion'] = $_POST['dias_aplicacion'];
            unset($_POST['producto_farmacologico']);
            unset($_POST['presentacion']);
            unset($_POST['concentracion']);
            unset($_POST['dias_aplicacion']);
            $columnas_tratamiento = 'INSERT INTO tratamiento (fecha_ua, usuario_ua, creador, id_paciente, ';
            $valores_tratamiento = 'VALUES (\''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', '.$_POST['id_paciente'].', ';
            $respuesta = pg_fetch_assoc($query);
            
            if(empty($respuesta['id_paciente'])){
                $columnas = 'INSERT INTO diagnostico (fecha_ua, usuario_ua, creador, ';
                $valores = 'VALUES (\''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', ';
                $last_value = ');';
                
            } else {
                $delete = 'DELETE FROM tratamiento where id_paciente = '.$_POST['id_paciente'];
                $columnas = 'UPDATE diagnostico SET (fecha_ua, usuario_ua, ';
                $valores = '= (\''.date('Y-m-d').'\', '.$id_usuario.', ';
                $last_value = ') WHERE id_paciente = '.$_POST['id_paciente'].';';
                unset($_POST['id_paciente']);
                pg_query($delete);
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
            
            $cont_col = 0;
            $len_col = count($tratamiento);
            $len = count($tratamiento['producto_farmacologico']);
            $columnas = array_fill(0, $len, '');
            $valores = array_fill(0, $len, '');
            $query_tratamiento = array_fill(0, $len, '');

            foreach ($tratamiento as $clave => $valor_i){
                $cont = 0;
                foreach ($tratamiento[$clave] as $valor_j){
                    if($cont_col === $len_col - 1) {
                        $columnas[$cont] .= $clave.') ';
                        $valores[$cont++] .= '\''.$valor_j.'\');';

                    } else {
                        $columnas[$cont] .= $clave.',';
                        $valores[$cont++] .= '\''.$valor_j.'\',';
                    }
                }
                $cont_col++;
            }

            if(pg_query($query)) {
                $flag_query = true;
                
                foreach ($query_tratamiento as $clave => $valor){
                    $query_tratamiento[$clave] .= $columnas_tratamiento . $columnas[$clave] . $valores_tratamiento . $valores[$clave];
                    if(!pg_query($query_tratamiento[$clave]))
                        $flag_query = false;
                }
                $msg['msg'] = ($flag_query) ? 'Actualización de datos exitosa' : 'No se pudieron ingresar o actualizar alguno(s) de los datos de la tabla de tratamiento';
                $msg['flag'] = 1;
            } else {
                $msg['msg'] = 'No se pudieron ingresar o actualizar los datos del diagnóstico del paciente';
                $msg['flag'] = 2;
            }
        } else{
            $msg['msg'] = 'Error de consulta en la base de datos';
            $msg['flag'] = 3;
        }
        pg_close($conexion);
    } else{
        $msg['msg'] = 'Debe llenar todos los campos';
        $msg['flag'] = 0;
    }
}
echo json_encode($msg);
?>