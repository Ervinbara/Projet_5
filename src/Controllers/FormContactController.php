<?php

namespace App\Controllers;

use App\Factories\MailerFactory;
use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class FormContactController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'formContact';
    } 

    public function process():string{
        $message = NULL; 
        if (!empty($_POST) && isset($_POST['mail'])) { 
            $mailerFactory = new MailerFactory();
            $mailerFactory->sendMail($_POST['author_mail'],$_POST['sujet'],$_POST['contenu']);
            $message = "Message envoyé";
            header('location: ?where=home');
            exit();
            // return $this->render('default/form_contact.html.twig', [
            //     "message" => $message
            // ]);
        }
        return $this->render('default/form_contact.html.twig', []);
    }
}