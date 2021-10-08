<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class WaitingCommentController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'waitingComment';
    }

    public function process():string{
        $adminManager = new AdminManager();

        if (!empty($_POST) && isset($_POST['validComment'])) { 
            $adminManager->validComment($_POST['comment_id']);
            header('location: ?where=waitingComment');
        }

        if (!empty($_POST) && isset($_POST['deleteComment'])) { 
            $adminManager->deleteComment($_POST['comment_id']);
            header('location: ?where=waitingComment');
        }

        $commentWait = $adminManager->getWaitingComment();
        return $this->render('admin/waiting__comments_list.html.twig', [
            'commentWait' => $commentWait 
        ]);
    }
}