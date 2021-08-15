<?php

namespace App\Controllers;

use App\Factories\TwigFactory;

class HomeController extends TwigFactory
{
    public function index()
    {
        return $this->render('home.html.twig', []);
    }

    public function allPostsView()
    {
        return $this->render('all_posts.html.twig', []);
    }
}