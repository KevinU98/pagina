<?php
   // required headers
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");

   $nombre = $_POST['name'];
   $email = $_POST['email'];
   $subject = $_POST['subject'];
   $message = $_POST['message'];

   require 'wp-includes/plugins/phpMailer/src/Exception.php';
   require 'wp-includes/plugins/phpMailer/src/PHPMailer.php';
   require 'wp-includes/plugins/phpMailer/src/SMTP.php';

    //Luego tenemos que iniciar la validación por SMTP:
    $mail = new PHPMailer\PHPMailer\PHPMailer(TRUE);   
    $mail->IsSMTP();
    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->Username = "kevin.uriegas@tibs.com.mx"; // GMAIL username
    $mail->Password = "kevinalexis98"; // GMAIL password
    // check if more than 0 record found

    $mail->AddAddress($email); // Esta es la dirección a donde enviamos

    //Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
    $mail->From = "kevin.uriegas@tibs.com.mx"; // Desde donde enviamos (Para mostrar)
    $mail->FromName = "Magni-Acero";

    //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.

    $mail->IsHTML(true); // El correo se envía como HTML
    $mail->Subject = $subject; // Este es el titulo del email.
    $body = '<p>Nombre: <b>'.$nombre.'</b></p>
             <p>Email: <b>'.$email.'</b></p>
             <p>Ademas Incluyó el siguiente mensaje:</p>
             <p><b>'.$message.'</b></p>';
    $mail->Body = $body; // Mensaje a enviar
    // $exito = $mail->Send(); // Envía el correo.
    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        header("location:index.html");
        return;
    }
?>
