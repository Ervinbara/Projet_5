<?php

namespace App\Routing;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


abstract class AbstractController{
    

    // A quoi sert isroute ?
    public abstract static function isroute(string $action):bool;

    public abstract function process():string;

    public function render(string $path, $datas = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $twig = new Environment($loader, [
            'cache' => false,
        ]);
        // Renvoi nos données
        return $twig->render($path,$datas);
    }
}