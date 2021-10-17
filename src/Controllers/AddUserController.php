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
            // Vérification si le nom d'utilisateur ou l'adresse email est déjà utilisé
            $userManager = new UserManager();
            $username_exist = $userManager->username_exist($_POST['username'], $_POST['email']);
            
            // Renvoi 1 si pseudo ou email existe déjà en base
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
        if($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()){
            return $this->render('admin/addUser.html.twig', []);
        }
        // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
        else{
            return $this->render('default/home.html.twig', []);
        }
        
    }
}