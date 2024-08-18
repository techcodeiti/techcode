<?php
session_start();



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../lib/PHPMailer-master/src/PHPMailer.php';
require '../../lib/PHPMailer-master/src/Exception.php';
require '../../lib/PHPMailer-master/src/SMTP.php';



// Recopila datos del formulario
$id_ticket = strip_tags($_SESSION['IDTICKET']);
$remitente = strip_tags($_SESSION['REMITENTE']);
$destinatario = strip_tags($_SESSION['DESTINATARIO']);
$fecha_actividad = strip_tags($_SESSION['FECHAACTIVIDAD']);
$comentario = strip_tags($_SESSION['COMENTARIO']);
$status = strip_tags($_SESSION['STATUS']);

$subject = 'Notificación Ticket #'. $id_ticket;
$mensaje = "<!DOCTYPE html> ";
$mensaje .= "<html lang='es'> ";
$mensaje .= "<head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='preconnect' href='https://fonts.gstatic.com'>
                <link
                    href='https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap'
                    rel='stylesheet'>
                <title>TechCode</title>
                <style>
                    * {
                        font-family: 'KoHo', sans-serif;
                        box-sizing: border-box
                    }

                    html,
                    body {
                        font-family: 'KoHo', sans-serif;
                        margin: 0px;
                        padding: 0px;
                        background: #cccccc
                    }

                    #logo {
                        height: 3.4rem;
                        position: absolute;
                        top: 50%;
                        margin: -1.7rem 0 0 .8rem;
                        transition: .5s
                    }

                    header {
                        width: 100%;
                        height: 130px;
                        background: #fff;
                        position: sticky;
                        transition: all .5s;
                        top: 0;
                        z-index: 6;
                    }

                    .contenidodeinteres {
                        float: right;
                        width: 100%;
                        height: auto;
                        padding: 15px;
                        margin-bottom: 25px;
                        box-sizing: border-box;
                    }

                    footer {
                        font-size: 15px;
                        color: #555;
                        background: rgb(85, 85, 85);
                        text-align: center;
                        position: fixed;
                        padding: 3px 0 5px;
                        display: block;
                        width: 100%;
                        bottom: 0;
                        border-top: 1px solid #ddd;
                    }

                    div.cuerpo_footer {
                        color: #fff;
                        text-align: center;
                        margin: 25px 1% 1% 50%;
                        position:relative;
                        font-size: 11px
                    }
                </style>
                </head> ";
$mensaje .= "<body>
                <header>
                    <img id='logo' src='https://acortar.link/UCe50J' alt='logo'>
                </header>
                <div class='contenidodeinteres'>
                    <h1>Has recibido una notificación por parte de: $remitente </h1>
                    <h2>Ticket #$id_ticket</h2>
                    <p>Fecha: $fecha_actividad</p>
                    <p>Estado: $status</p>
                    <p>Mensaje:</p>
                    <p>$comentario</p>
                </div>
                <footer class='page-footer font-small blue'>

                    <div class='cuerpo_footer'>
                        <p>© 2023 Copyright</p>
                    </div>

                </footer>

                </body> </Html> ";

// Configuración de PHPMailer
$mail = new PHPMailer(true);
// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Activa el registro detallado
// $mail->Debugoutput = function($str, $level) { file_put_contents('debug.log', $str, FILE_APPEND); }; // Guarda el registro en un archivo
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
$mail->Port = 587;
$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));

// Configura el correo
$mail->setFrom('techcode.noreply@gmail.com', 'INFO TechCode');
$mail->addAddress($destinatario); // Reemplaza con la dirección del destinatario
$mail->Subject = $subject;
$mail->Body = $mensaje;

// Envía el correo
if ($mail->send()) {
echo 'El correo se ha enviado correctamente.';
} else {
echo 'No se pudo enviar el correo. Error: ' . $mail->ErrorInfo;
}


if($_SESSION['TIPOUSUARIO'] == 1){

    echo "<script>
         alert('Se ingreso el registro de actividad con exito');
         window.location= '../../vistas/inicio_cliente.php';
     </script>";
}
    
if($_SESSION['TIPOUSUARIO'] == 2){
    
     echo "<script>
         alert('Se ingreso el registro de actividad con exito');
         window.location= '../../vistas/detalle_ticket_tecnico.php?idTICKET=$id_ticket';
     </script>";
}

if($_SESSION['TIPOUSUARIO'] == 3){
    
    echo "<script>
        alert('Se ingreso el registro de actividad con exito');
        window.location= '../../vistas/inicio_moderador.php';
    </script>";
}

?>
