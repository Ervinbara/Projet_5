<?php

namespace App\Controllers;

use App\Models\AdminManager;
use App\Routing\AbstractController;

class EditArticleController extends AbstractController
{
    public static function isroute(string $action):bool
    {
        return $action === 'editPost';
    }
 
    public function process():string
    {
        if ($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()) {
            $adminManager = new AdminManager();
            $post = $adminManager->getPost($_GET['id']);

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


            if ($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()) {
                return $this->render('admin/editPost.html.twig', [
                    'post' => $post,
                ]);
            }
            // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
            else {
                return $this->render('default/home.html.twig', []);
            }
        } else {
            return $this->render('default/home.html.twig', []);
        }
    }
}
