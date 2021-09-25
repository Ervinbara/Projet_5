<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class EditUserController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'editUser';
    }

    public function process():string{
        $userManager = new UserManager();
        // Récup l'user que l'on modifie de par son id
        $user = $userManager->getUser(18);

        if (!empty($_POST) && isset($_POST['editUserForm'])) {
            // Faire une vérif si le compte existe déjà
            $username_exist = $userManager->username_exist($_POST['username']);
            
            // Renvoi 1, l'username existe déjà en base
            if($username_exist) {
                header('location: ?where=editUser');
            }

            elseif($username_exist == 0){
                $username = trim($_POST['username']);
                $email = trim(htmlspecialchars($_POST['email']));
                $role = $_POST['role'];
                $id = $_POST['id'];
                $userManager->updateUser($username,$email,$role,$id);
                header('location: ?where=listUser');
            }
        }

        return $this->render('editUser.html.twig', [
            'user' => $user
        ]);
    }
}