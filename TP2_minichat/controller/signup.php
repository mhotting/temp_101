<?php

include_once('./../inc/connect.php');
session_start();

// Checks if a string is only composed of letters and digits
function ft_check_str($str) {
    $str = strtolower($str);
    for ($i = 0; $i < strlen($str); $i++) {
        $letter = $str[$i];
        if ( ($letter >= '0' && $letter <= '9') || ($letter >= 'a' && $letter <= 'z') )
            continue ;
        else
            return (False);
    }
    return (True);
}

// Management of form errors
if (!isset($_POST['pseudo']) || !isset($_POST['pwd']) || !isset($_POST['confirm_pwd']) || !isset($_POST['submit'])) {
    header('Location: ./../signup.php?error=empty');
    exit();
}
if ($_POST['pseudo'] == '' || $_POST['pwd'] == '' || $_POST['confirm_pwd'] == '' || $_POST['submit'] != 'OK') {
    header('Location: ./../signup.php?error=empty');
    exit();
}
$pseudo = htmlspecialchars($_POST['pseudo']);
$pwd = htmlspecialchars($_POST['pwd']);
$confirm_pwd = htmlspecialchars($_POST['confirm_pwd']);
if ($pwd != $confirm_pwd) {
    header('Location: ./../signup.php?error=pwdmatch');
    exit();
}
if (strlen($pseudo) < 3 || strlen($pseudo) > 15) {
    header('Location: ./../signup.php?error=pseudolen');
    exit();
}
if (strlen($pwd) < 3 || strlen($pwd) > 15) {
    header('Location: ./../signup.php?error=pwdlen');
    exit();
}
if (!ft_check_str($pseudo) || !ft_check_str($pwd)) {
    header('Location: ./../signup.php?error=letternum');
    exit();
}

// Connect to DB
$db = ft_connect_db();
if ($db == Null)
    header('Location: ./../signup.php?error=db');
$pwd = hash('whirlpool', $pwd);
$query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE pseudo = :pseudo;');
$query->execute(array('pseudo' => $pseudo));
$num = $query->fetch();
$query->closeCursor();
if (intval($num['nb']) != 0) {
    header('Location: ./../signup.php?error=exists');
    exit();
}
$query = $db->prepare('INSERT INTO user(pseudo, password) VALUES (:pseudo, :pwd);');
$query->execute(array('pseudo' => $pseudo, 'pwd' => $pwd));
header('Location: ./../index.php?account=ok');

?>