<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Routing\AbstractController;

class AddUserController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'addUser';
    }

    public function process():string{
        
        if (!empty($_POST) && isset($_POST['addUserForm'])) {
            // Faire une vérif si le compte existe déjà
            $userManager = new UserManager();
            $username_exist = $userManager->username_exist($_POST['username']);
            
            // Renvoi 1, l'username existe déjà en base
            if($username_exist) {
                header('location: ?where=addUser');
            }

            elseif($username_exist == 0){
                $username = trim($_POST['username']);
                $email = trim(htmlspecialchars($_POST['email']));
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $role = $_POST['role'];
                    
                $userManager->new_account([$username,$password,$email,$role]);
                header('location: ?where=listUsers');
            }
        }

        return $this->render('admin/addUser.html.twig', []);
    }
}