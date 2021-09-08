<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class RegistrationController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'registration';
    }

    public function process():string{
        
        if (!empty($_POST) && isset($_POST['forminscription'])) {
            $userManager = new UserManager();
            $username = trim($_POST['username']);
            // $email = trim(htmlspecialchars($_POST['email']));
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $userManager->new_account([$username,$password]);
        }

        return $this->render('register.html.twig', []);
    }
}