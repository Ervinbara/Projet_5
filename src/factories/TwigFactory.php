<?php

namespace App\Factories;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigFactory
{

    public function render(string $path, $datas = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        $twig = new Environment($loader, [
            'cache' => false,
        ]);
        // Renvoi nos données
        echo $twig->render($path,$datas);
    }


}