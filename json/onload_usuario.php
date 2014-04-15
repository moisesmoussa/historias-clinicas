<?php
/* Códigos:
    0 = No se pudo encontrar el usuario indicado en la BD
    1 = Usuario encontrado en la BD
*/
require_once('../config.php');
session_start();

$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");

$msg = array();

$query = pg_query("SELECT cedula, primerapellido, segundoapellido, primernombre, segundonombre, fechanacimiento, lugarnacimiento, fechaingreso, especialidad, nombreusuario, estadoresidencia, ciudadresidencia, direccion, codigopostal, lugar_trabajo, tlfmovil, tlfcasa, correoelectronico FROM usuario");

if($query){
    $msg['flag'] = 1;
    $msg['usuario'] = array();
    $cont = 0;

    while(($resultado = pg_fetch_array($query))){
        $msg['usuario'][$cont] = $resultado;
        foreach($msg['usuario'][$cont] as $clave => $valor)
            if($clave == "fechanacimiento" or $clave == "fechaingreso")
                $msg['usuario'][$cont][$clave] = date("d-m-Y", strtotime($valor));
        $cont++;
    }
}else
    $msg['flag'] = 0;

pg_close($conexion);

echo json_encode($msg);
?>
