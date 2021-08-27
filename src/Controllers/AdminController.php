<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Factories\TwigFactory;

class AdminController extends TwigFactory
{
    
    public function index()
    {
        return $this->render('editPost.html.twig', [
            'name' => 'Ervin'
        ]);
    }

    public function addPost()
    {
        $adminManager = new AdminManager();
        $adminManager->add($_POST['titre'], $_POST['contenu']);

        return $this->render('editPost.html.twig', [
            'name' => 'Ervin'
        ]);

    }


}