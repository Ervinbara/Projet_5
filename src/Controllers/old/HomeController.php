<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Factories\TwigFactory;

class HomeController extends TwigFactory
{
    public function index()
    {
        $adminManager = new AdminManager();
        $articles = $adminManager->getLastArticles();
        return $this->render('home.html.twig', [
            'articles' => $articles,
            'name' => 'Ervin'
        ]);
    }

    public function allPostsView()
    {
        $adminManager = new AdminManager();
        $articles = $adminManager->getAllArticles();
        return $this->render('all_posts.html.twig', [
            'articles' => $articles
        ]);
    }
    


    function create_account()
    {
        if (!empty($_POST) && isset($_POST['forminscription'])) {
            $userManager = new UserManager();

            // var_dump($_POST);
            // exit;
            $username = trim($_POST['username']);
            // $email = trim(htmlspecialchars($_POST['email']));
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $userManager->new_account([$username,$password]);
        }

        return $this->render('register.html.twig', []);
    }


    function displayArticle()
    {
        $adminManager = new AdminManager();
        $article = $adminManager->displayPost($_GET['id']);
        // print_r($article);

        return $this->render('article_view.html.twig', [
            "article" => $article
        ]);
    }

}