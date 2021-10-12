<?php

namespace App\Controllers;

use App\Models\CommentManager;
use App\Routing\AbstractController;

class ManageCommentController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'manageComment';
    }

    public function process():string{
        $commentManager = new CommentManager();
        $commentReport = $commentManager->countsCommentsReport();
        $commentWaiting = $commentManager->countsCommentsWaiting();
        
        if($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()){
            return $this->render('admin/manage_comment.html.twig', [
                'commentReport' => $commentReport,
                'commentWaiting' => $commentWaiting
            ]);
        }
        // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
        else{
            return $this->render('default/home.html.twig', []);
        }
    }
}