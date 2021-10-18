<?php

namespace App\Controllers;

use App\Models\AdminManager;
use App\Routing\AbstractController;

class HomeController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'home';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $articles = $adminManager->getLastArticles();
        return $this->render('default/home.html.twig', [
            'articles' => $articles,
        ]);
    }
}
