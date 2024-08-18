<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../lib/PHPMailer-master/src/PHPMailer.php';
require '../../lib/PHPMailer-master/src/Exception.php';
require '../../lib/PHPMailer-master/src/SMTP.php';



 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Recopila datos del formulario
     $nombre = strip_tags($_POST['NOMBRE']);
     $email = strip_tags($_POST['EMAIL']);
     $subject = strip_tags($_POST['SUBJECT']);
     $mensaje = strip_tags($_POST['MENSAJE']);

     // Configuración de PHPMailer
     $mail = new PHPMailer(true);
    //  $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Activa el registro detallado
    //  $mail->Debugoutput = function($str, $level) { file_put_contents('debug.log', $str, FILE_APPEND); }; // Guarda el registro en un archivo
     $mail->isSMTP();
     $mail->isHTML(true);
     $mail->CharSet = 'UTF-8';
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'techcode.noreply@gmail.com';
     $mail->Password = 'ocswmchdtdcdiyit';
     //$mail->SMTPSecure = 'ssl';
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     //$mail->Port = 465;
     $mail->Port       = 587;
     $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
     );

     // Configura el correo
     $mail->setFrom($email, $nombre);
     $mail->addAddress('techcode.noreply@gmail.com'); // Reemplaza con la dirección del destinatario
     $mail->Subject = $subject;
     $mail->Body = $mensaje;

     // Envía el correo
     if ($mail->send()) {
         echo 'El correo se ha enviado correctamente.';
     } else {
         echo 'No se pudo enviar el correo. Error: ' . $mail->ErrorInfo;
     }
 }
?>
