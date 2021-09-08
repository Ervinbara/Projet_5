<?php

namespace App\Routing;

use App\Routing\AbstractController;


class Router{
    
    private $controllers = [];

    public function register(string $controller){
        $this->controllers[] = $controller;
    }

    public function find_controller(){
        $action = $this->getAction();  

        foreach ($this->controllers as $controller){
            if ($controller::isroute($action)){
                return new $controller;
            }
        }
    }

    private function getAction(){
        return $_GET['where'] ?? 'home'; 
    }
}