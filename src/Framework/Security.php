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

    public function __construct(Kernel $kernel)
    {
        session_start();
        $this->kernel = $kernel;
    }

    public function setUserConnected($user)
    {
        $_SESSION['user'] = $user;
    }


    public function isConnected()
    {
        return isset($_SESSION['user']);
    }

    public function getUserConnected()
    {
        return $_SESSION['user'];
    }

    public function isAdmin()
    {
        return $_SESSION['user']['role'] === 'ADMIN';
    }



    public function logout()
    {
        session_unset();
        session_destroy();
    }
}
