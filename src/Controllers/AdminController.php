<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class AdminController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'administration';
    }

    public function process():string{
        
        return $this->render('editPost.html.twig', [
            'name' => 'Ervin'
        ]);
    }
}