<?php

namespace App\Controllers;

use App\Routing\AbstractController;

class AdminController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'administration';
    }

    public function process():string{
        // Si l'administrateur est connecté, il pourra accéder à l'espace administration
        if($_SESSION['username'] === 'Ervin'){
            return $this->render('admin/administrationPanel.html.twig', [
                'username' => $_SESSION['username']
            ]);
        }
        // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
        else{
            return $this->render('default/home.html.twig', []);
        }
    }
}