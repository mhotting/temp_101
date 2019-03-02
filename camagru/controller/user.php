<?php

require_once('./model/CommentManager.php');
require_once('./model/EnjoyManager.php');
require_once('./model/PhotoManager.php');
require_once('./model/FollowManager.php');
require_once('./model/UserManager.php');

// Displays connection form
function ft_display_connect() {
    $title = 'CAMAGRU: Connexion';
    ob_start();
    require_once('./view/connect.php');
    $content = ob_get_clean();
    require_once('./view/standard.php');
}

// Displays suscribe form
function ft_display_suscribe() {
    $title = 'CAMAGRU: Inscription';
    ob_start();
    require_once('./view/suscribe.php');
    $content = ob_get_clean();
    require_once('./view/standard.php');
}

// Searching bar
function ft_user_search() {
    $title = 'CAMAGRU: Recherche';
    $content = '<h1>Recherche</h1>';
    require_once('./view/standard.php');
}