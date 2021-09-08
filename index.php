<?php

use Twig\Environment;
use App\Routing\Router;
use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\LoginController;
use App\Controllers\ArticleController;
use App\Controllers\ArticlesController;
use App\Controllers\EditArticleController;
use App\Controllers\RegistrationController;

require 'vendor/autoload.php';

$router = new Router();
$router->register(HomeController::class);
$router->register(ArticlesController::class);
$router->register(ArticleController::class);
$router->register(EditArticleController::class);
$router->register(AdminController::class);
$router->register(RegistrationController::class);
$router->register(LoginController::class);


$controller = $router->find_controller();

print($controller->process());


// switch ($action) {        
//     case 'logout':
//         break;
//     case 'connexion':
//         break;
//     case 'addPost':
//         break;
