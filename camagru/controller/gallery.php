<?php

require_once('./model/CommentManager.php');
require_once('./model/EnjoyManager.php');
require_once('./model/PhotoManager.php');
require_once('./model/FollowManager.php');
require_once('./model/UserManager.php');

// Displays the gallery of the website composed of all the photos ranked by date
function ft_display_gallery() {
    $title = 'CAMAGRU: Galerie d\'accueil';
    $content = '<h1>Galerie</h1>';
    require_once('./view/standard.php');
}

// Displays the photo creation page
function ft_display_create() {
    $title = 'CAMAGRU: Création d\'image';
    ob_start();
    require_once('./view/create.php');
    $content = ob_get_clean();
    require_once('./view/standard.php');
}