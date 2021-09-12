<?php


namespace App\Framework;

use App\Routing\Router;

class Security
{
    private $kernel;

    public function __construct($kernel){
        session_start();
        $this->kernel = $kernel;
    }

    public function loginUser($username){
        $_SESSION['username'] = $username;
    }

    public function isConnected(){
        return isset($_SESSION['username']);        
    }

    public function username(){
        return $_SESSION['username'];        
    }

    public function logout(){
        session_unset();
        session_destroy();
    }
}