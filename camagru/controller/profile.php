<?php

require_once('./model/CommentManager.php');
require_once('./model/EnjoyManager.php');
require_once('./model/PhotoManager.php');
require_once('./model/FollowManager.php');
require_once('./model/UserManager.php');

// Displays the profile of an user
function ft_display_user($username) {
    $title = 'CAMAGRU: Page utilisateur';
    $content = '<h1>Page utilisateur</h1>';
    require_once('./view/standard.php');
}

// Displays the profile of a logged in user
function ft_display_userpage($username) {
    $title = 'CAMAGRU: Page personnelle';
    $content = '<h1>Page personnelle</h1>';
    require_once('./view/standard.php');
}