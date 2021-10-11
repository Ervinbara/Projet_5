<?php

namespace App\Framework;

use App\Routing\Router;
use App\Framework\Security;

class Kernel
{
    /**
     * @var Router
     */
    public $router;
    
    /**
     * @var Security
     */
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