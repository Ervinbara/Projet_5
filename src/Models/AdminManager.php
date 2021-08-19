<?php

namespace App\Models; 

use App\Models\Database;

class AdminManager extends Database
{
    
    public function add($titre,$contenu)
    {
        $db = $this->dbConnect();

        $sql = 'INSERT INTO articles (titre, contenu, creation_date) VALUES (?, ?, NOW())';

        $req = $db->prepare($sql);
        $req->execute(array($titre, $contenu));
        return $req;
    }

    public function getAllArticles()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM articles');
        $req->execute(); 
        return $req;
    }
    
}