<?php
/* Códigos:
    0 = No se pudo encontrar el usuario indicado en la BD
    1 = Usuario encontrado en la BD
*/
require_once('../config.php');
session_start();
$msg = NULL;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {

    $conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Error de conexión con la base de datos");

    $msg = array();
    
    $query = pg_query("SELECT id, cedula, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre, nombre_usuario, tlf_movil, correo_electronico FROM usuario");

    if($query){
        $msg['flag'] = 1;
        $msg['usuario'] = array();
        $cont = 0;

        while(($resultado = pg_fetch_array($query))){
            $msg['usuario'][$cont] = $resultado;
            $cont++;
        }
    }else
        $msg['flag'] = 0;

    pg_close($conexion);
}
echo json_encode($msg);
?>