<?php

use App\Framework\Kernel;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\AdminController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\AddUserController;
use App\Controllers\ArticleController;
use App\Controllers\ArticlesController;
use App\Controllers\EditUserController;
use App\Controllers\AddArticleController;
use App\Controllers\EditArticleController;
use App\Controllers\FormContactController;
use App\Controllers\RegistrationController;
use App\Controllers\AdminArticlesController;
use App\Controllers\CommentReportController;
use App\Controllers\ManageCommentController;
use App\Controllers\WaitingCommentController;


try{
    require 'vendor/autoload.php';

    $kernel = new Kernel();

    $kernel->router->register(HomeController::class);
    $kernel->router->register(ArticlesController::class);
    $kernel->router->register(ArticleController::class);
    $kernel->router->register(AdminArticlesController::class);
    $kernel->router->register(CommentReportController::class);
    $kernel->router->register(WaitingCommentController::class);
    $kernel->router->register(ManageCommentController::class);
    $kernel->router->register(EditArticleController::class);
    $kernel->router->register(FormContactController::class);
    $kernel->router->register(AddArticleController::class);
    $kernel->router->register(AddUserController::class);
    $kernel->router->register(EditUserController::class);
    $kernel->router->register(UserController::class);
    $kernel->router->register(AdminController::class);
    $kernel->router->register(RegistrationController::class);
    $kernel->router->register(LoginController::class);
    $kernel->router->register(LogoutController::class);

    $kernel->process();
}

// A la moindre erreur ou exception, on entre dans le catch
catch(\Throwable $e){
    // Permet de logger dans le système standard de php
    error_log($e->getMessage(),0);
    // Décommenter uniquement en dev pour afficher les erreur dans la page => 
    // throw $e;
    http_response_code(500);
    include("500.html");
}
