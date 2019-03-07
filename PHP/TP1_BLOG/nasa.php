<?php

if (isset($_POST["pwd"]) && hash('whirlpool', $_POST["pwd"]) != hash('whirlpool', 'justi'))
    header('Location: ./form.php?error=1');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Code NASA</title>
</head>
<body>
    <p>Les codes de la nasa sont: haha, tu croyais vraiment les recevoir? Mais c'est bien, tu sais gérer un mot de passe.</p>
    <br /><a href="./../index.php">Retour à l'accueil des TPs</a>
</body>
</html>