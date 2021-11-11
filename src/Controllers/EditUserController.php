<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Routing\AbstractController;

class EditUserController extends AbstractController
{
    public static function isroute(string $action):bool
    {
        return $action === 'editUser';
    }

    public function process()
    {
        if ($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()) {
            $userManager = new UserManager();
            $user = $userManager->getUser($_GET['id']);
            if (!empty($_POST) && isset($_POST['editUserForm'])) {
                // Faire une vérif si le compte existe déjà
                $checkUsername = $userManager->getUserByUsernameOrEmail($_POST['username']);
                $checkEmail = $userManager->getUserByUsernameOrEmail($_POST['email']);
                $username_exist = $userManager->usernameExist($_POST['username'], $_POST['email']);
                // Renvoi 1, l'username existe déjà en base
                if ($checkUsername !== false  && $checkUsername['id'] !== $user['id']) {
                    header('location: ?where=editUser&id='.$_GET['id']);
                } else {
                    $username = trim($_POST['username']);
                    $email = trim(htmlspecialchars($_POST['email']));
                    $role = $_POST['role'];
                    $id = $_GET['id'];
                    $userManager->updateUser($username, $email, $role, $id);
                    header('location: ?where=listUsers');
                }
            }

            if (!empty($_POST) && isset($_POST['deleteUser'])) {
                $userManager->deleteUser($_GET['id']);
                header('location: ?where=listUsers');
            }
            
            return $this->render('admin/editUser.html.twig', [
                'user' => $user
            ]);
        } else {
            header('location: ?where=home');
        }
    }
}
