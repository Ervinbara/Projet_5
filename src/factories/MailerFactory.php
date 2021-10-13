<?php

namespace App\Factories;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailerFactory
{
    public function sendMail($author, $subject, $contenu){
        $mail = new PHPMailer(TRUE);
        $mail = new PHPMailer();
        $mail->IsSMTP(); 
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
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
        // A voir pour mettre un try catch plutot
        // if(!$mail->Send()) 
        // {
        //     echo "Error while sending Email.";
        //     var_dump($mail);
        // } 
        // else
        // {
        //     echo "Email sent successfully";
        // }
    }
}