<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class ArticleController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'displayArticle';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $article = $adminManager->displayPost($_GET['id']);
        // print_r($article);

        return $this->render('article_view.html.twig', [
            "article" => $article
        ]);
    }
}