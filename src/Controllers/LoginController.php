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
        if (!empty($_POST) && isset($_POST['formLogin'])) {
            $userManager = new UserManager();
            $connexion = $userManager->login($_POST['username']);
            
            $this->kernel->security->loginUser($_POST['username']);

            header('location: ?where=administration');
        }
        return $this->render('default/login.html.twig', []);
    }
}