<?php

namespace App\Models; 

use PDOException;
use App\Models\Database;

class CommentManager extends Database
{
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $stmt = $comments->execute(array($postId, $author, $comment));
        return $stmt; 
    }

    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT id, author,post_id, comment, report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = :postId AND waiting = 0 ORDER BY comment_date DESC');
        $stmt->execute(['postId' => $postId]);

        return $stmt->fetchAll();
    }

    public function getWaitingComment()
    {
         $db = $this->dbConnect();
         $stmt = $db->prepare('SELECT author,id,comment,DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE waiting = 1');
         $stmt->execute();
         return $stmt;
    }
    
    // Récupère le compte de commentaire en fonction de chaque article
    public function countsComments($postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS nb FROM comments WHERE post_id = :post_id AND waiting = 0';

        $stmt = $db->prepare($sql);
        $stmt->execute(['post_id' => $postId]);

        return $stmt->fetch();
    }
    
    public function reportComment($id_report)
    {
          $db = $this->dbConnect();
          $sql = $db->prepare('UPDATE comments SET report=:report WHERE id =:id');
          $sql->execute([
          'report' => 1,
          'id' => $id_report,
      ]);
    }

    public function cancelReport($id_report)
    {
          $db = $this->dbConnect();
          $sql = $db->prepare('UPDATE comments SET report=:report WHERE id =:id');
          $sql->execute([
          'report' => 0,
          'id' => $id_report,
      ]);
    }

    public function validComment($id_waiting)
    {
          $db = $this->dbConnect();
          $sql = $db->prepare('UPDATE comments SET waiting=:waiting WHERE id =:id');
          $sql->execute([
          'waiting' => 0,
          'id' => $id_waiting,
      ]);
    }

    public function getCommentReport()
    {
         $db = $this->dbConnect();
         $stmt = $db->prepare('SELECT author,id,comment,DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE report = 1');
         $stmt->execute();
         return $stmt;
    }

    public function countsCommentsReport()
    { 
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS nb FROM comments WHERE report = 1';

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function countsCommentsWaiting()
    { 
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS nb FROM comments WHERE waiting = 1';

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('DELETE FROM comments WHERE id = :id');
        $sql->execute(['id' => $commentId]);

        return $sql;
    }
}