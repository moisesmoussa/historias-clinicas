<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Antecedentes sexuales del paciente actualizados correctamente en la BD
    2 = Los antecedentes sexuales del paciente no se pudieron actualizar en la BD
    3 = Error consultando en la base de datos
    4 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para actualizar los datos del paciente';
$msg['flag'] = 4;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    $flag = 1;
    
    foreach ($_POST as $valor)
        if(!isset($valor) || (empty($valor) && $valor != '0')){
            $flag = 0;
            break;
        }

    if($flag){
        require_once('../../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        if(isset($_SESSION['super_administrador']))
            $id_usuario = $_SESSION['super_administrador'];
        else if(isset($_SESSION['administrador']))
            $id_usuario = $_SESSION['administrador'];
        else if(isset($_SESSION['general']))
            $id_usuario = $_SESSION['general'];
            
        $select = 'SELECT id_paciente FROM antecedentes_sexuales WHERE id_paciente = '.$_POST['id_paciente'];

        if($query = pg_query($select)){
            if($query_genero = pg_query('SELECT sexo FROM paciente WHERE id = '.$_POST['id_paciente'])){
                $genero = pg_fetch_assoc($query_genero);
                
                if(!empty($genero)){
                    date_default_timezone_set('Etc/GMT+4');
                    $antecedentes_sexuales_g['id_paciente'] = $_POST['id_paciente'];

                    foreach ($_POST as $clave => $valor){
                            if($clave === 'primera_relacion_sexual' || $clave === 'frecuencia_relaciones_sexuales_mes' || $clave === 'num_parejas_ultimo_anio' || $clave === 'relacion_sexual_satisfactoria' || $clave === 'anticonceptivo' || $clave === 'otros_antecedentes_sexuales' || $clave === 'pubarquia'){
                                $antecedentes_sexuales_g[$clave] = $valor;
                                unset($_POST[$clave]);
                            }
                    }

                    $respuesta = pg_fetch_assoc($query);

                    if(empty($respuesta['id_paciente'])){
                        if($genero['sexo'] === 'Masculino'){
                            $columnas = 'INSERT INTO antecedentes_sexuales_hombre (';
                            $valores = 'VALUES (';

                        } else{
                            $columnas = 'INSERT INTO antecedentes_sexuales_mujer (';
                            $valores = 'VALUES (';
                        }
                        $columnas_general = 'INSERT INTO antecedentes_sexuales (fecha_ua, usuario_ua, creador, ';
                        $valores_general = 'VALUES (\''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', ';
                        $last_value_general = $last_value = ');';

                    } else{
                        if($genero['sexo'] === 'Masculino'){
                            $columnas = 'UPDATE antecedentes_sexuales_hombre SET (';
                            $valores = '= (';

                        } else{
                            $columnas = 'UPDATE antecedentes_sexuales_mujer SET (';
                            $valores = '= (';
                        }
                        $columnas_general = 'UPDATE antecedentes_sexuales SET (fecha_ua, usuario_ua, ';
                        $valores_general = '= (\''.date('Y-m-d').'\', '.$id_usuario.', ';
                        $last_value_general = $last_value = ') WHERE id_paciente = '.$_POST['id_paciente'].';';
                        unset($_POST['id_paciente']);
                    }
                    $cont = 0;
                    $len = count($antecedentes_sexuales_g);

                    foreach ($antecedentes_sexuales_g as $clave => $valor){
                        if($cont === $len - 1){
                            $columnas_general .= $clave.') ';
                            $valores_general .= '\''.$valor.'\''.$last_value_general;

                        } else {
                            $columnas_general .= $clave.',';
                            $valores_general .= '\''.$valor.'\',';
                        }
                        $cont++;
                    }
                    $cont = 0;
                    $len = count($_POST);

                    foreach ($_POST as $clave => $valor){
                        if($cont === $len - 1){
                            $columnas .= $clave.') ';
                            $valores .= '\''.$valor.'\''.$last_value;

                        } else {
                            $columnas .= $clave.',';
                            $valores .= '\''.$valor.'\',';
                        }
                        $cont++;
                    }
                    $query_general = $columnas_general . $valores_general;
                    $query = $columnas . $valores;

                    if(pg_query($query_general) && pg_query($query)) {
                        $msg['msg'] = 'Actualización de datos exitosa';
                        $msg['flag'] = 1;
                    } else {
                        $msg['msg'] = 'No se pudieron actualizar los datos del paciente';
                        $msg['flag'] = 2;
                    }
                } else {
                    $msg['msg'] = 'Error de consulta en la base de datos';
                    $msg['flag'] = 3;
                }
            } else {
                $msg['msg'] = 'Error de consulta en la base de datos';
                $msg['flag'] = 3;
            }
        } else {
            $msg['msg'] = 'Error de consulta en la base de datos';
            $msg['flag'] = 3;
        }
        pg_close($conexion);
        
    } else {
        $msg['msg'] = 'Debe llenar todos los campos';
        $msg['flag'] = 0;
    }
}
echo json_encode($msg);
?>