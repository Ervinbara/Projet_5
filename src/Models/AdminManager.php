<?php

namespace App\Models; 

use App\Models\Database;

class AdminManager extends Database
{
    
    public function add($titre,$contenu)
    {
        $db = $this->dbConnect();

        $sql = 'INSERT INTO articles (title, content, creation_date) VALUES (:title, :content, NOW())';

        $req = $db->prepare($sql);
        $req->execute(array(':title' => $titre, ':content' => $contenu));
        return $req;
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
        $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles ORDER BY creation_date DESC LIMIT 0, 4';
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }
    
    public function displayPost($postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM articles WHERE id = ?';
        $req = $db->prepare($sql);
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}