<?php

namespace App\Routing;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


abstract class AbstractController{
    
    protected $kernel;

    public function __construct($kernel){
        $this->kernel = $kernel;
    }

    // A quoi sert isroute ?
    public abstract static function isroute(string $action):bool;

    public abstract function process():string;

    public function render(string $path, $datas = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $twig = new Environment($loader, [
            'cache' => false,
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        
        $datas['app'] = $this->kernel;
        // Renvoi nos données
        return $twig->render($path,$datas);
    }
}