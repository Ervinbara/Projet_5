<?php

// Mailer PHP, permet l'envoi de mail 

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class MailerService
{
    public function sendMail($author, $subject, $contenu){
        $mail = new PHPMailer(True);
        $mail = new PHPMailer();
        $mail->IsSMTP(); 
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = False;  
        $mail->SMTPAuth   = True;
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->setFrom('lokidog1797@gmail.com', 'Loki');
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "lokidog1797@gmail.com";
        $mail->Password   = "Loki_1797";


        $mail->addAddress('lokidog1797@gmail.com');
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $content = "<b>Envoyer par : $author <br/><br/> $contenu </b>";
 
        $mail->MsgHTML($content); 
        $mail->Send();
    }
}