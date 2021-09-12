<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class EditArticleController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'addPost';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $adminManager->add($_POST['titre'], $_POST['contenu']);

        return $this->render('editPost.html.twig', [
            'name' => 'Ervin'
        ]);
    }
}