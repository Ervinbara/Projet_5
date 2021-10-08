<?php

namespace App\Controllers;

use App\Models\AdminManager;
use App\Routing\AbstractController;

class AdminArticlesController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'adminListPosts';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $articles = $adminManager->getAllArticles();
        return $this->render('admin/admin_list_posts.html.twig', [
            'articles' => $articles
        ]);
    }
}