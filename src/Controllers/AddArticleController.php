<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class AddArticleController extends AbstractController
{ 
    public static function isroute(string $action):bool{
        return $action === 'addPost';
    }

    public function process():string{
        if (!empty($_POST) && isset($_POST['addPost'])) {
            $adminManager = new AdminManager();
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $tailleMax = 3000000;
                $extensions = array('jpg', 'jpeg', 'gif', 'png');
                if($_FILES['image']['size'] <= $tailleMax){
                    $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
                    // On vérifie si le texte contient une extension valide
                    if(in_array($extensionUpload, $extensions)){
                        $chemin = "./images/articles/".$_POST['titre'].".".$extensionUpload;
                        // On déplace l'image du dossier temporaire du serveur sur laquelle elle est stockée, dans
                        // notre dossier articles
                        $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                        // Si l'image à bien été déplacé on stocke le chemin de l'image dans une variable 
                        // que l'on va envoyer en base de données
                        if($resultat) {
                            $image = $_POST['titre'].".".$extensionUpload;
                        }
                            
                    }
                    else{
                        print('Mauvais format');
                    }
                }
                else{
                    print('pas bon');
                }
            }

            $adminManager->add($_POST['titre'], $_POST['chapo'],$_POST['contenu'], $_POST['author'], $image);
            // print_r($_POST);
            // exit();
            return $this->render('admin/administrationPanel.html.twig', []);
        }
        return $this->render('admin/addPost.html.twig', [
            'name' => 'Ervin'
        ]);
    }
}

