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
        
        return $this->render('admin/manage_comment.html.twig', [
            'commentReport' => $commentReport,
            'commentWaiting' => $commentWaiting
        ]);
    }
}