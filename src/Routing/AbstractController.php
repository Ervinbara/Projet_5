<?php

namespace App\Routing;

use Twig\Environment;
use App\Framework\Kernel;
use Twig\Loader\FilesystemLoader;


abstract class AbstractController{
    
    /**
     * @var Kernel
     */
    protected $kernel;

    public function __construct($kernel){
        $this->kernel = $kernel;
    }

    // A quoi sert isroute ? Si une route est trouver ça renvoi True sinon False
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
