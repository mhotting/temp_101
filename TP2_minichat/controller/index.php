<?php

include_once('./../inc/connect.php');
session_start();

// Management of form errors
if (!isset($_POST['pseudo']) || !isset($_POST['pwd']) || !isset($_POST['submit'])) {
    header('Location: ./../index.php?error=empty');
    exit();
}
if ($_POST['pseudo'] == '' || $_POST['pwd'] == '' || $_POST['submit'] != 'OK') {
    header('Location: ./../index.php?error=empty');
    exit();
}
$pseudo = htmlspecialchars($_POST['pseudo']);
$pwd = htmlspecialchars($_POST['pwd']);

// Connect to DB
$db = ft_connect_db();
if ($db == Null)
    header('Location: ./../index.php?error=db');

// Test if pseudo is already registered
$pwd = hash('whirlpool', $pwd);
$query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE pseudo = :pseudo;');
$query->execute(array('pseudo' => $pseudo));
$num = $query->fetch();
$query->closeCursor();
if (intval($num['nb']) < 1) {
    header('Location: ./../index.php?error=exists');
    exit();
}

// Connection if pseudo and password are correct
$query = $db->prepare('SELECT * FROM user WHERE pseudo = :pseudo;');
$query->execute(array('pseudo' => $pseudo));
$res = $query->fetch();
if ($res['pseudo'] == $pseudo && $res['password'] == $pwd) {
    $_SESSION['pseudo'] = $pseudo;
    header('Location: ./../index.php');
    exit();
} else {
    header('Location: ./../index.php?error=pwd');
    exit();
}

?>