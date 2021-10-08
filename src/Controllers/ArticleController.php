<?php

namespace App\Controllers;

use App\Models\AdminManager;
use App\Models\CommentManager;
use App\Routing\AbstractController;

class ArticleController extends AbstractController
{
    public static function isroute(string $action):bool{
        return $action === 'displayPost';
    } 

    public function process():string{
        $adminManager = new AdminManager(); 
        $commentManager = new CommentManager();

        if (!empty($_POST) && isset($_POST['comment'])) { 
            $commentManager->postComment($_GET['id'],$_POST['author'],$_POST['coms']);
            header('location: ?where=displayPost&id='.$_GET['id']);
        }

        if (!empty($_POST) && isset($_POST['report'])) { 
            $commentManager->reportComment($_POST['comment_id']);
            header('location: ?where=displayPost&id='.$_GET['id']);
        }

        $article = $adminManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        $counts_comments = $commentManager->countsComments($_GET['id']);

        return $this->render('default/article_view.html.twig', [
            "article" => $article, 
            "comments" => $comments,
            "count" => $counts_comments
        ]);
    }
}