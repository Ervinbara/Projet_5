<?php

use Twig\Environment;
use App\Controllers\HomeController;
use App\Controllers\AdminController;

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
        $adminController = new AdminController();
        $adminController->addPost();
        break;
    case 'administration':
        $adminController = new AdminController();
        $adminController->index();
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