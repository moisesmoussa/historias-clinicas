<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Usuario actualizado correctamente en la BD
    2 = El usuario no se pudo actualizar en la BD
*/
session_start();

$msg = NULL;
$flag = 1;
$_POST['fecha_nacimiento'] = date("Y-m-d", strtotime(str_replace('/','-'$_POST['fecha_nacimiento'])));
$_POST['fecha_ingreso'] = date("Y-m-d", strtotime(str_replace('/','-'$_POST['fecha_ingreso'])));

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }

    require_once('../config.php');
    $conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");

    $columnas = 'UPDATE usuario SET (';
    $valores = '= (';
    $len = count($_POST);
    $cont = 0;

    foreach ($_POST as $clave => $valor){
        if($cont == $len - 1) {
            $columnas .= sprintf('%s) ', $clave);
            if(isset($_SESSION['super_administrador']))
                $id_usuario = $_SESSION['super_administrador'];
            else if(isset($_SESSION['administrador']))
                $id_usuario = $_SESSION['administrador'];
            else if(isset($_SESSION['general']))
                $id_usuario = $_SESSION['general'];
            $valores .= sprintf('\'%s\') WHERE id = %d;', $valor, $id_usuario);
        }
        else {
            $columnas .= sprintf('%s,', $clave); 
            $valores .= sprintf('\'%s\',', $valor);
        }
        $cont++;
    }

    $query = $columnas . $valores;

    if(pg_query($query)) {
        $msg['codigo'] = 1;
    } else {
        $msg['codigo'] = 2;
    }

    pg_close($conexion);
}
echo json_encode($msg);
?>