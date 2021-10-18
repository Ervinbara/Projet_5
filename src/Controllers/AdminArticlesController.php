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

        if($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()){
            return $this->render('admin/admin_list_posts.html.twig', [
                'articles' => $articles
            ]);
        }
        // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
        else{
            return $this->render('default/home.html.twig', []);
        }
        
    }
}
