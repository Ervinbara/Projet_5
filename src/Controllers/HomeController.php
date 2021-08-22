<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Factories\TwigFactory;

class HomeController extends TwigFactory
{
    public function index()
    {
        return $this->render('home.html.twig', [
            'name' => 'Ervin'
        ]);
    }

    public function allPostsView()
    {
        $adminManager = new AdminManager();
        $articles = $adminManager->getAllArticles();
        // ddd($articles);
        return $this->render('all_posts.html.twig', [
            'articles' => $articles
        ]);
    }

    public function addPost()
    {
        $adminManager = new AdminManager();
        $adminManager->add($_POST['titre'], $_POST['contenu']);

        return $this->render('home.html.twig', [
            'name' => 'Ervin'
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

}