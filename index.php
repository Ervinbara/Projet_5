<?php

use Twig\Environment;
use controllers\HomeController;
// require 'controllers/HomeController.php';

require 'vendor/autoload.php';
// Route par défault
$default = 'home';                    
$action = $_GET['where'] ?? $default;  

// A déplacer dans une classe
// $loader = new \Twig\Loader\FilesystemLoader('templates');

// $twig = new Environment($loader, [

//     'cache' => false,

// ]);

$homeController = new HomeController();


switch ($action) {
    case 'home':
        // echo $twig->render('home.html.twig', ['text' => [
        //     'name' => 'Ervin'
        // ]]);
        $homeController->index();
        break;

    case 'allPosts':
        // http://localhost:8000/?where=allPosts
        // echo $twig->render('all_posts.html.twig', ['text' => []
        // ]);
        // $homeController->allPostsView();
        break;

    case 'detailPost':
        
        break;
    case 'addPost':
        
        break;
    case 'modifyPost':
        
        break;
    case 'login':
        
        break;
    case 'logout':

        break;
}