<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class EditArticleController extends AbstractController
{ 
    public static function isroute(string $action):bool{
        return $action === 'editArticle';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $adminManager->modify($_POST['titre'], $_POST['contenu'], $_POST['author'], $_POST['image']);

        return $this->render('editPost.html.twig', [
            'name' => 'Ervin'
        ]);
    }
}