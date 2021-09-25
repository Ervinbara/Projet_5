<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class UserController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'listUsers';
    }

    public function process():string{
        $userManager = new UserManager();
        $users = $userManager->getUsers();
        return $this->render('list_users.html.twig', [
            'users' => $users
        ]);
    }
}