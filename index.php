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
        $homeController = new HomeController();
        $homeController->allPostsView();
        break;

    case 'detailPost':
        
        break;
    case 'addPost':
        $homeController = new HomeController();
        $homeController->addPost();
        break;
    case 'modifyPost':
        
        break;
    case 'login':
        
        break;
    case 'logout':

        break;
    case 'registration':
        $homeController = new HomeController();
        $homeController->create_account();
        break;
}