<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_GET['error']) && $_GET['error'] == 1)
            echo('<p>Vous n\'avez pas donné le bon mot de passe.</p><br />');
    ?>
    <form action="nasa.php" method="post">
        <input type="password" name="pwd" placeholder="Votre mot de passe">
        <input type="submit" name="submit" value="OK">
    </form>
    <br /><a href="./../index.php">Retour à l'accueil des TPs</a>
</body>
</html>