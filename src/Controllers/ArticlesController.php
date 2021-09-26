<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class ArticlesController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'allPosts';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $articles = $adminManager->getAllArticles();
        return $this->render('default/all_posts.html.twig', [
            'articles' => $articles
        ]);
    }
}