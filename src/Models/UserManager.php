<?php

namespace App\Models; 

use App\Models\Database;

class UserManager extends Database
{
    // Fonction de création d'un compte
    public function newAccount(array $userData)
    {
        $db = $this->dbConnect();
        $sql = 'INSERT INTO users(username,password, email, role) VALUES(?,?,?,?)';
        $stmt = $db->prepare($sql);
        return $stmt->execute($userData);
    }


   // Fonction de vérification : Vérifie si une adresse email ou un pseudo est déjà affilié à un compte
   public function usernameExist($username, $email){       
        $db = $this->dbConnect();
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);

        $user_exist = $stmt->fetchColumn();
        return $user_exist;
    
    }

    // Récupération de tout les utilisateurs
    public function getUsers()
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('SELECT * FROM users');
        $sql->execute(); 
        return $sql;
    }

    // Récupération d'un utilisateur
    public function getUser(int $id)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT * FROM users WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Récupération de l'email ou du pseudo d'un utilisateur, permet l'authentification
    public function getUserByUsernameOrEmail(string $username)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT * FROM users WHERE username=:username OR email=:username';
        $stmt = $db->prepare($sql);
        $stmt->execute(['username' => $username, 'email' => $username]);
        return $stmt->fetch();
    }

    // Fonction de modification d'un utilisateur 
    public function updateUser($username, $email, $role, $id)
    {
        $db = $this->dbConnect();
        $sql = ('UPDATE users SET username = :username , email = :email , role = :role WHERE id = :id');
        $parameters = ['username' => $username,'email' => $email,'role' => $role, 'id' => $id];
        
        $stmt = $db->prepare($sql);
        $stmt->execute($parameters);
        return $stmt->fetch();
     }

    
    // Suppression d'un utilisateur
    public function deleteUser(int $userId): void
    {   
        $db = $this->dbConnect();
        $sql = 'DELETE FROM users WHERE id = :userId';
        $stmt = $db->prepare($sql);
        $stmt->execute(['userId' => $userId]);
    }

        
}