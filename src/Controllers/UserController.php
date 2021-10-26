<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Routing\AbstractController;

class UserController extends AbstractController
{
    public static function isroute(string $action):bool
    {
        return $action === 'listUsers';
    }

    public function process():string
    {
        $userManager = new UserManager();
        $users = $userManager->getUsers();

        if ($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()) {
            return $this->render('admin/list_users.html.twig', [
                'users' => $users
            ]);
        }
        // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
        else {
            return $this->render('default/home.html.twig', []);
        }
    }
}
