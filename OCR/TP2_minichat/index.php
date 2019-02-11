<?php

session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Mini-chat: Accueil</title>
</head>
<body>
    <?php require_once("./inc/header.php"); ?>
    <div class="content">
        <fieldset>
            <legend>Connexion</legend>
            <form action="./controller/index.php" method="post">
            <table>
                <tr>
                    <td>Votre pseudo:</td>
                    <td><input type="text" name="pseudo" placeholder="Saisir pseudo"></td>
                </tr>
                <tr>
                    <td>Votre mot de passe:</td>
                    <td><input type="password" name="pwd" placeholder="Saisir mot de passe"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="OK"></td>
                </tr>
            </table>
            </form>
        </fieldset>
    </div>
</body>
</html>