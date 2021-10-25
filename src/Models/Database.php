<?php

namespace App\Models;

use PDO;

class Database
{
    private static $db = null;

    // Initialisation de la connexion à la base de données
    protected function dbConnect():PDO
    {
        if(self::$db === null){
            self::$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
            DB_USER, DB_PASS);
        }
        return self::$db;
    }  

}
