<?php

namespace App\Models; 

use App\Models\Database;

class UserManager extends Database
{
    public function new_account(array $userData)
    {
        $db = $this->dbConnect();
        $sql = 'INSERT INTO users(username,password) VALUES(?,?)';
        $req = $db->prepare($sql);
        return $req->execute($userData); 
    }
}