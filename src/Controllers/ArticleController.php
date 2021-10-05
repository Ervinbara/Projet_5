<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\AdminManager;
use App\Routing\AbstractController;

class ArticleController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'displayPost';
    } 

    public function process():string{
        $adminManager = new AdminManager(); 

        if (!empty($_POST) && isset($_POST['comment'])) { 
            $adminManager->postComment($_GET['id'],$_POST['author'],$_POST['coms']);
            header('location: ?where=displayPost&id='.$_GET['id']);
        }

        if (!empty($_POST) && isset($_POST['report'])) { 
            $adminManager->reportComment($_POST['comment_id']);
            header('location: ?where=displayPost&id='.$_GET['id']);
        }

        $article = $adminManager->getPost($_GET['id']);
        $comments = $adminManager->getComments($_GET['id']);
        $counts_comments = $adminManager->countsComments($_GET['id']);

        return $this->render('default/article_view.html.twig', [
            "article" => $article, 
            "comments" => $comments,
            "count" => $counts_comments
        ]);
    }
}