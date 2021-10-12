<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Routing\AbstractController;

class RegistrationController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'registration';
    }

    public function process():string{
        $message = NULL;
        if (!empty($_POST) && isset($_POST['forminscription'])) {
            // Faire une vérif si le compte existe déjà
            $userManager = new UserManager();
            $username_exist = $userManager->username_exist($_POST['username']);
            
            // Renvoi 1, l'username existe déjà en base
            if($username_exist) {
                $message = "L'email ou le pseudo est déjà utilisé.";
                return $this->render('default/register.html.twig', [
                    'message'=> $message
                ]);
                // header('location: ?where=registration');
            }

            elseif($username_exist == 0){
                $username = trim($_POST['username']);
                $email = trim(htmlspecialchars($_POST['email']));
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                $userManager->new_account([$username,$password,$email,"USER"]);
                header('location: ?where=login');
                exit();
            }
        }

        return $this->render('default/register.html.twig', []);
    }
}