<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class AdminArticlesController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'adminArticles';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $articles = $adminManager->getAllArticles();
        return $this->render('admin_articles.html.twig', [
            'articles' => $articles
        ]);
    }
}