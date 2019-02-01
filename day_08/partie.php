<?php

session_start();
// Require files
require_once( "./classes/Arme.class.php" );
require_once( "./classes/Flotte.class.php" );
require_once( "./classes/Grille.class.php" );
require_once( "./classes/Joueur.class.php" );
require_once( "./classes/Obstacle.class.php" );
require_once( "./classes/Panneau.class.php" );
require_once( "./classes/Partie.class.php" );
require_once( "./classes/Vaisseau.class.php" );

if (!isset($_SESSION["partie"]) || !isset($_SESSION["grille"]))
    header("Location: ./index.html");
    $grille = unserialize($_SESSION["grille"]);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Starships Battles</title>
</head>
<body>
    <h2>Starships Battles</h2>
    <div id="content">
        <div id="j1p">

        </div>
        <div id="grille">
        <?php
            echo($grille);
        ?>
        </div>
        <div id="j2p">

        </div>
    </div>
</body>
</html>