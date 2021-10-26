<?php

namespace App\Models;

use PDOException;
use App\Models\Database;

class CommentManager extends Database
{
    // Envoi d'un commentaire
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $stmt = $comments->execute(array($postId, $author, $comment));
        return $stmt;
    }

    // Récupération de tout les commentaires
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT u.username,c.id,c.report,c.comment,DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments c  
        JOIN users u ON u.id = c.user_id WHERE post_id = :postId AND waiting = 0 ORDER BY comment_date DESC');
        $stmt->execute(['postId' => $postId]);

        return $stmt->fetchAll();
    }

    // Récupération des commentaires en attentes
    public function getWaitingComment()
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT u.username,c.id,c.comment,DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments c  
         JOIN users u ON u.id = c.user_id  WHERE waiting = 1');
        $stmt->execute();
        return $stmt;
    }
    
    // Récupère le total de commentaire en fonction de chaque article
    public function countsComments($postId)
    {
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS nb FROM comments WHERE post_id = :post_id AND waiting = 0';

        $stmt = $db->prepare($sql);
        $stmt->execute(['post_id' => $postId]);

        return $stmt->fetch();
    }
    
    // Signalement d'un commentaire
    public function reportComment($id_report)
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('UPDATE comments SET report=:report WHERE id =:id');
        $sql->execute([
          'report' => 1,
          'id' => $id_report,
      ]);
    }

    // Annuler le fait qu'un commentaire soit signaler
    public function cancelReport($id_report)
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('UPDATE comments SET report=:report WHERE id =:id');
        $sql->execute([
          'report' => 0,
          'id' => $id_report,
      ]);
    }

    // Fonction de validation d'un commentaire en attente
    public function validComment($id_waiting)
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('UPDATE comments SET waiting=:waiting WHERE id =:id');
        $sql->execute([
          'waiting' => 0,
          'id' => $id_waiting,
      ]);
    }

    // Récupération des commentaires signaler
    public function getCommentReport()
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT u.username,c.id,c.comment,DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments c  
         JOIN users u ON u.id = c.user_id WHERE c.report = 1');
        $stmt->execute();
        return $stmt;
    }

    // Compte le nombre de commentaire signaler
    public function countsCommentsReport()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS nb FROM comments WHERE report = 1';

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Compte le nombre de commentaire en attente
    public function countsCommentsWaiting()
    {
        $db = $this->dbConnect();
        $sql = 'SELECT COUNT(*) AS nb FROM comments WHERE waiting = 1';

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Suppression d'un commentaire
    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $sql = $db->prepare('DELETE FROM comments WHERE id = :id');
        $sql->execute(['id' => $commentId]);

        return $sql;
    }
}
