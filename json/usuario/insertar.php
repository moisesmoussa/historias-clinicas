<?php
/*
    Codigos:
    0 = Algún campo está vacío
    1 = Las contraseñas no coinciden
    2 = Usuario insertado correctamente en la BD
    3 = El usuario no se pudo insertar en la BD
    4 = No se puede insertar en la BD porque el nombre de usuario indicado ya existe y debe ser único
    5 = No posee permisos para realizar la operación
*/
session_start();
$msg['codigo'] = 5;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    $flag = 1;
    
    foreach ($_POST as $valor)
        if(!isset($valor) || empty($valor)){
            $flag = 0;
            break;
        }
    
    if($_POST['clave'] != $_POST['clave2'])
        $msg['codigo'] = 1;
    else if($flag){
        $_POST['fecha_nacimiento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_nacimiento'])));
        $_POST['clave'] = md5($_POST['clave']);
        unset($_POST['clave2']);
        
        require_once('../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');
        
        $select = 'SELECT nombre_usuario FROM usuario WHERE nombre_usuario = \''.$_POST['nombre_usuario'].'\'';
        
        if($query = pg_query($select)){
            $respuesta = pg_fetch_assoc($query);
            
            if(empty($respuesta['nombre_usuario'])){
                $insert_usuario_g = '';
                $values_usuario_g = '';

                if(isset($_SESSION['super_administrador'])){
                    $id_usuario = $_SESSION['super_administrador'];
                    $_POST['tipo_usuario'] = ucfirst($_POST['tipo_usuario']);
                }else if(isset($_SESSION['administrador'])){
                    $id_usuario = $_SESSION['administrador'];
                    $insert_usuario_g = 'tipo_usuario, ';
                    $values_usuario_g = '\'General\', ';
                }

                date_default_timezone_set('Etc/GMT+4');
                $columnas = 'INSERT INTO usuario (fecha_ingreso, fecha_ua, usuario_ua, creador, estado_actual, '.$insert_usuario_g;
                $valores = 'VALUES (\''.date('Y-m-d').'\', \''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', \'Activo\', '.$values_usuario_g;
                $len = count($_POST);
                $cont = 1;

                foreach ($_POST as $clave => $valor){
                    if($cont == $len - 1){
                        $columnas .= $clave.') ';
                        $valores .= '\''.$valor.'\');';
                        
                    } else {
                        $columnas .= $clave.',';
                        $valores .= '\''.$valor.'\',';
                    }
                    $cont++;
                }
                $query = $columnas . $valores;

                if(pg_query($query)) {
                    require('../../PHPMailer/PHPMailerAutoload.php');

                    $mail = new PHPMailer;
                    $mail->CharSet = 'UTF-8';                             // Configura la codificación de caracteres en UTF-8
                    $mail->isSMTP();                                      // Configura Mailer para que utilice SMTP
                    $mail->Host = 'smtp.gmail.com';                       // Especifica los servidores SMTP principal y el de respaldo es opcional
                    $mail->Port = 465;                                    // 465: SSL - 587: TLS
                    $mail->SMTPAuth = true;                               // Habilita la autenticación SMTP
                    $mail->Username = '';              // Nombre de usuario SMTP
                    $mail->Password = '';                      // Contraseña SMTP
                    $mail->SMTPSecure = 'ssl';                            // Habilita la encriptación, también se puede colocar 'tls'
                    $mail->addAddress($_POST['correo_electronico']);      // Agrega dirección de correo del receptor
                    $mail->isHTML(true);                                  // Configura el formato del email a HTML
                    $mail->Subject = utf8_encode('=?UTF-8?B?' . base64_encode('FUNDAHOG - Datos de la cuenta suministrada para el sistema de Historias Clínicas') .  '?=');
                    $mail->Body    = '<p>Bienvenido '.$_POST['primer_nombre'].' '.$_POST['primer_apellido'].', le hemos asignado un nombre de usuario y una clave para que pueda iniciar sesión en el sistema de Historias Clínicas<br><br><b>Nombre de usuario:</b> '.$_POST['nombre_usuario'].'<br><b>Contraseña:</b> '.$_POST['clave'].'<br>Saludos de parte de FUNDAHOG</p>';

                    $msg['codigo'] = 2;

                    if(!$mail->send())
                        $msg['correo'] = FALSE;
                    else 
                        $msg['correo'] = TRUE;
                    
                } else {
                    $msg['codigo'] = 3;
                }
            } else {
                $msg['codigo'] = 4;
            }
        }
        pg_close($conexion);
        
    } else {
        $msg['codigo'] = 0;
    }
}
echo json_encode($msg);
?>