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
$_POST['FechaNacimiento'] = date("Y-m-d", strtotime($_POST['FechaNacimiento']));
$_POST['FechaIngreso'] = date("Y-m-d", strtotime($_POST['FechaIngreso']));

if(isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
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
            $valores .= sprintf('\'%s\') WHERE id = %d;', $valor, (isset($_SESSION['administrador'])? $_SESSION['administrador'] : $_SESSION['general']));
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