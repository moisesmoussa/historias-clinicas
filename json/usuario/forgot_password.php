<?php
/* Códigos:
    0 = Algún campo está vacío
    1 = Se ha enviado exitosamente el correo con el enlace para reestablecimiento de la contraseña al usuario
    2 = El correo indicado para el reestablecimiento de la contraseña no existe
    3 = Error enviando correo electrónico
    4 = Error consultando en la base de datos
*/
$flag = 1;

foreach ($_POST as $valor)
    if(!isset($valor) || empty($valor)){
        $flag = 0;
        break;
    }

if($flag){
    require_once('../../config.php');
    $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');

    $query = 'SELECT id FROM usuario WHERE correo_electronico = \''.$_POST['email'].'\' OR correo_alternativo = \'' . $_POST['email'] . '\'';

    if($answer = pg_query($query)) {
        $result = pg_fetch_assoc($answer);

        if(!empty($result['id'])){
            $token = md5(uniqid(mt_rand(), true));
            $timestamp = gmdate('Y-m-d H:i:s');
            $query = 'INSERT INTO password_resets (email, token, created_at) VALUES(\'' . $_POST['email'] . '\', \'' . $token . '\', \'' . $timestamp . '\');';
            
            if(pg_query($query)) {
                require('../../PHPMailer/PHPMailerAutoload.php');

                $mail = new PHPMailer;
                $mail->CharSet = 'UTF-8';                             // Configura la codificación de caracteres en UTF-8
                $mail->isSMTP();                                      // Configura Mailer para que utilice SMTP
                $mail->Host = 'smtp.gmail.com';                       // Especifica los servidores SMTP principal y el de respaldo es opcional
                $mail->SMTPAuth = true;                               // Habilita la autenticación SMTP
                $mail->Username = $app['email'];                      // Nombre de usuario SMTP
                $mail->Password = $app['email_password'];             // Contraseña SMTP
                $mail->SMTPSecure = 'ssl';                            // Habilita la encriptación, también se puede colocar 'tls'
                $mail->Port = 465;                                    // 465: SSL - 587: TLS
                $mail->FromName = 'FUNDAHOG';
                $mail->addAddress($_POST['email']);                   // Agrega dirección de correo del receptor
                $mail->isHTML(true);                                  // Configura el formato del email a HTML
                $mail->Subject = utf8_encode('=?UTF-8?B?' . base64_encode('FUNDAHOG - Reestablecimiento de Contraseña') .  '?=');
                $mail->Body    = '<p>Estimado usuario, para reestablecimiento de su contraseña haga click en el siguiente enlace:<br><br>http://localhost' . $app['basedir'] . '/usuarios/password-reset/' . $token . '<br><br>Saludos de parte de FUNDAHOG</p>';

                if($mail->send()) {
                    $msg['msg'] = 'Correo para reestablecimiento de contraseña enviado exitosamente';
                    $msg['flag'] = 1;
                    
                } else {
                    $msg['msg'] = 'Error enviando correo para reestablecimiento de contraseña';
                    $msg['flag'] = 3;
                }
                
            } else {
                $msg['msg'] = 'Error consultado en la base de datos';
                $msg['flag'] = 4;
            }

        } else {
            $msg['msg'] = 'El correo indicado no está registrado en el sistema';
            $msg['flag'] = 2;
        }
    } else {
        $msg['msg'] = 'Error consultado en la base de datos';
        $msg['flag'] = 4;
    }
    pg_close($conexion);
    
} else {
    $msg['msg'] = 'Debe llenar todos los campos';
    $msg['flag'] = 0;
}
echo json_encode($msg);
?>
