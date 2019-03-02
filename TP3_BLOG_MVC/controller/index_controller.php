<?php

require_once('./model/CommentManager.php');
require_once('./model/PostManager.php');

// Deals with the list of all the posts of the blog
function ft_postList() {
    $postManager = new PostManager();
    $postList = $postManager->ft_getPostList();
    while ($line = $postList->fetch()) {
        print_r($line);
    }
}

// Deals with a specific post of the blog, given as an arg
function ft_post($idPost) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->ft_getPost($idPost);
    $comments = $commentManager->ft_getComments($idPost);
}