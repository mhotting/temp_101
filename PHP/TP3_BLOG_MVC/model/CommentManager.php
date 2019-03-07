<?php

require_once('./model/DataManager.php');

class CommentManager extends DataManager {
    // Returns the PDO result: comments for a specific post
    public function getComments($idPost) {
        $db = $this->ft_connect_db();
        $rep = $db->prepare('SELECT * FROM comment WHERE idPost = :idPost;');
        $rep->execute(array('idPost' => $idPost));
        return ($rep);
    }
}