<?php

namespace App\Models;

use PDO;

class Database
{

    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=projet_5;charset=utf8', 'root', '');
        return $db;
    }  

}