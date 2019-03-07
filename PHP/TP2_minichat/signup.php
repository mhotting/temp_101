<?php

session_start();
if (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] != '') {
    header('Location: ./chat.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini-chat: Inscription</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <?php require_once("./inc/header.php"); ?>
    <div class="content">
        <fieldset>
            <legend>Créer un compte</legend>
            <form action="./controller/signup.php" method="post">
            <table>
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'empty')
                        echo('<tr><td colspan="2" class="error">*Erreur: tous les champs doivent être remplis.</td></tr>');
                    elseif ($_GET['error'] == 'db')
                        echo('<tr><td colspan="2" class="error">*Erreur: problème de serveur, retentez plus tard.</td></tr>');
                    elseif ($_GET['error'] == 'letternum')
                        echo('<tr><td colspan="2" class="error">*Erreur: pseudo et mot de passe ne doivent contenir que des lettres et chiffres.</td></tr>');
                    elseif ($_GET['error'] == 'pwdmatch')
                        echo('<tr><td colspan="2" class="error">*Erreur: les mots de passe sont différents.</td></tr>');
                    elseif ($_GET['error'] == 'pwdlen')
                        echo('<tr><td colspan="2" class="error">*Erreur: le mot de passe doit contenir entre 3 et 15 caractères.</td></tr>');
                    elseif ($_GET['error'] == 'exists')
                        echo('<tr><td colspan="2" class="error">*Erreur: le pseudo est déjà emprunté par un utilisateur.</td></tr>');
                    elseif ($_GET['error'] == 'pseudolen')
                        echo('<tr><td colspan="2" class="error">*Erreur: le pseudo doit contenir entre 3 et 15 caractères.</td></tr>');
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
                    <td>Confirmer votre mot de passe:</td>
                    <td><input type="password" name="confirm_pwd" placeholder="Saisir mot de passe"></td>
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