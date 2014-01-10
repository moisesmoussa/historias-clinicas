<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Las contraseñas no coinciden
    2 = Usuario insertado correctamente en la BD
    3 = El usuario no se pudo insertar en la BD
*/
session_start();

$_POST['Nacionalidad'] = ucfirst($_POST['Nacionalidad']);
$_POST['TipoUsuario'] = ucfirst($_POST['TipoUsuario']);
$msg = NULL;
$flag = 1;

if(isset($_SESSION['usuario'])) {
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }
    if(!flag)
        $msg['codigo'] = 0;
    elseif($_POST['Clave'] != $_POST['clave2'])
        $msg['codigo'] = 1;
    else {
        
        require_once('../config.php');
    
        $columnas = 'INSERT INTO usuario (';
        $valores = 'VALUES (';
        $len = count($_POST);
        $cont = 1;
        
        foreach ($_POST as $clave => $valor){
            if($clave == "clave2")
                continue;
            if($clave != "Clave")
                $dato = GetSQLValueString($valor);
            else
                $dato = md5(GetSQLValueString($valor));
            if($cont == $len - 1)
                $columnas .= sprintf('%s) ', $clave);
            else
                $columnas .= sprintf('%s,', $clave);
            if($clave != "Cedula" && $clave != "Pasaporte" && $clave != "TlfMovil" && $clave != "TlfCasa" && $clave != "CodigoPostal") 
                if($cont == $len - 1)
                    $valores .= sprintf('\'%s\');', $dato);
                else
                    $valores .= sprintf('\'%s\',', $dato);
            elseif($cont == $len - 1)
                    $valores .= sprintf('\'%s\');', $dato);
            else
                    $valores .= sprintf('\'%s\',', $dato);   
            $cont++;
        }
  
        $query = $columnas . $valores;
        
        if(pg_query($cnn, $query)) {
            $msg['codigo'] = 2;
        } else {
            $msg['codigo'] = 3;
        }
        
        pg_close($cnn);
    }
}
echo json_encode($msg);
?>