<?php

namespace App\Controllers;

use App\Routing\AbstractController;
use App\Services\MailerService;

class FormContactController extends AbstractController
{
    public static function isroute(string $action):bool
    {
        return $action === 'formContact';
    }

    public function process():string
    {
        $message = null;
        if (!empty($_POST) && isset($_POST['mail'])) {
            $mailerFactory = new MailerService();
            $mailerFactory->sendMail($_POST['author_mail'], $_POST['sujet'], $_POST['contenu'], $_POST['nom'],$_POST['prenom']);
            $message = "Message envoyé";
            return $this->render('default/form_contact.html.twig', [
                "message" => $message
            ]);
        }
        return $this->render('default/form_contact.html.twig', []);
    }
}
