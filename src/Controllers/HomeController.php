<?php

namespace App\Controllers;

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
}