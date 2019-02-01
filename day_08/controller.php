<?php

session_start();

// Require files
require_once( "./classes/Vaisseau.class.php" );
require_once( "./classes/Fox.class.php" );
require_once( "./classes/Arme.class.php" );
require_once( "./classes/Flotte.class.php" );
require_once( "./classes/Grille.class.php" );
require_once( "./classes/Joueur.class.php" );
require_once( "./classes/Obstacle.class.php" );
require_once( "./classes/Panneau.class.php" );
require_once( "./classes/Partie.class.php" );


if (
    !isset( $_POST["j1"] ) || !isset( $_POST["j2"] ) || !isset( $_POST["submit"] ) ||
    empty( $_POST["j1"] ) || empty( $_POST["j2"] ) || empty( $_POST["submit"] ) ) {
        header( "Location: ./index.html" );
}

if (!isset($_SESSION["partie"]))
{
    $partie = new Partie($_POST["j1"], $_POST["j2"]);
    $grille = $partie->getGrille();
    $current = $partie->getCurrent();
    $panneau = $partie->getPanneau($current);
    $_SESSION["partie"] = serialize($partie);
    $_SESSION["grille"] = serialize($grille);
    $_SESSION["current"] = $current;
    $_SESSION["panneau"] = serialize($panneau);
}

header( "Location: ./partie.php" );


?>