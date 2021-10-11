<?php

namespace App\Controllers;

use App\Models\CommentManager;
use App\Routing\AbstractController;

class WaitingCommentController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'waitingComment';
    }

    public function process():string{
        $commentManager = new CommentManager();

        if (!empty($_POST) && isset($_POST['validComment'])) { 
            $commentManager->validComment($_POST['comment_id']);
            header('location: ?where=waitingComment');
        }

        if (!empty($_POST) && isset($_POST['deleteComment'])) { 
            $commentManager->deleteComment($_POST['comment_id']);
            header('location: ?where=waitingComment');
        }

        $commentWait = $commentManager->getWaitingComment();
        return $this->render('admin/waiting__comments_list.html.twig', [
            'commentWait' => $commentWait 
        ]);
    }
}