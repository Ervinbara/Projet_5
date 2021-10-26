<?php

// Mailer PHP, permet l'envoi de mail

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class MailerService
{
    public function sendMail($author, $subject, $contenu)
    {
        $mail = new PHPMailer(true);
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = false;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->setFrom(SET_FROM_MAIL, SET_FROM_NAME);
        $mail->Host       = MAIL_HOST;
        $mail->Username   = USERNAME;
        $mail->Password   = PASSWORD;


        $mail->addAddress(ADD_ADRESSE);
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $content = "<b>Envoyer par : $author <br/><br/> $contenu </b>";
 
        $mail->MsgHTML($content);
        $mail->Send();
    }
}
