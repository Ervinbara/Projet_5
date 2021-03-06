<?php

namespace App\Routing;

use Exception;
use App\Framework\Kernel;
use App\Routing\AbstractController;

class Router
{
    
    /**
     * @var string[]
     */
    private $controllers = [];

    /**
     * @var Kernel
     */
    private $kernel;

    // L'argument de la fonction construct est le $this passer en argument lors de la création
    // de la class Router dans le Kernel => $kernel === $this (qui est enfaîte la class Kernel)
    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function register(string $controller)
    {
        // Avant de le mettre dans le tableau $controllers on s'assure que $controller est bien un AbstractController
        if (is_a($controller, AbstractController::class, true)) {
            $this->controllers[] = $controller;
        } else {
            throw new \Exception("La variable $controller n'est pas du type AbstractController");
        }
    }
    
    public function findController()
    {
        // Vérifie si la route correspond à l'action que je recherche
        $action = $this->getAction();

        foreach ($this->controllers as $controller) {
            if ($controller::isroute($action)) {
                return new $controller($this->kernel);
            }
        }
    }

    private function getAction()
    {
        return $_GET['where'] ?? 'home';
    }
}
