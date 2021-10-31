<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class EditArticleController extends AbstractController
{
    public static function isroute(string $action):bool
    {
        return $action === 'editPost';
    }
 
    public function process()
    {
        if ($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()) {
            $adminManager = new AdminManager();
            $userManager = new UserManager();
            $post = $adminManager->getPost($_GET['id']);
            // Récupération des utilisateurs pour l'eventuelle changement d'auteur 
            $users = $userManager->getUsers();

            if (!empty($_POST) && isset($_POST['updatePost'])) {
                if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                    $image = $_FILES['image'];
                    $titre = $_POST['titre'];
                    $image = $adminManager->addImage($image, $titre);
                }

                $titre = $_POST['titre'];
                $chapo = $_POST['chapo']; 
                $contenu = $_POST['contenu'];
                $author = $_POST['author'];
        
                $id = $_GET['id'];

                $adminManager->modify($titre, $chapo, $contenu, $author, $image, $id);
                header('location: ?where=adminListPosts');
            }

            if (!empty($_POST) && isset($_POST['deletePost'])) {
                $adminManager->deletePost($_GET['id']);
                header('location: ?where=adminListPosts');
            }


            return $this->render('admin/editPost.html.twig', [
                'post' => $post,
                'users' => $users,
            ]);
        }
        // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
        else {
            header('location: ?where=home');
        }
    }
}
