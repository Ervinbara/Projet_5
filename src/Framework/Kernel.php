<?php

namespace App\Framework;

use App\Routing\Router;
use App\Framework\Security;

class Kernel
{
    public $router;
    public $security;

    public function __construct(){
        $this->router = new Router($this);
        $this->security = new Security($this);
    }

    function process(){
        $controller = $this->router->find_controller();
        print($controller->process());
    }
}