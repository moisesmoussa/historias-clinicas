<?php
/*
    Códigos:
    0 = Algún campo está vacío
    1 = Usuario insertado correctamente en la BD
    2 = El usuario no se pudo insertar en la BD
    3 = No se puede insertar en la BD porque la cedula indicado del usuario ya existe y debe ser única
    4 = Error consultando en la base de datos
    5 = No posee permisos para realizar la operación
*/
session_start();
$msg['msg'] = 'No posee permisos para agregar un usuario';
$msg['flag'] = 5;

if(isset($_SESSION['super_administrador']) || isset($_SESSION['administrador'])) {
    $flag = 1;
    
    foreach ($_POST as $clave => $valor){
        if(!isset($valor) || empty($valor)){
            if($clave != 'especialidad' && $clave != 'codigo_postal' && $clave != 'correo_alternativo'){
                $flag = 0;
                break;
            } else {
                unset($_POST[$clave]);
            }
        }
    }
    
    if($flag){        
        require_once('../../config.php');
        $conexion = pg_connect('host='.$app['db']['host'].' port='.$app['db']['port'].' dbname='.$app['db']['name'].' user='.$app['db']['user'].' password='.$app['db']['pass']) OR die('Error de conexión con la base de datos');
        
        $select = 'SELECT cedula FROM usuario WHERE cedula = \''.$_POST['cedula'].'\'';

        if($query = pg_query($select)){
            $respuesta = pg_fetch_assoc($query);

            if(empty($respuesta['cedula'])){
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
                $_POST['fecha_nacimiento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['fecha_nacimiento'])));
                $password = com_create_guid();
                $password = substr($password, 0, 17) . substr($password, strlen($password)-1, 1);
                $_POST['clave'] = md5($password);
                $tlf_movil = '';
                $tlf_casa = '';

                foreach ($_POST['tlf_movil'] as $clave => $valor){
                    $tlf_movil .= $valor.'-';
                    unset($_POST['tlf_movil'][$clave]);
                }
                $_POST['tlf_movil'] = substr_replace($tlf_movil, '', strlen($tlf_movil) - 1);

                foreach ($_POST['tlf_casa'] as $clave => $valor){
                    $tlf_casa .= $valor.'-';
                    unset($_POST['tlf_casa'][$clave]);
                }
                $_POST['tlf_casa'] = substr_replace($tlf_casa, '', strlen($tlf_casa) - 1);
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $username = '';
                $charLength = strlen($characters);
                $length = 6;
                mt_srand(time());

                for ($i = 0; $i < $length; $i++)
                    $username .= $characters[mt_rand(0, $charLength - 1)];

                do {
                    $_POST['nombre_usuario'] = $username . mt_rand(0, 9) . mt_rand(0, 9);
                    $select = 'SELECT nombre_usuario FROM usuario WHERE nombre_usuario = \''.$_POST['nombre_usuario'].'\'';
                    $result = pg_fetch_assoc(pg_query($select));
                } while(!empty($result['nombre_usuario']));

                date_default_timezone_set('Etc/GMT+4');
                $columnas = 'INSERT INTO usuario (fecha_ingreso, fecha_ua, usuario_ua, creador, estado_actual, '.$insert_usuario_g;
                $valores = 'VALUES (\''.date('Y-m-d').'\', \''.date('Y-m-d').'\', '.$id_usuario.', '.$id_usuario.', \'Activo\', '.$values_usuario_g;
                $len = count($_POST);
                $cont = 0;

                foreach ($_POST as $clave => $valor){
                    if($cont === $len - 1){
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
                    $mail->SMTPAuth = true;                               // Habilita la autenticación SMTP
                    $mail->Username = $app['email'];                      // Nombre de usuario SMTP
                    $mail->Password = $app['email_password'];             // Contraseña SMTP
                    $mail->SMTPSecure = 'ssl';                            // Habilita la encriptación, también se puede colocar 'tls'
                    $mail->Port = 465;                                    // 465: SSL - 587: TLS
                    $mail->FromName = 'FUNDAHOG';
                    $mail->addAddress($_POST['correo_electronico'], $_POST['nombres'] . ' ' . $_POST['apellidos']);      // Agrega dirección de correo del receptor
                    $mail->isHTML(true);                                  // Configura el formato del email a HTML
                    $mail->Subject = utf8_encode('=?UTF-8?B?' . base64_encode('FUNDAHOG - Datos de la cuenta suministrada para el sistema de Historias Clínicas') .  '?=');
                    $mail->Body    = '<p>Bienvenido <b>'.$_POST['nombres'].'</b> <b>'.$_POST['apellidos'].'</b>, el sistema de Historias Clínicas le ha asignado una identificación de usuario y una clave para que pueda iniciar sesión en él:<br><br><b>Usuario:</b> '.$_POST['nombre_usuario'].'<br><b>Contraseña:</b> '.$password.'<br><br>A partir de este momento, haciendo uso de los datos personales suministrados se le recomienda proceder a actualizar su <b>Usuario</b> y <b>Contraseña</b>, atendiendo a las siguientes instrucciones:<br><br>&emsp;<b>Usuario:</b><br>&emsp;&emsp;- Mínimo 4 caracteres y máximo 16 caracteres<br>&emsp;&emsp;- Puede contener las letras de la A a la Z en minúscula y/o mayúscula<br>&emsp;&emsp;- Puede contener números<br>&emsp;&emsp;- Puede contener cualquiera de los siguientes caracteres: _ -<br><br>&emsp;<b>Contraseña:</b><br>&emsp;&emsp;- Mínimo 6 caracteres y máximo 18 caracteres<br>&emsp;&emsp;- Puede contener las letras de la A a la Z en minúscula y/o mayúscula<br>&emsp;&emsp;- Puede contener números<br>&emsp;&emsp;- Puede contener cualquiera de los siguientes caracteres: * + / : . , $ % & # { } _ -<br><br>Saludos de parte de FUNDAHOG</p>';

                    $msg['flag'] = 1;

                    if($mail->send())
                        $msg['msg'] = 'Usuario agregado exitosamente.\\nCorreo con los datos de la cuenta enviado';
                    else 
                        $msg['msg'] = 'Usuario agregado exitosamente.\\nNo se pudo enviar el correo con los datos de la cuenta';

                } else {
                    $msg['msg'] = 'Error con la base de datos, no se pudo agregar el usuario';
                    $msg['flag'] = 2;
                }
            } else {
                $msg['msg'] = 'La cédula indicada del usuario ya existe';
                $msg['flag'] = 3;
            }
        } else {
            $msg['msg'] = 'Error de consulta en la base de datos';
            $msg['flag'] = 4;
        }
        pg_close($conexion);
        
    } else {
        $msg['msg'] = 'Debe llenar todos los campos';
        $msg['flag'] = 0;
    }
}
echo json_encode($msg);
?>