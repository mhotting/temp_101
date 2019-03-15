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
    $frames = '' . $_SESSION['username'] . ' - ' . $_SESSION['idUser'];
    $objects = '';
    $user_gallery = '';
    ob_start();
    require_once('./view/create.php');
    $content = ob_get_clean();
    require_once('./view/standard.php');
}

// Checks if the creation is ok, then saves the picture
function ft_create_checker() {
    $img = $_POST['image'];
    $folderPath = "./public/photos/";

    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);

    print_r($fileName);
}