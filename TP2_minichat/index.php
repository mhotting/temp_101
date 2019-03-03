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
        <?php
        if (isset($_SESSION['pseudo'])) {
            echo('<p>Vous êtes identifié!</p>');
            echo('<p>Redirection automatique vers la page de chat!</p>');
            header('refresh:2; url=./chat.php');
        } else {
            ?>
            <fieldset>
                <legend>Connexion</legend>
                <form action="./controller/index.php" method="post">
                <table>
                    <?php
                    if (isset($_GET['account']) && $_GET['account'] == 'ok') {
                        echo('<tr><td colspan="2" class="error">*Compte créé, identifiez-vous pour accéder au chat.</td></tr>');
                    } elseif (isset($_GET['account']) && $_GET['account'] == 'logout') {
                        echo('<tr><td colspan="2" class="error">*Vous êtes bien déconnecté.</td></tr>');
                    } elseif (isset($_GET['account']) && $_GET['account'] == 'connect') {
                        echo('<tr><td colspan="2" class="error">*Vous devez d\'abord vous identifier.</td></tr>');
                    } elseif (isset($_GET['error'])) {
                        if ($_GET['error'] == 'empty')
                            echo('<tr><td colspan="2" class="error">*Erreur: tous les champs doivent être remplis.</td></tr>');
                        elseif ($_GET['error'] == 'exists')
                            echo('<tr><td colspan="2" class="error">*Erreur: le compte semble ne pas exister.</td></tr>');
                        elseif ($_GET['error'] == 'pwd')
                            echo('<tr><td colspan="2" class="error">*Erreur: le mot de passe est erroné.</td></tr>');
                        else
                            echo('<tr><td colspan="2" class="error">*Erreur: problème de serveur, retentez plus tard.</td></tr>');
                    }
                    ?>
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
            <?php
        } ?>
    </div>
</body>
</html>