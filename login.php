<?php
session_start();

$msg = NULL;

if(!isset($_SESSION['usuario'])) {
    require_once('config.php');
    
    $query = sprintf('SELECT "NombreUsuario" FROM "Usuario" WHERE "NombreUsuario" = \'%s\' AND "Clave" = \'%s\'',
                    GetSQLValueString($_POST['usuario']),
                    md5(GetSQLValueString($_POST['clave'])));
    $result = pg_query($cnn, $query);
    
    if($result && ($line = pg_fetch_assoc($result))) {
        $_SESSION['usuario'] = GetSQLValueString($_POST['usuario']);
        $msg['codigo'] = 1;
    } else
        $msg['codigo'] = 0;
    
    pg_close($cnn);
}

echo json_encode($msg);
?>