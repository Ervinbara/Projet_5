<?php

use Twig\Environment;
use App\Controllers\HomeController;

require 'vendor/autoload.php';
// Route par défault
$action = $_GET['where'] ?? 'home';  

switch ($action) {
    case 'home':
        $homeController = new HomeController();
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