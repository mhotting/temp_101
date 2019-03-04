<?php

session_start();
require_once('./controller/gallery.php');
require_once('./controller/user.php');
require_once('./controller/checker.php');
require_once('./controller/profile.php');
require_once('./controller/util.php');

// Installing database if necessary
if (file_exists('./config/setup.php')) {
    require_once('./config/setup.php');
    ft_create_db();
    rename('./config/setup.php', './config/setup_done.php');
    header('Location: ./index.php');
    exit();
}

// Calling a function according to user location
if (isset($_GET['action']) && $_GET['action'] != '') {
    if ($_GET['action'] == 'gallery')
        ft_display_gallery();
    elseif ($_GET['action'] == 'userprofile') {
        if (isset($_GET['username']) && $_GET['username'] != '')
            ft_display_user($_GET['username']);
        else
            ft_display_error('Erreur - Nom d\'utilisateur inconnu.');
    }
    elseif ($_GET['action'] == 'ownprofile') {
        ft_display_userpage($_SESSION['username']);
    }
    elseif ($_GET['action'] == 'connect') {
        ft_display_connect();
    }
    elseif ($_GET['action'] == 'suscribe') {
        ft_display_suscribe();
    }
    elseif ($_GET['action'] == 'create') {
        ft_display_create();
    }
    elseif ($_GET['action'] == 'logout') {
        ft_logout();
    }
    elseif ($_GET['action'] == 'search') {
        ft_user_search();
    }
    elseif ($_GET['action'] == 'activate') {
        ft_activate();
    }
    elseif ($_GET['action'] == 'forgotten') {
        ft_forgotten();
    }
    elseif (isset($_GET['error'])) {
        ft_display_error($_GET['error']);
    }
    else {
        ft_display_error('Inconnue');
    }
}
elseif (isset($_POST['action']) && $_POST['action'] != '') {
    if ($_POST['action'] == 'suscribechecker')
        ft_suscribe_checker();
    elseif ($_POST['action'] == 'connectchecker')
        ft_connect_checker();
    elseif ($_POST['action'] == 'forgottenchecker')
        ft_forgotten_checker();
}
else {
    ft_display_gallery();
}