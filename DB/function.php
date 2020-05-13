<?php

include(__DIR__."/mailer/Exception.php");
include(__DIR__."/mailer/SMTP.php");
include(__DIR__."/mailer/PHPMailer.php");

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// register.php
// --- include database.php
// ------  $db
// --- include function.php (file ini)
// ------ $db => global variable!
// ------ uniqueCodeEmail()
// ------ => 2 cara, 1 uniqueCodeEmail($db);
//        => global $db

function sendEmail($to, $subject, $body) {
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through smtp.gmail.com:587 => port
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'bioskop.id0@gmail.com';                     // SMTP username
        $mail->Password   = 'bioskopid1234';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Recipients
        $mail->setFrom('bioskop.id0@gmail.com', 'Bioskop Id');
        $mail->addAddress($to, 'User');     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        $mail->send();
        echo '<script>alert("Message has been sent")</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}