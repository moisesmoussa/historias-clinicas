<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Usuario actualizado correctamente en la BD
    2 = El usuario no se pudo actualizar en la BD
    3 = No se puede insertar en la BD porque la cedula indicado del usuario ya existe y debe ser única
    4 = Error consultando en la base de datos
    5 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para actualizar el usuario';
$msg['flag'] = 5;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    $flag = 1;
    
    foreach ($_POST as $clave => $valor){
        if( $clave != 'especialidad' && $clave != 'codigo_postal' && $clave != 'correo_alternativo' && (!isset($valor) || empty($valor)) ){
                $flag = 0;
                break;
        }
    }

    if($flag){
        require_once('../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

        $select = 'SELECT id, cedula FROM usuario WHERE cedula = \''.$_POST['cedula'].'\'';

        if($query = pg_query($select)){
            $respuesta = pg_fetch_assoc($query);

            if(empty($respuesta['cedula']) || $respuesta['id'] === $_POST['id_usuario']){

                if(isset($_SESSION['super_administrador']))
                    $usuario_ua = $_SESSION['super_administrador'];
                else if(isset($_SESSION['administrador']))
                    $usuario_ua = $_SESSION['administrador'];

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
                $columnas = 'UPDATE usuario SET (fecha_ua, usuario_ua, ';
                $valores = '= (\''.date('Y-m-d').'\', '.$usuario_ua.', ';
                $id_usuario = $_POST['id_usuario'];
                unset($_POST['id_usuario']);
                $len = count($_POST);
                $cont = 0;

                foreach ($_POST as $clave => $valor){
                    if($cont === $len - 1) {
                        $columnas .= $clave.') ';
                        $valores .= '\''.$valor.'\') WHERE id = '.$id_usuario.';';

                    } else {
                        $columnas .= $clave.',';
                        $valores .= '\''.$valor.'\',';
                    }
                    $cont++;
                }
                $query = $columnas . $valores;

                if(pg_query($query)) {
                    $msg['msg'] = 'Actualización de usuario exitosa';
                    $msg['flag'] = 1;

                } else {
                    $msg['msg'] = 'Error con la base de datos, no se pudo actualizar el usuario';
                    $msg['flag'] = 2;
                }
            } else {
                $msg['msg'] = 'La cédula indicada del usuario ya existe';
                $msg['flag'] = 3;
            }
        } else {
            $msg['msg'] = 'Error de consulta en la base de datos';
            $msg['flag'] = 4;
        }
        pg_close($conexion);
        
    } else {
        $msg['msg'] = 'Debe llenar todos los campos';
        $msg['flag'] = 0;
    }
}
echo json_encode($msg);
?>