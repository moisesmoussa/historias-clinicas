<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Las contraseñas no coinciden
    2 = Usuario insertado correctamente en la BD
    3 = El usuario no se pudo insertar en la BD
    4 = No se puede insertar en la BD porque el nombre de usuario indicado ya existe y debe ser único
*/
session_start();

$msg = NULL;
$flag = 1;
$_POST['fecha_nacimiento'] = date("Y-m-d", strtotime(str_replace('/','-',$_POST['fecha_nacimiento'])));
$_POST['tipo_usuario'] = ucfirst($_POST['tipo_usuario']);

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador']) || isset($_SESSION['general'])) {
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }
    if(!$flag)
        $msg['codigo'] = 0;
    elseif($_POST['clave'] != $_POST['clave2'])
        $msg['codigo'] = 1;
    else {
        
        require_once('../config.php');
        $conexion = pg_connect("host=".$app["db"]["host"]." port=".$app["db"]["port"]." dbname=".$app["db"]["name"]." user=".$app["db"]["user"]." password=".$app["db"]["pass"]) OR die("Error de conexión con la base de datos");
        
        $query = pg_query("SELECT nombre_usuario FROM usuario WHERE nombre_usuario = '".$_POST['nombre_usuario']."'");
        $respuesta = pg_fetch_array($query);
        if(empty($respuesta['nombre_usuario'])){
        
            if(isset($_SESSION['super_administrador']))
                $id_usuario = $_SESSION['super_administrador'];
            else if(isset($_SESSION['administrador']))
                $id_usuario = $_SESSION['administrador'];
            else if(isset($_SESSION['general']))
                $id_usuario = $_SESSION['general'];

            date_default_timezone_set('Etc/GMT+4');
            $columnas = 'INSERT INTO usuario (fecha_ingreso, fecha_ua, usuario_ua, creador, estado_actual, ';
            $valores = 'VALUES (\''.date("Y-m-d").'\', \''.date("Y-m-d").'\', '.$id_usuario.', '.$id_usuario.', \'Activo\', ';
            $len = count($_POST);
            $cont = 1;

            foreach ($_POST as $clave => $valor){
                if($clave == "clave2")
                    continue;
                if($clave != "clave")
                    $dato = $valor;
                else
                    $dato = md5($valor);
                if($cont == $len - 1){
                    $columnas .= sprintf('%s) ', $clave);
                    $valores .= sprintf('\'%s\');', $dato);
                }
                else {
                    $columnas .= sprintf('%s,', $clave);
                    $valores .= sprintf('\'%s\',', $dato);
                }
                $cont++;
            }

            $query = $columnas . $valores;

            if(pg_query($query)) {
                require '../PHPMailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;
                $mail->CharSet = "UTF-8";                             // Configura la codificación de caracteres en UTF-8
                $mail->isSMTP();                                      // Configura Mailer para que utilice SMTP
                $mail->Host = 'smtp.gmail.com';                       // Especifica los servidores SMTP principal y el de respaldo es opcional
                $mail->Port = 465;                                    // 465: SSL - 587: TLS
                $mail->SMTPAuth = true;                               // Habilita la autenticación SMTP
                $mail->Username = '';              // Nombre de usuario SMTP
                $mail->Password = '';                      // Contraseña SMTP
                $mail->SMTPSecure = 'ssl';                            // Habilita la encriptación, también se puede colocar 'tls'
                $mail->addAddress($_POST['correo_electronico']);      // Agrega dirección de correo del receptor
                $mail->isHTML(true);                                  // Configura el formato del email a HTML
                $mail->Subject = utf8_encode("=?UTF-8?B?" . base64_encode("FUNDAHOG - Datos de la cuenta suministrada para el sistema de Historias Clínicas") .  "?=");
                $mail->Body    = "<p>Bienvenido ".$_POST['primer_nombre']." ".$_POST['primer_apellido'].", le hemos asignado un nombre de usuario y una clave para que pueda iniciar sesión en el sistema de Historias Clínicas<br><br><b>Nombre de usuario:</b> ".$_POST['nombre_usuario']."<br><b>Contraseña:</b> ".$_POST['clave']."<br>Saludos de parte de FUNDAHOG</p>";

                $msg['codigo'] = 2;

                if(!$mail->send())
                    $msg['correo'] = FALSE;
                else 
                    $msg['correo'] = TRUE;
            } else {
                $msg['codigo'] = 3;
            }
        }else{
            $msg['codigo'] = 4;
        }
        pg_close($conexion);
    }
}
echo json_encode($msg);
?>