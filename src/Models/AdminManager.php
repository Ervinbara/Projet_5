<?php

namespace App\Models; 

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

    public function modify($titre, $chapo, $contenu, $author, $image)
    {
        $db = $this->dbConnect();

        $sql = ('UPDATE articles (title, chapo, content, author, image, creation_date) VALUES (:title, :chapo, :content, :author, :image, NOW()');
        $parameters = ['title' => $titre, 'chapo' => $chapo, 'content' => $contenu, 'author' => $author, 'image' => $image];
        
        $stmt = $db->prepare($sql);
        $stmt->execute($parameters);
        return $stmt->fetch();
    }

    public function getAllArticles()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM articles');
        $req->execute(); 
        return $req;
    }

    public function getLastArticles()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, chapo, content, author, image, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles ORDER BY creation_date DESC LIMIT 0, 3';
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }
    
    public function displayPost($postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, chapo, content, author, image,  DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles WHERE id = ?';
        $req = $db->prepare($sql);
        $req->execute(array($postId));
        $post = $req->fetch();

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
        $stmt->execute(['userId' => $postId]);
    }
}