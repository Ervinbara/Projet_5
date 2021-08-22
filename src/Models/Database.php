<?php

namespace App\Models;

use PDO;

class Database
{
    private static $db = null;

    
    protected function dbConnect():PDO
    {
        if(self::$db === null){
            self::$db = new PDO('mysql:host=localhost;dbname=projet_5;charset=utf8', 'root', '');
        }
        return self::$db;
    }  

}