<?php

namespace App\Controllers;

use App\Routing\AbstractController;

class LogoutController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'logout';
    } 

    public function process():string{
        $this->kernel->security->logout();
        header('location: ?where=home');
    }
}