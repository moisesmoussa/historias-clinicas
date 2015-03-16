<?php
/* Códigos:
    0 = El token indicado no existe
    1 = El token indicado existe y está vigente
    2 = El token indicado existe pero ha caducado
    3 = Error consultando en la base de datos
*/
$conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

$query = 'SELECT token, created_at FROM password_resets WHERE token = \''.$app['params'][0].'\'';

if($answer = pg_query($query)) {
    $result = pg_fetch_assoc($answer);

    if(!empty($result['token'])){
        date_default_timezone_set('UTC');
        $timeout = 30;
        $storeTimestamp = strtotime($result['created_at']);
        $actualTimestamp = strtotime(gmdate('Y-m-d H:i:s'));
        $timestampDiff = (int) (($actualTimestamp - $storeTimestamp)/60);
        
        if($timestampDiff <= $timeout) {
            //Código 1
            require_once('modulos/'.str_replace('-', '_', $app['controller'].'/'.$app['action'].'.php'));
        } else {
            //Código 2
            $query = 'DELETE FROM password_resets WHERE token = \''.$result['token'].'\'';
            if(pg_query($query)) {
                require_once('modulos/errores/timeout_token.php');
            } else {
                //Código 3
                require_once('modulos/errores/404.php');
            }
        }
    } else {
        //Código 0
        require_once('modulos/errores/invalid_token.php');
    }
} else {
    //Código 3
    require_once('modulos/errores/404.php');
}
pg_close($conexion);
?>
