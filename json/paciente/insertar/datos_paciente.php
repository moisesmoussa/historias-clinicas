<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Datos personales del paciente insertados correctamente en la BD
    2 = Los datos personales del paciente no se pudieron insertar en la BD
    3 = No se puede insertar en la BD porque el documento de identidad indicado del paciente ya existe y debe ser único
    4 = No se puede insertar en la BD porque el número de historia clínica indicado del paciente ya existe y debe ser único
    5 = Error consultando en la base de datos
    6 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para agregar datos de un paciente';
$msg['flag'] = 6;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    $flag = 1;
    
    foreach ($_POST as $clave => $valor){
        if(!isset($valor) || empty($valor)){
            if($clave != 'etnia' && $clave != 'analfabeta' && $clave != 'codigo_postal' && $clave != 'peso' && $clave != 'estatura' && $clave != 'superficie_corporal' && $clave != 'empresa' && $clave != 'correo_electronico'){
                $flag = 0;
                break;
            } else {
                unset($_POST[$clave]);
            }
        }
    }
    
    if($flag){
        $_POST['educacion'] = ucfirst($_POST['educacion']);
        $_POST['nacionalidad'] = ucfirst($_POST['nacionalidad']);
        $_POST['sexo'] = ucfirst($_POST['sexo']);
        $_POST['situacion_conyugal'] = ucfirst($_POST['situacion_conyugal']);
        $_POST['fecha_nacimiento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_nacimiento'])));
        $tlf_movil = '';
        $tlf_casa = '';
        
        foreach ($_POST['tlf_movil'] as $clave => $valor){
            $tlf_movil .= $valor.'-';
            unset($_POST['tlf_movil'][$clave]);
        }
        $_POST['tlf_movil'] = substr_replace($tlf_movil, '', strlen($tlf_movil) - 1);
        
        foreach ($_POST['tlf_casa'] as $clave => $valor){
            $tlf_casa .= $valor.'-';
            unset($_POST['tlf_casa'][$clave]);
        }
        $_POST['tlf_casa'] = substr_replace($tlf_casa, '', strlen($tlf_casa) - 1);
        
        require_once('../../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        $select = 'SELECT id, nro_historia_clinica FROM paciente WHERE nro_historia_clinica = \''.$_POST['nro_historia_clinica'].'\'';
                
        if($query = pg_query($select)){
            $respuesta = pg_fetch_assoc($query);

            if(empty($respuesta['nro_historia_clinica']) || $respuesta['id'] === $_POST['id_paciente']){
                $select = 'SELECT documento_identidad FROM paciente WHERE documento_identidad = \''.$_POST['documento_identidad'].'\'';

                if($query = pg_query($select)){
                    $respuesta = pg_fetch_assoc($query);

                    if(empty($respuesta['documento_identidad'])){

                        if(isset($_SESSION['super_administrador']))
                            $id_usuario = $_SESSION['super_administrador'];
                        else if(isset($_SESSION['administrador']))
                            $id_usuario = $_SESSION['administrador'];
                        else if(isset($_SESSION['general']))
                            $id_usuario = $_SESSION['general'];

                        date_default_timezone_set('Etc/GMT+4');
                        $columnas = 'INSERT INTO paciente (fecha_ua, usuario_ua, creador, ';
                        $valores = 'VALUES (\''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', ';
                        $len = count($_POST);
                        $cont = 0;

                        foreach ($_POST as $clave => $valor){
                            if($cont === $len - 1){
                                $columnas .= $clave.') ';
                                $valores .= '\''.$valor.'\') RETURNING id;';

                            } else {
                                $columnas .= $clave.',';
                                $valores .= '\''.$valor.'\',';
                            }
                            $cont++;
                        }
                        $query = $columnas . $valores;

                        if($resultado = pg_query($query)) {
                            $msg['id'] = pg_fetch_assoc($resultado)['id'];
                            $msg['msg'] = 'Datos del paciente agregados exitosamente';
                            $msg['flag'] = 1;

                        } else {
                            $msg['msg'] = 'Error con la base de datos, no se pudieron agregar los datos del paciente';
                            $msg['flag'] = 2;
                        }
                    } else {
                        $msg['msg'] = 'El documento de identidad indicado del paciente ya existe';
                        $msg['flag'] = 3;
                    }
                } else {
                    $msg['msg'] = 'Error de consulta en la base de datos';
                    $msg['flag'] = 5;
                }
            } else {
                $msg['msg'] = 'El número de historia clínica indicado del paciente ya existe';
                $msg['flag'] = 4;
            }
        } else {
            $msg['msg'] = 'Error de consulta en la base de datos';
            $msg['flag'] = 5;
        }
        pg_close($conexion);
        
    } else {
        $msg['msg'] = 'Debe llenar todos los campos';
        $msg['flag'] = 0;
    }
}
echo json_encode($msg);
?>