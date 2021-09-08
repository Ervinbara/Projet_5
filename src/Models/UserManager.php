<?php

namespace App\Models; 

use App\Models\Database;

class UserManager extends Database
{
    // Fonction de création d'un compte
    public function new_account(array $userData)
    {
        $db = $this->dbConnect();
        $sql = 'INSERT INTO users(username,password) VALUES(?,?)';
        $req = $db->prepare($sql);
        return $req->execute($userData); 
    }

    // Fonction de connexion
    public function login($username){
        $db = $this->dbConnect();
        $sql = 'SELECT id, password, username FROM users WHERE username = :username';
        $req = $db->prepare($sql);

        $req->execute(array(
        'username' => $username));
        $resultat = $req->fetch();
        
        return $resultat;
   }

   // Fonction de vérification : Vérifie si une adresse email ou un pseudo est déjà affilié à un compte
   // TODO : A compléter
   public function username_exist($username){
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) FROM users WHERE username = ?'; 
        $db->prepare($sql);
        $sql->execute(array($username));
        $user_exist = $sql->fetchColumn();
        return $user_exist;
    
    }
}