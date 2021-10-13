<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Routing\AbstractController;

class LoginController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'login';
    } 

    public function process():string{
        $message = NULL;
 
        if (!empty($_POST) && isset($_POST['formLogin'])) {
            $userManager = new UserManager();
            $user = $userManager->getUserByUsernameOrEmail($_POST['username']);
            if(($user !== false) && (password_verify($_POST['password'], $user['password']))){
                $this->kernel->security->setUserConnected($user);
                if($user['role'] == 'ADMIN'){
                    header('location: ?where=administration');
                    exit();
                }
                else{
                    header('location: ?where=home');
                    exit();
                }
                
            }
            $message = "L'utilisateur n'a pas pu être connecté";
        }
        return $this->render('default/login.html.twig', [
            "message" => $message
        ]);
    }
}