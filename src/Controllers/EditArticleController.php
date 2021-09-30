<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class EditArticleController extends AbstractController
{ 
    public static function isroute(string $action):bool{
        return $action === 'editPost';
    }
 
    public function process():string{
        $adminManager = new AdminManager();
        $post = $adminManager->displayPost($_GET['id']);
        if (!empty($_POST) && isset($_POST['updatePost'])) {
            $adminManager->modify($_POST['titre'], $_POST['chapo'], $_POST['contenu'], $_POST['author'], $_POST['image']);
            header('location: ?where=adminListPosts');
        }

        if (!empty($_POST) && isset($_POST['deletePost'])) {
            $adminManager->deletePost($_GET['id']);
            header('location: ?where=adminListPosts');
        }

        return $this->render('admin/editPost.html.twig', [
            'post' => $post,
        ]);
    }
}