<?php


namespace App\Framework;

use App\Routing\Router;
use App\Framework\Kernel;

class Security
{
    /**
     * @var Kernel
     */
    private $kernel;

    public function __construct(Kernel $kernel){
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