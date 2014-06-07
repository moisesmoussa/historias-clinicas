<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Las contraseñas no coinciden
    2 = Usuario insertado correctamente en la BD
    3 = El usuario no se pudo insertar en la BD
*/
session_start();

$msg = NULL;
$flag = 1;
$_POST['fecha_nacimiento'] = date("Y-m-d", strtotime(str_replace('/','-',$_POST['fecha_nacimiento'])));
$_POST['tipo_usuario'] = ucfirst($_POST['tipo_usuario']);

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }
    if(!flag)
        $msg['codigo'] = 0;
    elseif($_POST['clave'] != $_POST['clave2'])
        $msg['codigo'] = 1;
    else {
        
        require_once('../config.php');
        $conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Error de conexión con la base de datos");

        if(isset($_SESSION['super_administrador']))
            $id_usuario = $_SESSION['super_administrador'];
        else if(isset($_SESSION['administrador']))
            $id_usuario = $_SESSION['administrador'];
        else if(isset($_SESSION['general']))
            $id_usuario = $_SESSION['general'];
        
        date_default_timezone_set('Etc/GMT+4');
        $columnas = 'INSERT INTO usuario (fecha_ingreso, fecha_ua, usuario_ua, creador, estado_actual, ';
        $valores = 'VALUES (\''.date("Y-m-d").'\', \''.date("Y-m-d").'\', '.$id_usuario.', '.$id_usuario.', \'Activo\', ';
        $len = count($_POST);
        $cont = 1;

        foreach ($_POST as $clave => $valor){
            if($clave == "clave2")
                continue;
            if($clave != "clave")
                $dato = $valor;
            else
                $dato = md5($valor);
            if($cont == $len - 1){
                $columnas .= sprintf('%s) ', $clave);
                $valores .= sprintf('\'%s\');', $dato);
            }
            else {
                $columnas .= sprintf('%s,', $clave);
                $valores .= sprintf('\'%s\',', $dato);
            }
            $cont++;
        }

        $query = $columnas . $valores;

        if(pg_query($query)) {
            $msg['codigo'] = 2;
        } else {
            $msg['codigo'] = 3;
        }

        pg_close($conexion);
    }
}
echo json_encode($msg);
?>