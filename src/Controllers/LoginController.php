<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
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

            $_SESSION['username'] = $_POST['username'];
            // header('location: ?where=login');
        }
        
        return $this->render('login.html.twig', [
            'name' => 'Ervin'
        ]);
    }
}