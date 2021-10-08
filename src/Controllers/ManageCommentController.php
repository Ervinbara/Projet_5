<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class ManageCommentController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'manageComment';
    }

    public function process():string{
        $adminManager = new AdminManager();
        $commentReport = $adminManager->countsCommentsReport();
        $commentWaiting = $adminManager->countsCommentsWaiting();
        
        return $this->render('admin/manage_comment.html.twig', [
            'commentReport' => $commentReport,
            'commentWaiting' => $commentWaiting
        ]);
    }
}