<?php
$dbhost = '';
$dbname = '';
$dbuser = '';
$dbpass = '';

function GetSQLValueString($val) {
    return htmlentities(trim($val), ENT_QUOTES, 'UTF-8');
}

$data = sprintf("host=%s user=%s dbname=%s password=%s", $dbhost, $dbuser, $dbname, $dbpass);
$cnn = pg_connect($data) or die('No se pudo conectar a la base de datos.');
?>
