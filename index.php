<?php

use Twig\Environment;
use App\Routing\Router;
use App\Framework\Kernel;
use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\ArticleController;
use App\Controllers\ArticlesController;
use App\Controllers\EditArticleController;
use App\Controllers\RegistrationController;


require 'vendor/autoload.php';

$kernel = new Kernel();

$kernel->router->register(HomeController::class);
$kernel->router->register(ArticlesController::class);
$kernel->router->register(ArticleController::class);
$kernel->router->register(EditArticleController::class);
$kernel->router->register(AdminController::class);
$kernel->router->register(RegistrationController::class);
$kernel->router->register(LoginController::class);
$kernel->router->register(LogoutController::class);

$kernel->process();



// switch ($action) {        
//     case 'logout':
//         break;
//     case 'connexion':
//         break;
//     case 'addPost':
//         break;
