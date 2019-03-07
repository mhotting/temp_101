<?php

require_once('./model/DataManager.php');

class PostManager extends DataManager {
    // Returns the list of all the posts from the blog
    public function ft_getPostList() {
        $db = $this->ft_connect_db();
        $res = $db->prepare('SELECT * FROM post;');
        $res->execute();
        return ($res);
    }

    //Returns a specific post from the blog, id given as argument
    public function ft_getPost($idPost) {
        $db = $this->ft_connect_db();
        $res = $db->prepare('SELECT * FROM post WHERE idPost = :idPost;');
        $res->execute(array('idPost' => $idPost));
        return ($res);
    }
}