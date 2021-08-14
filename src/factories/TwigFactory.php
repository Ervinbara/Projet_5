<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

namespace src\factories;

class TwigFactory
{

    public function getTwig(string $path, $datas = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('/templates');
        $twig = new Environment($loader, [
            'cache' => false,
        ]);
        // Renvoi nos données
        echo $twig->render($path,$datas);
    }


}