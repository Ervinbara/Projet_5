<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class CommentReportController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'commentReport';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $commentReport = $adminManager->getCommentReport();

        if (!empty($_POST) && isset($_POST['deleteComment'])) { 
            $adminManager->deleteComment($_POST['delete_comment_id']);
            header('location: ?where=commentReport');
        }
        
        return $this->render('admin/comment_report.html.twig', [
            'commentReport' => $commentReport
        ]);
    }
}