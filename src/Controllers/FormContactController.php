<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class FormContactController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'formContact';
    }

    public function process():string{

        return $this->render('default/form_contact.html.twig', []);
    }
}