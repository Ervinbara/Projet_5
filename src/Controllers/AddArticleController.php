<?php

namespace App\Controllers;

use App\Models\AdminManager;
use App\Routing\AbstractController;

class AddArticleController extends AbstractController
{
    public static function isroute(string $action):bool
    {
        return $action === 'addPost';
    }

    public function process():string
    {
        if (!empty($_POST) && isset($_POST['addPost'])) {
            $adminManager = new AdminManager();
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $image = $_FILES['image'];
                $titre = $_POST['titre'];
                $image = $adminManager->addImage($image, $titre);
            }

            $adminManager->add($_POST['titre'], $_POST['chapo'], $_POST['contenu'], $_POST['author'], $image);
            header('location: ?where=adminListPosts');
        }

        // Test si la personne connecté détient le rôle d'administrateur
        if ($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()) {
            return $this->render('admin/addPost.html.twig', []);
        }
        // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
        else {
            return $this->render('default/home.html.twig', []);
        }
    }
}
