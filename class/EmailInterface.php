<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class EmailInterface
{
    const SERVER_EMAIL_ADDRESS = 'PiaGotsky212@gmail.com';
    const SERVER_NAME = 'PiaGotsky';
    const SERVER_PASSWORD = 'pia123456';
    const GMAIL_HOST = 'smtp.gmail.com';
    const SMTP_SECURE = 'tls';
    const SMTP_DEBUG = 2;
    const PORT = 587;


    public static function send($recipient, $name = null, $body = null, $subject = null, $cc = null, $bcc = null, $attachments = null, $logo = null)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = static::SMTP_DEBUG;                // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = static::GMAIL_HOST;                     // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = static::SERVER_EMAIL_ADDRESS;       // SMTP username
            $mail->Password = static::SERVER_PASSWORD;            // SMTP password
            $mail->SMTPSecure = static::SMTP_SECURE;              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = static::PORT;                           // TCP port to connect to

            //Recipients
            $mail->setFrom(static::SERVER_EMAIL_ADDRESS, static::SERVER_NAME);
            $mail->addAddress($recipient, $name);          // Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');
            if (!empty($cc)) {
                if (is_array($cc)) {
                    foreach ($cc as $c) {
                        $mail->addCC($c);
                    }
                } else {
                        $mail->addCC($cc);
                }
            }
            if (!empty($bcc)) {
                if (is_array($bcc)) {
                    foreach ($bcc as $bc) {
                        $mail->addBCC($bc);
                    }
                } else {
                    $mail->addBCC($bcc);
                }
            }

            //Attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            if (!empty($attachments)) {
                if (is_array($attachments)) {
                    foreach ($attachments as $attachment) {
                        $mail->addAttachment($attachment);
                    }
                } else {
                    $mail->addAttachment($attachments);
                }
            }

            //Content
            if (!empty($logo)) {
                $mail->AddEmbeddedImage($logo, 'logo');
            }
            $mail->isHTML(true);                                    // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}