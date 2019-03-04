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

// Activates account
function ft_activate() {
    // Management of form errors
    if (!isset($_GET['username']) || !isset($_GET['key'])) {
        header('Location: ./index.php?action=connect&error=activate');
        exit();
    }
    if ($_GET['username'] == '' || $_GET['key'] == '') {
        header('Location: ./index.php?action=connect&error=activate');
        exit();
    }
    $pseudo = $_GET['username'];
    $key = $_GET['key'];

    // Check if the user already exists
    $userManager = new Usermanager();
    $query = $userManager->ft_username_exists($pseudo);
    $nb_user = $query->fetch();
    $query->closeCursor();
    if ($nb_user['nb'] == 0) {
        header('Location: ./index.php?action=connect&error=activate');
        exit();
    }

    // Check if the account is active
    $query = $userManager->ft_check_active($pseudo);
    $nb_user = $query->fetch();
    $query->closeCursor();
    if ($nb_user['nb'] != 0) {
        header('Location: ./index.php?action=connect&error=alreadyactivated');
        exit();
    }

    // Checks if key corresponds to username
    $query = $userManager->ft_check_activationkey($pseudo, $key);
    $ok = $query->fetch();
    $query->closeCursor();
    if ($ok['nb'] != 1) {
        header('Location: ./index.php?action=connect&error=activate');
        exit();
    }

    // Activates account and redirects to connection
    $userManager->ft_activate($pseudo);
    header('Location: ./index.php?action=connect&account=activate');
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

    // Checks if the user already exists
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

    // Activation mail
    $activationKey = md5(microtime(True) * 100000);
    $dest = $mail;
    $subject = "CAMAGRU: Activer votre compte" ;
    $head = "From: inscription@camagru.com" ;
    $content =
        'Bienvenue chez Camagru!
    
        Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
        ou le copier/coller dans votre navigateur internet.
        
        http://localhost:8100/perso/camagru/index.php?action=activate&username='.urlencode($pseudo).'&key='.urlencode($activationKey).'
        
        ---------------
        Ceci est un mail automatique, merci de ne pas y repondre.';
    $ok = mail($dest, $subject, $content, $head) ;
    if (!$ok) {
        header('Location: ./index.php?action=suscribe&error=mailsent');
        exit();
    }

    // Adding user to the database
    $forgottenKey = md5(microtime(True) * 1000);
    $userManager->ft_adduser($pseudo, $mail, $pwd, $activationKey, $forgottenKey);
    header('Location: ./index.php?action=connect&account=ok') ;
}

// Checks if the forgotten form is ok
function ft_forgotten_checker() {
    // Management of form errors
    if (!isset($_POST['mail'])) {
        header('Location: ./index.php?action=forgotten&error=empty');
        exit();
    }
    if ($_POST['mail'] == '') {
        header('Location: ./index.php?action=forgotten&error=empty');
        exit();
    }
    $mail = $_POST['mail'];
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header('Location: ./index.php?action=forgotten&error=badmail');
        exit();
    }
    $userManager = new Usermanager();
    $query = $userManager->ft_mail_exists($mail);
    $nb_user = $query->fetch();
    $query->closeCursor();
    if ($nb_user['nb'] != 1) {
        header('Location: ./index.php?action=forgotten&error=badmail');
        exit();
    }

    // Preparing the email
    $query = $userManager->ft_user_info($mail);
    $info = $query->fetch();
    $query->closeCursor();
    $pseudo = $info['nameUser'];
    $forgottenKey = $info['forgottenKey'];
    $dest = $mail;
    $subject = "CAMAGRU: Reinitialiser votre mot de passe." ;
    $head = "From: inscription@camagru.com" ;
    $content =
        'Bienvenue chez Camagru!
    
        Pour renouveller votre mot de passe, veuillez cliquer sur le lien ci-dessous
        ou le copier/coller dans votre navigateur internet.
        
        http://localhost:8100/perso/camagru/index.php?action=resetpassword&username='.urlencode($pseudo).'&key='.urlencode($forgottenKey).'
        
        ---------------
        Ceci est un mail automatique, merci de ne pas y repondre.';
    $ok = mail($dest, $subject, $content, $head) ;
    if (!$ok) {
        header('Location: ./index.php?action=forgotten&error=mailsent');
        exit();
    }
    header('Location: ./index.php?action=forgotten&account=ok') ;
}