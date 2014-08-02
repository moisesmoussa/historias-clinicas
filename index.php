<?php
session_start();
require_once('config.php');

$app['controller'] = @$_GET['controller'];
$app['action'] = @$_GET['action'];

// Se almacenan los parametros pasados por GET en un arreglo.
if(isset($_GET['params'])) {
	$app['params'] = preg_split('/\//', $_GET['params']);

	foreach($app['params'] as $k => $v) 
		if(trim($v) == '')
			unset($app['params'][$k]);
}

if($app['controller'] === 'usuarios' && $app['action'] === 'logout') {
	foreach($_SESSION as $k => $v)
		unset($_SESSION[$k]);

	header('Location: '.$app['basedir'].'/');
}

if(((isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) && ($app['controller'] === 'usuarios' && $app['action'] === 'login') || $app['controller'] == '') || (isset($_SESSION['general']) && $app['controller'] === 'usuarios' && $app['action'] != 'perfil' && $app['action'] != 'cambiar-clave'))
    header('Location: '.$app['basedir'].'/pages');

if(!isset($_SESSION['super_administrador']) && !isset($_SESSION['administrador']) && !isset($_SESSION['general'])){
    require_once('modulos/usuarios/login.php');
} else {
	require_once('layouts/default.php');
}
?>