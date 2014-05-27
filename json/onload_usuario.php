<?php
/* Códigos:
    0 = No se pudo encontrar el usuario indicado en la BD
    1 = Usuario encontrado en la BD
*/
require_once('../config.php');
session_start();

$conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Lo sentimos, no se pudo realizar la conexión");

$msg = array();

$query = pg_query("SELECT id, cedula, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre, fecha_nacimiento, lugar_nacimiento, fecha_ingreso, especialidad, nombre_usuario, estado_residencia, ciudad_residencia, direccion, codigo_postal, lugar_trabajo, tlf_movil, tlf_casa, correo_electronico FROM usuario");

if($query){
    $msg['flag'] = 1;
    $msg['usuario'] = array();
    $cont = 0;

    while(($resultado = pg_fetch_array($query))){
        $msg['usuario'][$cont] = $resultado;
        foreach($msg['usuario'][$cont] as $clave => $valor)
            if($clave == "fecha_nacimiento" or $clave == "fecha_ingreso")
                $msg['usuario'][$cont][$clave] = date("d-m-Y", strtotime($valor));
        $cont++;
    }
}else
    $msg['flag'] = 0;

pg_close($conexion);

echo json_encode($msg);
?>