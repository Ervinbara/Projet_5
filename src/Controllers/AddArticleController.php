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

            $adminManager->add($_POST['titre'], $_POST['contenu'], $_POST['author'], $image);
        }
        return $this->render('addPost.html.twig', [
            'name' => 'Ervin'
        ]);
    }
}

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
   $tailleMax = 2097152;
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['avatar']['size'] <= $tailleMax) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
         $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
         $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
         if($resultat) {
            $updateavatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id');
            $updateavatar->execute(array(
               'avatar' => $_SESSION['id'].".".$extensionUpload,
               'id' => $_SESSION['id']
               ));
            header('Location: profil.php?id='.$_SESSION['id']);
         } else {
            $msg = "Erreur durant l'importation de votre photo de profil";
         }
      } else {
         $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
      }
   } else {
      $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
   }
}

