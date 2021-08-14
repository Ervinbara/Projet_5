<?php

namespace controllers;


class HomeController extends TwigFactory
{
    public function index()
    {
        return $this->render('templates/home.html.twig', []);
    }

    public function allPostsView()
    {
        return $this->render('templates/all_posts.html.twig', []);
    }
}