<?php

namespace App\Models; 

use PDOException;
use App\Models\Database;

class AdminManager extends Database
{
    
    public function add($titre, $chapo, $contenu, $author, $image)
    {
        $db = $this->dbConnect();

        $sql = 'INSERT INTO articles (title, chapo, content, author, image, creation_date) VALUES (:title, :chapo, :content, :author, :image,  NOW())';

        $req = $db->prepare($sql);
        $req->execute(array(':title' => $titre, ':chapo' => $chapo, ':content' => $contenu, ':author' => $author, ':image' => $image));
        return $req;
    }
 
    public function modify($titre, $chapo, $contenu, $author, $image, $id)
    {
        $db = $this->dbConnect();

        $sql = ('UPDATE articles SET title = :title , chapo = :chapo , content = :content , author = :author, image = :image WHERE id = :id');
        $parameters = ['title' => $titre, 'chapo' => $chapo, 'content' => $contenu, 'author' => $author, 'image' => $image, 'id' => $id];
        
        $stmt = $db->prepare($sql);
        $stmt->execute($parameters);
        return $stmt->fetch();
    }

    public function getAllArticles()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, chapo, content, author, image, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles ORDER BY creation_date DESC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function getLastArticles()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, chapo, content, author, image, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles ORDER BY creation_date DESC LIMIT 0, 3';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, chapo, content, author, image,  DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles WHERE id = :postId';
        $stmt = $db->prepare($sql);
        $stmt->execute(['postId' => $postId]);
        $post = $stmt->fetch();

        return $post;
    }
    
    /** Delete a user
     * @param int $userId
     */
    public function deletePost(int $postId): void
    {   
        $db = $this->dbConnect();
        $sql = 'DELETE FROM articles WHERE id = :postId';
        $stmt = $db->prepare($sql);
        $stmt->execute(['postId' => $postId]);
    }

    public function addImage($image, $titre){
        $tailleMax = 10000000;
        $extensions = array('jpg', 'jpeg', 'gif', 'png');
        if($image['size'] <= $tailleMax){
            $extensionUpload = strtolower(substr(strrchr($image['name'], '.'), 1));
            // On vérifie si le texte contient une extension valide
            if(in_array($extensionUpload, $extensions)){
                $chemin = "./images/articles/".$titre.".".$extensionUpload;
            // On déplace l'image du dossier temporaire du serveur sur laquelle elle est stockée, dans
            // notre dossier articles
            $resultat = move_uploaded_file($image['tmp_name'], $chemin);
            // Si l'image à bien été déplacé on stocke le chemin de l'image dans une variable 
            // que l'on va envoyer en base de données
                if($resultat) {
                    $file = $titre.".".$extensionUpload;
                    return $file;
                }
            }
            else{
                // TODO : Rediriger avec un message de session expliquant le problème
                print('Mauvais format');
            }
        }
        // TODO : Rediriger avec un message de session expliquant le problème
        else{
            print('pas bon');
        }
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $stmt = $comments->execute(array($postId, $author, $comment));
        return $stmt; 
    }

    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT id, author,post_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = :postId ORDER BY comment_date DESC');
        $stmt->execute(['postId' => $postId]);

        return $stmt->fetchAll();
    }
    
    // Récupère le compte de commentaire en fonction de chaque article
    public function countsComments($postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS nb FROM comments WHERE post_id = :post_id';

        $stmt = $db->prepare($sql);
        $stmt->execute(['post_id' => $postId]);

        return $stmt->fetch();
    }
    
    public function reportComment($id_report)
    {
          $db = $this->dbConnect();
          $sql = $db->prepare('UPDATE comments SET report=:report WHERE id =:id');
          $sql->execute([
          'report' => 1,
          'id' => $id_report,
      ]);
    }

    public function getCommentReport()
    {
         $db = $this->dbConnect();
         $stmt = $db->prepare('SELECT author,id,comment,DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE report = 1');
         $stmt->execute();
         return $stmt;
    }

    public function countsCommentsReport()
    { 
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS nb FROM comments WHERE report = 1';

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('DELETE FROM comments WHERE id = :id');
        $sql->execute(['id' => $commentId]);

        return $sql;
    }

} 