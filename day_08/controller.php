<?php

session_start();

// Require files
require_once( "./classes/Vaisseau.class.php" );
require_once( "./classes/Fox.class.php" );
require_once( "./classes/Arme.class.php" );
require_once( "./classes/Blaster.class.php" );
require_once( "./classes/Flotte.class.php" );
require_once( "./classes/Grille.class.php" );
require_once( "./classes/Joueur.class.php" );
require_once( "./classes/Obstacle.class.php" );
require_once( "./classes/Panneau.class.php" );
require_once( "./classes/Partie.class.php" );

// Manage moving action
function ft_move($partie, $nbJ, $nbV, $axe, $coeff) {
    $joueur = $partie->getJoueur($nbJ);
    $flotte = $joueur->getFlotte();
    $vaisseau = $flotte->getVaisseau($nbV);
    $vaisseau->move($axe, $coeff);
    return ;
}

// Manage shooting action
function ft_shoot($partie, $nbJ, $nbV, $ennemi) {
    $joueur = $partie->getJoueur($nbJ);
    $flotte = $joueur->getFlotte();
    $vaisseau = $flotte->getVaisseau($nbV);
    $ennemi = $partie->getJoueur($ennemi);
    $vaisseau->tirer($ennemi);
}

if (!isset($_SESSION["partie"])) {
    if (
        !isset( $_POST["j1"] ) || !isset( $_POST["j2"] ) || !isset( $_POST["submit"] ) ||
        empty( $_POST["j1"] ) || empty( $_POST["j2"] ) || empty( $_POST["submit"] ) ) {
            header( "Location: ./index.html" );
    }
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
} else {
    $partie = unserialize($_SESSION["partie"]);
    $current = $partie->getCurrent();
    $panneau = $partie->getPanneau($current);
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        switch ($action) {
            case "move":
                $nbJ = intval($_GET["nbJ"]);
                $nbV = intval($_GET["nbV"]);
                $coeff = intval($_GET["coeff"]);
                $axe = $_GET["axe"];
                ft_move($partie, $nbJ, $nbV, $axe, $coeff);
                break;
            case "shoot":
                $nbJ = intval($_GET["nbJ"]);
                $nbV = intval($_GET["nbV"]);
                $ennemi = intval($_GET["ennemi"]);
                ft_shoot($partie, $nbJ, $nbV, $ennemi);
                break;
            case "load":
                break;
            case "wait":
                break;
            default:
                break;
        }
        $panneau->coupFini();
        if ($panneau->getCoup() == 0) {
            $partie->finTour();
            $current = $partie->getCurrent();
            $panneau = $partie->getPanneau($current);
        }
    }
    $partie->majVaisseau();
    $grille = $partie->getGrille();
    $_SESSION["partie"] = serialize($partie);
    $_SESSION["grille"] = serialize($grille);
    $_SESSION["current"] = $current;
    $_SESSION["panneau"] = serialize($panneau);
}
header( "Location: ./partie.php" );


?>