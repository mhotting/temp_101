<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/style.css">
    <title><?= $title ?></title>
</head>
<body>
    <?php
        require_once('./view/menu.php');
        echo('<div class="container" id="content">');
        echo($content);
        echo('</div>');
    ?>
    <script type="text/javascript">
        document.getElementById("content").style.display = "flex";
    </script> 
</body>
</html>