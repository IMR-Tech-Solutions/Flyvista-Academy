<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $body, $replyEmail = null, $replyName = null)
{
    $mail = new PHPMailer(true);

    try {

        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';   // change as per your SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'admin@flyvistaacademy.com'; // admin email
        $mail->Password   = 'umod kgei jceu vyak';  // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Sender
        $mail->setFrom('admin@flyvistaacademy.com', 'FlyVista Website');

        // Reply-to (user who filled form)
        if ($replyEmail) {
            $mail->addReplyTo($replyEmail, $replyName ?? $replyEmail);
        }

        // Recipient
        $mail->addAddress($to);

        // Email Format
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        return $mail->send();

    } catch (Exception $e) {
        log_message('error', 'PHPMailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}