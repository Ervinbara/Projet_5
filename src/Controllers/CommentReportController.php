<?php

namespace App\Controllers;

use App\Models\CommentManager;
use App\Routing\AbstractController;

class CommentReportController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'commentReport';
    }

    public function process():string{
        $commentManager = new CommentManager();
        $commentReport = $commentManager->getCommentReport();

        if (!empty($_POST) && isset($_POST['deleteComment'])) { 
            $commentManager->deleteComment($_POST['comment_id']);
            header('location: ?where=commentReport');
        }
        if (!empty($_POST) && isset($_POST['validComment'])) { 
            $commentManager->cancelReport($_POST['comment_id']);
            header('location: ?where=commentReport');
        }
        
        if($this->kernel->security->isConnected() && $this->kernel->security->isAdmin()){
            return $this->render('admin/comment_report.html.twig', [
                'commentReport' => $commentReport
            ]);
        }
        // Si ce n'est pas l'administrateur, il sera redirigé vers la page d'accueil
        else{
            return $this->render('default/home.html.twig', []);
        }
        
    }
}
