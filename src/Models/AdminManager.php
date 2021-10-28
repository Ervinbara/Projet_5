<?php

namespace App\Models;

use PDOException;
use App\Models\Database;

class AdminManager extends Database
{
    
    // Ajout d'article
    public function add($titre, $chapo, $contenu, $author, $image)
    {
        $db = $this->dbConnect();

        $sql = 'INSERT INTO articles (title, chapo, content, user_id, image, creation_date) VALUES (:title, :chapo, :content, :user_id, :image,  NOW())';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':title' => $titre, ':chapo' => $chapo, ':content' => $contenu, ':user_id' => $author, ':image' => $image));
        return $stmt;
    }
    
    // Update d'article
    public function modify($titre, $chapo, $contenu, $author, $image, $id)
    {
        $db = $this->dbConnect();

        $sql = ('UPDATE articles SET title = :title , chapo = :chapo , content = :content , user_id = :user_id, image = :image WHERE id = :id');
        $parameters = ['title' => $titre, 'chapo' => $chapo, 'content' => $contenu, 'user_id' => $author, 'image' => $image, 'id' => $id];
        
        $stmt = $db->prepare($sql); 
        $stmt->execute($parameters);
        return $stmt->fetch(); 
    }

    // Récupération de tout les articles
    public function getAllArticles()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT a.id, a.title, a.chapo, a.content, u.username, a.image, DATE_FORMAT(a.creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles a
        JOIN users u ON u.id = a.user_id  ORDER BY creation_date DESC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }


    // Récupération des 3 derniers articles
    public function getLastArticles()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT a.id, a.title, a.chapo, a.content, u.username, a.image, DATE_FORMAT(a.creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles a
        JOIN users u ON u.id = a.user_id  ORDER BY creation_date DESC LIMIT 0,3';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    
    // Récupération d'un article
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT a.id, a.title, a.chapo, a.content, u.username, a.image, DATE_FORMAT(a.creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles a
        JOIN users u ON u.id = a.user_id WHERE a.id = :postId';
        $stmt = $db->prepare($sql);
        $stmt->execute(['postId' => $postId]);
        $post = $stmt->fetch();


        return $post;
    }
    
    // Suppression d'un article
    public function deletePost(int $postId): void
    {
        $db = $this->dbConnect();
        $sql = 'DELETE FROM articles WHERE id = :postId';
        $stmt = $db->prepare($sql);
        $stmt->execute(['postId' => $postId]);
    }


    // Ajout d'image
    public function addImage($image, $titre)
    {
        $tailleMax = 10000000;
        $extensions = array('jpg', 'jpeg', 'gif', 'png');
        if ($image['size'] <= $tailleMax) {
            $extensionUpload = strtolower(substr(strrchr($image['name'], '.'), 1));
            // On vérifie si le texte contient une extension valide
            if (in_array($extensionUpload, $extensions)) {
                $chemin = "./images/articles/".$titre.".".$extensionUpload;
                // On déplace l'image du dossier temporaire du serveur sur laquelle elle est stockée, dans
                // notre dossier articles
                $resultat = move_uploaded_file($image['tmp_name'], $chemin);
                // Si l'image à bien été déplacé on stocke le chemin de l'image dans une variable
                // que l'on va envoyer en base de données
                if ($resultat) {
                    $file = $titre.".".$extensionUpload;
                    return $file;
                }
            }
        }
    }
}
