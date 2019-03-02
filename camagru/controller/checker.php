<?php

require_once('./model/CommentManager.php');
require_once('./model/EnjoyManager.php');
require_once('./model/PhotoManager.php');
require_once('./model/FollowManager.php');
require_once('./model/UserManager.php');

// Checks if given pwd is correct -> only letters and digits or point -> at least one letter and one digit
function ft_check_pwd($str) {
    if (preg_match('/^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9.]{6,15}$/', $str))
        return (True);
    return (false);
}

// Checks if given pseudo is correct -> only letters and digits or point
function ft_check_pseudo($str) {
    if (preg_match('/^(?=.*[A-Za-z0-9])[A-Za-z0-9.]{3,15}$/', $str))
        return (True);
    return (false);
}

// Checks if the connection form is ok
function ft_connect_checker() {
    // Management of form errors
    if (!isset($_POST['pseudo']) || !isset($_POST['pwd'])) {
        header('Location: ./index.php?action=connect&error=empty');
        exit();
    }
    if ($_POST['pseudo'] == '' || $_POST['pwd'] == '') {
        header('Location: ./index.php?action=connect&error=empty');
        exit();
    }
    $pseudo = $_POST['pseudo'];
    $pwd = hash('whirlpool', $_POST['pwd']);

    // Check if the user already exists
    $userManager = new Usermanager();
    $query = $userManager->ft_username_exists($pseudo);
    $nb_user = $query->fetch();
    $query->closeCursor();
    if ($nb_user['nb'] == 0) {
        header('Location: ./index.php?action=connect&error=exists');
        exit();
    }

    // Check if the account is active
    $query = $userManager->ft_check_active($pseudo);
    $nb_user = $query->fetch();
    $query->closeCursor();
    if ($nb_user['nb'] != 1) {
        header('Location: ./index.php?action=connect&error=active');
        exit();
    }

    // Check if password is correct and then connects
    $query = $userManager->ft_check_password($pseudo, $pwd);
    $nb_user = $query->fetch();
    $query->closeCursor();
    if ($nb_user['nb'] != 1) {
        header('Location: ./index.php?action=connect&error=pwd');
        exit();
    }
    $_SESSION['username'] = $pwd;
    header('Location: ./index.php');
}

// Checks if the suscribe form is ok
function ft_suscribe_checker() {
    // Management of form errors
    if (!isset($_POST['pseudo']) || !isset($_POST['pwd']) || !isset($_POST['pwd_confirm']) || !isset($_POST['mail'])) {
        header('Location: ./index.php?action=suscribe&error=empty');
        exit();
    }
    if ($_POST['pseudo'] == '' || $_POST['pwd'] == '' || $_POST['pwd_confirm'] == '' || $_POST['mail'] == '') {
        header('Location: ./index.php?action=suscribe&error=empty');
        exit();
    }
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $pwd = $_POST['pwd'];
    $confirm_pwd = $_POST['pwd_confirm'];
    if ($pwd != $confirm_pwd) {
        header('Location: ./index.php?action=suscribe&error=pwdmatch');
        exit();
    }
    if (strlen($pwd) < 6 || strlen($pwd) > 15) {
        header('Location: ./index.php?action=suscribe&error=pwdlen');
        exit();
    }
    if (!ft_check_pwd($pwd)) {
        header('Location: ./index.php?action=suscribe&error=pwdcontent');
        exit();
    }
    if (strlen($pseudo) < 3 || strlen($pseudo) > 15) {
        header('Location: ./index.php?action=suscribe&error=pseudolen');
        exit();
    }
    if (!ft_check_pseudo($pseudo)) {
        header('Location: ./index.php?action=suscribe&error=pseudocontent');
        exit();
    }
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header('Location: ./index.php?action=suscribe&error=mail_format');
        exit();
    }
    $pwd = hash('whirlpool', $pwd);

    // Check if the user already exists
    $userManager = new Usermanager();
    $query = $userManager->ft_username_exists($pseudo);
    $nb_user = $query->fetch();
    $query->closeCursor();
    if ($nb_user['nb'] != 0) {
        header('Location: ./index.php?action=suscribe&error=pseudoexists');
        exit();
    }
    $query = $userManager->ft_mail_exists($mail);
    $nb_user = $query->fetch();
    $query->closeCursor();
    if ($nb_user['nb'] != 0) {
        header('Location: ./index.php?action=suscribe&error=mailexists');
        exit();
    }

    // Adding user to the database
    $key = md5(microtime(True) * 100000);
    $userManager->ft_adduser($pseudo, $mail, $pwd, $key);
    header('Location: ./index.php?action=connect&account=ok') ;
}