<?php

include_once('./../inc/connect.php');
session_start();
if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] == '') {
    header('Location: ./../index.php');
    exit();
}

// Management of form errors
if (!isset($_POST['message']) || !isset($_POST['submit'])) {
    header('Location: ./../chat.php?error=empty');
    exit();
}
if ($_POST['message'] == '') {
    header('Location: ./../chat.php?error=empty');
    exit();
}
$message = htmlspecialchars($_POST['message']);
$pseudo = $_SESSION['pseudo'];

// Connect to DB
$db = ft_connect_db();
if ($db == Null)
    header('Location: ./../chat.php?error=db');

// Check user in DB
$query = $db->prepare('SELECT COUNT(*) AS \'nb\' FROM user WHERE pseudo = :pseudo;');
$query->execute(array('pseudo' => $pseudo));
$num = $query->fetch();
$query->closeCursor();
if (intval($num['nb']) < 1) {
    header('Location: ./../logout.php');
    exit();
}

// Save user id from DB
$query = $db->prepare('SELECT * FROM user WHERE pseudo = :pseudo;');
$query->execute(array('pseudo' => $pseudo));
$res = $query->fetch();
$id = intval($res['idUser']);
$query = $db->prepare('INSERT INTO message(idUser, dateMessage, contenu) VALUES (:id, NOW(), :contenu);');
$query->execute(array('id' => $id, 'contenu' => $message));
header('Location: ./../chat.php');

?>